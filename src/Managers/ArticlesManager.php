<?php

namespace App\Managers;


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
        $articles = $data->fetchAll(PDO::FETCH_ASSOC);

        return $articles;
    }

    public function addArticle(string $title, string $author, string $message)
    {
        $query = 'INSERT INTO article (title, author, message) VALUES (:title, :author, :message)';
        $prepare = $this->bdd->prepare($query);
        $prepare->bindValue(':title', $title, PDO::PARAM_STR);
        $prepare->bindValue(':author', $author, PDO::PARAM_STR);
        $prepare->bindValue(':message', $message, PDO::PARAM_STR);

        $prepare->execute();

        header('Location: index.php');
        exit();
    }
}