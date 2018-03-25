<?php

namespace App\Controller;



use App\Entities\Article;
use App\Entities\Bdd;
use App\Managers\ArticlesManager;
use App\Entities\TwigEnvironement;

class BlogController
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
        $article = new Article($_POST);

        $bdd = new Bdd(DSN, USER, PASS);

        $articlesManager = new ArticlesManager($bdd->getPdo());
        $articlesManager->addArticle($article);
    }

    public function error404()
    {
        $twigEnv = new TwigEnvironement(TEMPLATES);
        $twig = $twigEnv->getTwig();
        return $twig->render('error404.html.twig', array());
    }

    public function updateArticleAction(int $id)
    {


        $bdd = new Bdd(DSN, USER, PASS);

        $articlesManager = new ArticlesManager($bdd->getPdo());
        $article = $articlesManager->selectOne($id);

        $twigEnv = new TwigEnvironement(TEMPLATES);
        $twig = $twigEnv->getTwig();
        return $twig->render('updateArticle.html.twig', array(
            'article' => $article,
        ));
    }

    public function updateArticlePostAction()
    {
        $article = new Article($_POST);

        $bdd = new Bdd(DSN, USER, PASS);
        $articlesManager = new ArticlesManager($bdd->getPdo());

        $articlesManager->updateArticle($article);
    }

    public function deleteArticlePostAction()
    {
        $article = new Article($_POST);
        
        $bdd = new Bdd(DSN, USER, PASS);
        $articlesManager = new ArticlesManager($bdd->getPdo());

        $articlesManager->deleteArticle($article);
    }
}