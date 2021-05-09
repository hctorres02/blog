<?php

namespace src\controllers;

use src\lib\http\Request;
use src\lib\Page;
use src\lib\http\Session;
use src\models\Category;
use src\models\Post;

class CategoryController
{
    /**
     * @return void
     */
    public function index(): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $categories = Category::all(!Session::hasUser());
        $data = compact('user', 'message', 'categories');

        Page::view('Categories', 'category/index', $data);
    }

    /**
     * @param int $cid
     * @return \src\models\Post[]|null
     */
    public function view($cid): void
    {
        $user = Session::getUser();
        $message = Session::getMessage();
        $category = Category::findBy('c.id', $cid, false);

        if (!$category) {
            Request::redirectTo('error/404');
        }

        $posts = Post::findBy('p.category_id', $cid);
        $data = compact('user', 'message', 'posts');

        if ($user) {
            Page::view("Posts ({$category->title})", 'admin/post/index', $data);
        }

        Page::view("Posts ({$category->title})", 'post/index', $data);
    }
}
