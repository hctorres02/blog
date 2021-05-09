<?php

namespace src\controllers;

use src\lib\http\Message;
use src\lib\http\Request;
use src\lib\http\Session;
use src\lib\Page;
use src\lib\Utils;
use src\models\Category;
use src\models\Post;

class PostController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $posts = Post::all();
        $data = compact('user', 'message', 'posts');

        if ($user) {
            Page::view('Posts', 'admin/post/index', $data);
        }

        Page::view('Posts', 'post/index', $data);
    }

    /**
     * @param int $pid
     * @return void
     */
    public function view($pid): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $post = Post::findBy('p.id', $pid, false);

        if (!$post) {
            Request::notFound();
        }

        $data = compact('user', 'message', 'post');

        Page::view($post->title, 'post/view', $data);
    }

    /**
     * @return void
     */
    public function create(): void
    {
        $post = Session::getBag();

        self::editor('Create post', 'create', $post);
    }

    /**
     * @return void
     */
    public function doCreate(): void
    {
        $fields = Request::getBody('title', 'body', 'active', 'category_id');
        $fields['author_id'] = Session::getUser()->id;

        if (Utils::hasEmpty($fields)) {
            Request::redirectTo('posts/create', Message::emptyFields(), $fields);
        }

        if ($pid = Post::create($fields)) {
            Request::redirectTo("posts/edit/{$pid}", Message::wasCreated("Post #{$pid}"));
        }

        Request::redirectTo("posts/editor", Message::cannotCreate('post'), $fields);
    }

    /**
     * @param int $pid
     * @return void
     */
    public function edit($pid): void
    {
        if (!Session::hasUser()) {
            Request::unauthorized();
        }

        $post = Session::getBag() ?: Post::findBy('p.id', $pid, false);

        if (!$post) {
            Request::notFound();
        }

        self::editor('Edit post', 'edit', $post);
    }

    /**
     * @param int $pid
     * @return void
     */
    public static function doEdit($pid): void
    {
        if (!Session::hasUser()) {
            Request::unauthorized();
        }

        $href = "posts/edit/{$pid}";
        $fields = Request::getBody('title', 'body', 'active', 'category_id');

        if (Utils::hasEmpty($fields)) {
            Request::redirectTo($href, Message::emptyFields(), $fields);
        }

        if (!Post::findBy('p.id', $pid)) {
            Request::notFound();
        }

        if (!Post::update($pid, $fields)) {
            Request::redirectTo($href, Message::cannotUpdate("post {$pid}"), $fields);
        }

        Request::redirectTo($href, Message::wasUpdated("post"));
    }
    /**
     * @param int $pid
     * @return void
     */
    public function destroy($pid): void
    {
        if (!Post::findBy('p.id', $pid)) {
            Request::notFound();
        }

        if (!Post::destroy($pid)) {
            Request::redirectTo('posts', Message::cannotDestroy("post {$pid}"));
        }

        Request::redirectTo('posts', Message::wasDestroyed("Post #{$pid}"));
    }

    /**
     * @param string $pageTitle
     * @param string $mode
     * @param Post $post
     */
    private static function editor($pageTitle, $mode, $post): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $categories = Category::all();
        $data = compact('user', 'message', 'post', 'categories', 'mode');

        Page::view($pageTitle, 'admin/post/editor', $data);
    }
}
