<?php

use App\Controller\blogController;

require 'vendor/autoload.php';
require 'Config/config.php';

$controller = new blogController();

if (!$_POST) {
    if (!isset($_GET['page'])) {
        echo $controller->indexAction();
    } else {
        switch ($_GET['page']) {
            case 'add':
                echo $controller->addArticleAction();
                break;
            default:
                echo $controller->error404();
        }
    }
} else {
    $controller->addArticlePostAction();
}