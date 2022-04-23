<?php

use app\engine\App;

include '../vendor/autoload.php';

$config = include '../config/config.php';

try {
    App::call()->run($config);
} catch (PDOException $e) {
    var_dump($e);
} catch (Exception $e) {
    echo $e->getMessage();
}
