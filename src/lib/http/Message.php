<?php

namespace src\lib\http;

class Message
{
    private const SUCCESS = '<strong>Success:</strong>';
    private const ERROR = '<strong>Error:</strong>';

    public static function emptyFields(): string
    {
        return sprintf('%s there are empty fields. Try again.', self::ERROR);
    }

    public static function invalidCredentials(): string
    {
        return sprintf('%s could not grant access, invalid credential. Try again!', self::ERROR);
    }

    public static function wasCreated($text): string
    {
        return sprintf('%s %s was created', self::SUCCESS, $text);
    }

    public static function cannotCreate($text): string
    {
        return sprintf('%s cannot create %s', self::ERROR, $text);
    }

    public static function wasDestroyed($text): string
    {
        return sprintf('%s %s was destroyed', self::SUCCESS, $text);
    }

    public static function cannotDestroy($text): string
    {
        return sprintf('%s cannot destroy %s', self::ERROR, $text);
    }

    public static function wasUpdated($text): string
    {
        return sprintf('%s %s was updated', self::SUCCESS, $text);
    }

    public static function cannotUpdate($text): string
    {
        return sprintf('%s cannot update %s', self::ERROR, $text);
    }
}
