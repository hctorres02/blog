<?php

namespace src\lib\http;

class Request
{
    public static function isPost(): bool
    {
        return self::getMethod() == 'POST';
    }

    public static function getMethod(): string
    {
        return filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    }

    public static function getPath(): string
    {
        return '/' . implode('/', self::buildPath());
    }

    public static function getBody(string ...$fields): array
    {
        foreach ($fields as $field) {
            $data[$field] = trim(filter_input(INPUT_POST, $field));
        }

        return $data;
    }

    public static function getId(): ?string
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        $id = is_numeric($id) ? (int) $id : null;

        return $id;
    }

    public static function getController(string $default): string
    {
        return self::getParam('c', $default);
    }

    public static function getMode(?string $default): ?string
    {
        return self::getParam('m', $default);
    }

    /**
     * @param string $loc
     * @param string $message
     * @param array $bag
     * @return never
     */
    public static function redirectTo($loc, string $message = null, $bag = [])
    {
        if ($message) {
            Session::setMessage($message);
        }

        if ($bag) {
            Session::setBag($bag);
        }

        $loc = self::buildLocation($loc);

        header("Location: ./?{$loc}");
        exit;
    }

    /**
     * @return never
     */
    public static function unauthorized()
    {
        self::redirectTo('error/401');
    }

    /**
     * @return never
     */
    public static function notFound()
    {
        self::redirectTo('error/404');
    }

    /**
     * @return never
     */
    public static function notAllowed()
    {
        self::redirectTo('error/405');
    }

    private static function getParam(string $field, string $defaultValue = null)
    {
        $param = filter_input(INPUT_GET, $field);

        if (empty($param)) {
            return $defaultValue;
        }

        return $param;
    }

    private static function buildPath(): array
    {
        $parts = [
            self::getController(''),
            self::getMode(null),
            self::getId()
        ];

        $path = array_filter($parts, function ($e) {
            return $e != '' || !is_null($e);
        });

        return $path;
    }

    private static function buildLocation(string $loc): string
    {
        $loc = explode('/', $loc);
        $base = [
            'c' => $loc[0] ?? null,
            'm' => $loc[1] ?? null,
            'id' => $loc[2] ?? null
        ];

        return http_build_query($base);
    }
}
