<?php

namespace src\models;

interface IModel
{
    /**
     * @return array|null
     * */
    public static function all();

    /**
     * @param string $column
     * @param string @value
     * @param bool $all
     * @return array|object|null
     */
    public static function findBy($column, $value, $fetchAll = true);
}
