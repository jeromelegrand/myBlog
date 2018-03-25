<?php

use App\Controller\BlogController;

require 'vendor/autoload.php';
require 'Config/config.php';

$blogController = new BlogController();

if (!$_POST) {
    if (!isset($_GET['page'])) {
        echo $blogController->indexAction();
    } else {
        switch ($_GET['page']) {
            case 'add':
                echo $blogController->addArticleAction();
                break;
            case 'update':
                echo $blogController->updateArticleAction($_GET['id']);
                break;
            default:
                echo $blogController->error404();
        }
    }
} else {

    if ($_POST['id']) {
        if ($_POST['delete'] == true) {
            $blogController->deleteArticlePostAction();
        } else {
            $blogController->updateArticlePostAction();
        }
    } else {
        $blogController->addArticlePostAction();
    }
}