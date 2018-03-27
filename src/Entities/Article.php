<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 25/03/18
 * Time: 12:14
 */

namespace App\Entities;

/**
 * Class Article
 * @package App\Entities
 */
class Article
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $author;
    /**
     * @var string
     */
    private $message;

    /**
     * Article constructor.
     * @param array contient les champs de l'entité
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data): void
    {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);

            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    /**
     * Test si les paramètres sont vides en vue de validé un formulaire.
     * @return array
     */
    public function testEmptyparameters(): array
    {
        $errors = [];

        if ($this->getTitle() === '') {
            $errors[] = 'title';
        }

        if ($this->getAuthor() === '') {
            $errors[] = 'author';
        }

        if ($this->getMessage() === '') {
            $errors[] = 'message';
        }

        return $errors;
    }

    /**
     * @return mixed
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title): void
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
    }
}
