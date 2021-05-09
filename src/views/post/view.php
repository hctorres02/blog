<main>
    <h1><?= $post->title ?></h1>
    <h5>
        &mdash;&nbsp;
        <a href="?c=posts&m=categories&id=<?= $post->category_id ?>">
            <?= $post->category ?>
        </a>
        , <?= $post->author ?>
    </h5>
    <p><?= nl2br($post->body) ?></p>
</main>