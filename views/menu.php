<a href="/">Главная</a>
<a href="/product/catalog">Каталог</a>
<a href="/order">Мои заказы</a>
<?php if ($role) : ?>
    <a href='/order/ordersManagement'>Управление заказами</a>
<?php endif; ?>
<a href="/cart">Корзина (<span id=count><?= $count ?></span>)</a><br>
