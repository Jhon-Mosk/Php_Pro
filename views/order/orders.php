<div class="contentHeader">
    <h2>Заказы</h2>
</div>
<? if (!$allow) : ?>
    Пожалуйста авторизуйтесь<br>
<? else : ?>
    <div class="productsWrap__oneProduct orders__wrap">
        <?php foreach ($orders as $order) : ?>
            <div class="contentHeader contentHeader_margin">
                <div>Дата заказа: <?= $order[0]['date'] ?></div>
                <div>Статус заказа: <?= $order[0]['status'] ?></div>
            </div>
            <?php foreach ($order as $item) : ?>
                <div class="productUnit__orders <?= $item['corner'] ?>">
                    <img title="<?= $item['name'] ?>" class="productImg" src="<?= $item['address'] ?>" alt="<?= $item['name'] ?>">
                    <div class="productName">
                        <?= $item['name'] ?>
                    </div>
                    <div class="productPriceWrap">
                        <div class="actualPrice">
                            &euro; <?= $item['actualPrice'] ?>
                        </div>
                        <?php if ($item['oldPrice']) : ?>
                            <div class="oldPrice">
                                &euro; <?= $item['oldPrice'] ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
<? endif; ?>
