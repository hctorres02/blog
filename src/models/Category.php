<?php

namespace src\models;

use HCTorres02\QueryBuilder\Database;

class Category
{
    /** @var int */
    public $id;

    /** @var string */
    public $title;

    /** @var bool */
    public $active;

    /**
     * @return Category[]|null
     */
    public static function all($onlyActives = false): ?array
    {
        $qb =  self::queryBuilder();

        if ($onlyActives == true) {
            $qb->addColumns('SUM(p.active = 1) AS posts')
                ->where('c.active', true);
        }

        return $qb->fetchAll();
    }

    /**
     * @param sting $column
     * @param string $value
     * @param bool $fetchAll
     * @return Category[]|Category|null
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
     * @return HCTores02\QueryBuilder\Database
     */
    private static function queryBuilder()
    {
        return Database::table('categories', 'c')
            ->join('posts p', 'p.category_id = c.id')
            ->addColumns('COUNT(*) AS posts')
            ->groupBy('c.id');
    }
}
