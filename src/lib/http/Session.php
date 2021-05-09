<?php

namespace src\lib\http;

use src\models\User;

class Session
{
    /**
     * @return User
     */
    public static function getUser()
    {
        return self::get('user');
    }

    public static function hasUser(): bool
    {
        return self::has('user');
    }

    public static function setUser(?User $value): void
    {
        self::set('user', $value);
    }

    public static function getMessage()
    {
        return self::get('message', true);
    }

    public static function setMessage(?string $message): void
    {
        self::set('message', $message);
    }

    public static function setBag($value): void
    {
        self::set('bag', $value);
    }

    public static function getBag()
    {
        $bag = self::get('bag', true);

        return empty($bag) ? null : (object) $bag;
    }

    private static function set(string $key, $value): void
    {
        $_SESSION[$key] = is_null($value) ? null : serialize($value);
    }

    private static function get(string $key, bool $unset = false)
    {
        if (!self::has($key)) {
            return null;
        }

        $t = $_SESSION[$key];

        if ($unset) {
            self::set($key, null);
        }

        return unserialize($t);
    }

    private static function has(string $key): bool
    {
        return array_key_exists($key, $_SESSION) &&  boolval($_SESSION[$key]);
    }
}
