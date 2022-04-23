<h2>Корзина</h2>

<div class="contentHeader">
    <div>в Корзине на сумму: <span id='total'><?= $total ?></span> &euro;</div>
    <?php if ($total != 0) : ?>
        <a href="order/buy" class="buy">buy now</a>
    <?php endif; ?>
</div>

<?php foreach ($cart as $item) : ?>
    <div data-id=<?= $item['id'] ?>>
        <h3><?= $item['name'] ?></a></h3>
        <p>price: <?= $item['actualPrice'] ?></p>
        <button class="delFromCartButton" data-uniqId="<?= $item['uniqId'] ?>" type="button">Удалить</button>
    </div>
<?php endforeach; ?>
