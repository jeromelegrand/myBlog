<?php
/**
 * Created by PhpStorm.
 * User: wilder16
 * Date: 25/03/18
 * Time: 12:33
 */

namespace App\Entities;

/**
 * Class Bdd
 * @package App\Entities
 */
class Bdd
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * Bdd constructor.
     * @param string $dsn
     * @param string $user
     * @param string $pass
     */
    public function __construct(string $dsn, string $user, string $pass)
    {
        $this->pdo = new \PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public function getPdo(): \PDO
    {
        return $this->pdo;
    }
}
