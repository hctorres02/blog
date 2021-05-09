<?php

namespace src\models;

use HCTorres02\QueryBuilder\Database;

class Dashboard
{
    /** @var string */
    public $tbname;

    /** @var int */
    public $all;

    /** @var int */
    public $actives;

    /** @var int */
    public $inactives;

    /**
     * @return Dashboard[]|null
     */
    public function all(): ?array
    {
        return self::queryBuilder()->fetchAll();
    }

    private static function queryBuilder()
    {
        $columns = [
            'COUNT(id) AS "all"',
            'SUM(active = 1) AS actives',
            'SUM(active = 0) AS inactives'
        ];

        return Database::table('posts')
            ->select(...$columns);
    }
}
