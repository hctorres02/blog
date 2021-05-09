<?php

namespace src\models;

class Model implements IModel
{

    public function __construct($table, $alias = '')
    {
    }

    /**
     * @param int $cid
     * @param string $orderBy
     * @return array|null
     */
    public static function all(): ?array
    {
        return [];
    }

    /**
     * @param string $column
     * @param string $value
     * @return array|Post|null
     */
    public static function findBy($column, $value, $fetchAll = true)
    {
    }
}
