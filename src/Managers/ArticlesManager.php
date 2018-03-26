<?php

namespace App\Managers;

use App\Entities\Article;
use \PDO;

/**
 * Class ArticlesManager
 * @package App\Managers
 */
class ArticlesManager
{
    /**
     * @var PDO
     */
    private $bdd;


    /**
     * ArticlesManager constructor.
     * @param PDO $bdd
     */
    public function __construct(PDO $bdd)
    {
        $this->bdd = $bdd;
    }

    /**
     * Retourne tous les articles.
     * @return array
     */
    public function selectAll(): array
    {
        $query = 'SELECT * FROM article';
        $data = $this->bdd->query($query);
        $articlesDatas = $data->fetchAll(PDO::FETCH_ASSOC);

        $articles = [];
        foreach ($articlesDatas as $article) {
            $articles[] = new Article($article);
        }
        return $articles;
    }

    public function selectOne(int $id): Article
    {
        $query = 'SELECT * FROM article WHERE id=:id';
        $data = $this->bdd->prepare($query);
        $data->bindValue(':id', $id, PDO::PARAM_INT);

        $data->execute();

        $articleData = $data->fetch(PDO::FETCH_ASSOC);
        $article = new Article($articleData);

        return $article;
    }

    public function addArticle(Article $article): array
    {

        $query = 'INSERT INTO article (title, author, message) VALUES (:title, :author, :message)';
        $prepare = $this->bdd->prepare($query);
        $prepare->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
        $prepare->bindValue(':author', $article->getAuthor(), PDO::PARAM_STR);
        $prepare->bindValue(':message', $article->getMessage(), PDO::PARAM_STR);

        $prepare->execute();

        header('Location: index.php');
        exit();
    }

    public function updateArticle(Article $article): void
    {
        $query = 'UPDATE article SET title=:title, author=:author, message=:message WHERE id=:id';
        $prepare = $this->bdd->prepare($query);
        $prepare->bindValue(':id', $article->getId(), PDO::PARAM_INT);
        $prepare->bindValue(':title', $article->getTitle(), PDO::PARAM_STR);
        $prepare->bindValue(':author', $article->getAuthor(), PDO::PARAM_STR);
        $prepare->bindValue(':message', $article->getMessage(), PDO::PARAM_STR);

        $prepare->execute();

        header('Location: index.php');
        exit();
    }

    public function deleteArticle(Article $article): void
    {
        $query = 'DELETE FROM article WHERE id=:id';
        $prepare = $this->bdd->prepare($query);
        $prepare->bindValue(':id', $article->getId(), PDO::PARAM_INT);

        $prepare->execute();

        header('Location: index.php');
        exit();
    }
}