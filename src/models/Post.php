<?php

namespace src\models;

use HCTorres02\QueryBuilder\Database;
use src\lib\http\Session;

class Post implements IModel
{
    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var string */
    public $body;

    /** @var bool*/
    public $active;

    /** @var int */
    public $author_id;

    /** @var int */
    public $category_id;

    public function __construct()
    {
    }

    /**
     * @param int $cid
     * @param string $orderBy
     * @return Post[]|null
     */
    public static function all(): ?array
    {
        if (Session::hasUser()) {
            return self::queryBuilder()->fetchAll();
        }

        return self::findBy('p.active', true);
    }

    /**
     * @param string $column
     * @param string $value
     * @return Post[]|Post|null
     */
    public static function findBy($column, $value, $fetchAll = true)
    {
        $qb = self::queryBuilder()->where($column, $value);

        if ($fetchAll) {
            return $qb->fetchAll();
        }

        return $qb->fetchObject(self::class);
    }

    /**
     * @param array $data
     * @return int|null
     */
    public static function create(array $data)
    {
        return self::queryBuilder()
            ->insert($data)
            ->lastInsertId();
    }

    /**
     * @param int $pid
     * @param array $data
     * @return int
     */
    public static function update($pid, array $data)
    {
        return self::queryBuilder()
            ->update($pid, $data)
            ->rowCount();
    }

    /**
     * @param int $pid
     * @return bool
     */
    public static function destroy($pid): bool
    {
        return self::queryBuilder()
            ->delete($pid)
            ->rowCount();
    }

    private static function queryBuilder()
    {
        return Database::table('posts', 'p')
            ->join('users u', 'u.id = p.author_id')
            ->join('categories c', 'c.id = p.category_id')
            ->addColumns('u.name as author', 'c.title as category')
            ->orderBy('p.id');
    }
}
