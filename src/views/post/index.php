<main>
    <h2><?= $pageTitle ?></h2>
    <?php if ($posts) : ?>
        <?php foreach ($posts as $post) : ?>
            <section id="post_<?= $post->id ?>">
                <h3>
                    <a href="?c=posts&id=<?= $post->id ?>">
                        <?= $post->title ?>
                    </a>
                </h3>
                <h5>
                    &mdash;&nbsp;
                    <a href="?c=posts&m=categories&id=<?= $post->category_id ?>">
                        <?= $post->category ?>
                    </a>
                    , <?= $post->author ?>
                </h5>
                <p><?= $post->body ?></p>
            </section>
        <?php endforeach; ?>
    <?php else : ?>
        <p>No posts yet.</p>
    <?php endif; ?>
</main>