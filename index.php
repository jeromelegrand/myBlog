<?php

require 'vendor/autoload.php';
require 'Config/config.php';

use App\Controller\BlogController;
use App\Entities\Bdd;
use App\Managers\ArticlesManager;
use App\Entities\TwigEnvironement;
use App\Entities\Article;

session_start();

$blogController = new BlogController();
$bdd = new Bdd(DSN, USER, PASS);
$articlesManager = new ArticlesManager($bdd->getPdo());
$twigEnv = new TwigEnvironement(TEMPLATES);

if (!$_POST) {
    if (!isset($_GET['page'])) {
        echo $blogController->indexAction($bdd, $articlesManager, $twigEnv);
    } else {
        switch ($_GET['page']) {
            case 'add':
                echo $blogController->addArticleAction($twigEnv);
                break;
            case 'update':
                echo $blogController->updateArticleAction($bdd, $articlesManager, $twigEnv, $_GET['id']);
                break;
            default:
                echo $blogController->error404($twigEnv);
        }
    }
} else {

    if ($_POST['id']) {
        if ($_POST['delete'] == true) {
            $blogController->deleteArticlePostAction($bdd, $articlesManager, new Article($_POST));
        } else {
            $blogController->updateArticlePostAction($bdd, $articlesManager, new Article($_POST));
        }
    } else {
        $blogController->addArticlePostAction($bdd, $articlesManager, new Article($_POST));
    }
}