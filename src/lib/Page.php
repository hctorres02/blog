<?php

namespace src\lib;

class Page
{
    /**
     * @param string|null $pageTitle
     * @param string $viewPath
     * @param array $data
     * @param bool $isError
     * @return void
     */
    public static function view($pageTitle, $viewPath, $data = [], $isError = false): void
    {
        extract($data);

        $cwd = getcwd() . '/..';
        $layout = "{$cwd}/src/layout/page.php";
        $viewPath = "{$cwd}/src/views/{$viewPath}.php";
        $defaultTitle = $_ENV['app']['default_pagetitle'];

        ob_start();
        include $layout;
        ob_end_flush();

        exit;
    }

    public static function setPageTitle(?string $pageTitle): string
    {
        $default = $_ENV['app']['default_pagetitle'];

        if ($pageTitle) {
            return "{$pageTitle} :: {$default}";
        }

        return $default;
    }
}
