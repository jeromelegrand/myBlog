<?php

namespace App\Controller;

use App\Entities\Article;
use App\Entities\Bdd;
use App\Managers\ArticlesManager;
use App\Entities\TwigEnvironement;

class BlogController
{

    public function indexAction(Bdd $bdd, ArticlesManager $articlesManager, TwigEnvironement $twigEnv)
    {

        $articles = $articlesManager->selectAll();

        $twig = $twigEnv->getTwig();
        return $twig->render('index.html.twig', array('articles' => $articles));
    }

    public function addArticleAction(TwigEnvironement $twigEnv)
    {

        $twig = $twigEnv->getTwig();

        if ($_SESSION['error']) {
            return $twig->render('addArticle.html.twig', array(
                'article' => $_SESSION['article'],
                'error' => $_SESSION['error'],
            ));
        } else {
            return $twig->render('addArticle.html.twig', array());
        }
    }

    public function addArticlePostAction(Bdd $bdd, ArticlesManager $articlesManager, Article $article)
    {
        $_SESSION['error'] = $article->testEmptyparameters();

        if ($_SESSION['error'] !== []) {
            $_SESSION['article'] = $article;

            header('Location: index.php?page=add');
            exit();
        }

        $articlesManager->addArticle($article);
    }

    public function error404(TwigEnvironement $twigEnv)
    {
        $twig = $twigEnv->getTwig();
        return $twig->render('error404.html.twig', array());
    }

    public function updateArticleAction(Bdd $bdd, ArticlesManager $articlesManager, TwigEnvironement $twigEnv, int $id)
    {

        $article = $articlesManager->selectOne($id);

        $twig = $twigEnv->getTwig();
        return $twig->render('updateArticle.html.twig', array(
            'article' => $article,
            'error' => $_SESSION['error'],
        ));
    }

    public function updateArticlePostAction(Bdd $bdd, ArticlesManager $articlesManager, Article $article)
    {
        $_SESSION['error'] = $article->testEmptyparameters();

        if ($_SESSION['error'] !== []) {
            $_SESSION['error'][] = 'update';

            header('Location: index.php?page=update&id=' . $article->getId());
            exit();
        }

        $articlesManager->updateArticle($article);
    }

    public function deleteArticlePostAction(Bdd $bdd, ArticlesManager $articlesManager, Article $article)
    {
        $articlesManager->deleteArticle($article);
    }
}
