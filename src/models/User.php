<?php

namespace src\models;

use HCTorres02\QueryBuilder\Database;

class User
{
    public $id;
    public $name;
    public $email;
    private $password;
    public $active;

    public function __construct()
    {
    }

    /**
     * @param string $value
     * @return void
     */
    public function setPassword($value): void
    {
        $this->password = password_hash($value, PASSWORD_DEFAULT);
    }

    /**
     * @param string $value
     * @return bool
     */
    public function checkPassword($value): bool
    {
        return password_verify($value, $this->password);
    }

    /**
     * @return User[]|null
     */
    public static function all(): ?array
    {
        return self::queryBuilder()->fetchAll();
    }

    /**
     * @param string $column
     * @param string|int $value
     * @return User[]|User|null
     */
    public static function findBy($column, $value, $all = true)
    {
        $qb = self::queryBuilder()->where($column, $value);

        if ($all) {
            return $qb->fetchAll();
        }

        return $qb->fetchObject(self::class);
    }

    /**
     * @return HCTorres02\QueryBuilder\Database
     */
    private static function queryBuilder(): Database
    {
        return Database::table('users', 'u');
    }
}
