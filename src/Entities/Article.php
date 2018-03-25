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
     * @param int|null $id
     * @param string|null $title
     * @param string|null $author
     * @param string|null $message
     */
    public function __construct(int $id = null, string $title = null, string $author = null, string $message = null)
    {
        if ($id === null) {
            $this->setTitle($title);
            $this->setAuthor($author);
            $this->setMessage($message);
        }
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
    public function getAuthor(): int
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