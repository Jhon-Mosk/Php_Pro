<? if (!$allow) : ?>
    <form action="/auth/login" method="post">
        <input type='text' name='login' placeholder='Логин' require>
        <input type='password' name='pass' placeholder='Пароль' require>
        Запомнить меня <input type='checkbox' name='saveUser'>
        <input type='submit' name='auth' value="Войти">
        <input type='submit' name='reg' value="Зарегистрироваться">
    </form>
<? else : ?>
    Добро пожаловать, <?= $user_login ?> <a href='/auth/logout'>[выход]</a><br>
<? endif; ?>
