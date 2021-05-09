<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@1.2.1/css/pico.classless.min.css">
    <link rel="stylesheet" href="assets/custom.css">
    <title><?= $pageTitle ? "{$pageTitle} :: {$defaultTitle}" : $defaultTitle ?></title>
</head>

<body>
    <?php if (!$isError) : ?>
        <header>
            <hgroup>
                <h1>SlimCRUD</h1>
                <h2>Another PHP CRUD</h2>
            </hgroup>
            <nav>
                <ul>
                    <li><a href="./">Home</a></li>
                    <li><a href="?c=posts">Posts</a></li>
                    <li><a href="?c=posts&m=categories">Categories</a></li>
                </ul>
                <ul>
                    <?php if (isset($user)) : ?>
                        <li><?= $user->name ?> (<?= $user->email ?>)</li>
                        <li><a href="?c=auth&m=logout" onclick="return confirm('Confirm log out')">Log out</a></li>
                    <?php else : ?>
                        <li>Hello, Guest</li>
                        <li><a href="?c=auth&m=login">Log in</a></li>
                    <?php endif ?>
                </ul>
            </nav>
        </header>
    <?php endif; ?>
    <?php include $viewPath; ?>
    <footer>
        <p>&copy; 2021 HC. Torres</p>
        <p><a href="https://github.com/hctorres02" target="_blank">GitHub</a></p>
    </footer>
    <script src="assets/app.js"></script>
</body>

</html>