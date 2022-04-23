<?php

namespace app\controllers;

use app\engine\App;
use app\engine\Auth;
use app\models\entities\Cart;

class CartController extends Controller
{
    public function actionIndex()
    {
        $total = App::call()->cartRepository->getSumCart();

        $cart = App::call()->cartRepository->getCart();

        echo $this->render('cart/cart', [
            'cart' => $cart,
            'total' => $total,
        ]);
    }

    public function actionAdd()
    {
        $product_id = App::call()->request->inputPHP['id'];
        $session_id = App::call()->session->sessionId;

        $user_login = Auth::getUserLogin();

        $price = App::call()->productRepository->getWhereOne('id', $product_id, 'actualPrice')->actualPrice;
        $uniqId = uniqid(rand(), true);

        $cart = new Cart($product_id, $session_id, $user_login, $price, $uniqId);

        App::call()->cartRepository->save($cart);

        $response = [
            'status' => 'ok',
            'count' => App::call()->cartRepository->getCountWhere('session_id', $session_id),
        ];

        header('content-type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }

    public function actionDel()
    {
        $uniqId = App::call()->request->inputPHP['uniqId'];
        $user_login = Auth::getUserLogin();
        $session_id = App::call()->session->sessionId;

        $product = App::call()->cartRepository->getWhereOne('uniqId', $uniqId);
        $status = 'ok';

        if ($user_login === $product->login) {
            App::call()->cartRepository->delete($product);
        } else {
            $status = 'error';
        }

        $response = [
            'status' => $status,
            'count' => App::call()->cartRepository->getCountWhere('session_id', $session_id),
            'total' => App::call()->cartRepository->getSumCart(),
        ];

        header('content-type: application/json');
        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }

    public function actionGetCount()
    {
        $session_id = App::call()->session->sessionId;

        $response = [
            'status' => 'ok',
            'count' => App::call()->cartRepository->getCountWhere('session_id', $session_id),
        ];

        echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
        die();
    }
}
