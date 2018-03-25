<?php

namespace App\Controller;



use App\Entities\Bdd;
use App\Managers\ArticlesManager;
use App\Entities\TwigEnvironement;

class blogController
{
    public function indexAction()
    {
        $bdd = new Bdd(DSN, USER, PASS);

        $articlesManager = new ArticlesManager($bdd->getPdo());
        $articles = $articlesManager->selectAll();

        $twigEnv = new TwigEnvironement(TEMPLATES);
        $twig = $twigEnv->getTwig();
        return $twig->render('index.html.twig', array('articles' => $articles));
    }

    public function addArticleAction()
    {
        $twigEnv = new TwigEnvironement(TEMPLATES);
        $twig = $twigEnv->getTwig();
        return $twig->render('addArticle.html.twig', array());
    }

    public function addArticlePostAction()
    {
        $title = $_POST['title'];
        $author = $_POST['author'];
        $message = $_POST['message'];

        $bdd = new Bdd(DSN, USER, PASS);

        $articlesManager = new ArticlesManager($bdd->getPdo());
        $articlesManager->addArticle($title, $author, $message);
    }

    public function error404()
    {
        $twigEnv = new TwigEnvironement(TEMPLATES);
        $twig = $twigEnv->getTwig();
        return $twig->render('error404.html.twig', array());
    }
}