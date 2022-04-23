<h2>Товар</h2>

<div>
    <h3><?= $product->name ?></h3>
    <p><?= $product->description ?></p>
    <p>price: <?= $product->actualPrice ?></p>
    <button class="addToCartButton" data-id="<?= $product->id ?>" type="button">Купить</button>
</div>
