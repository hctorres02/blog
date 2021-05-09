<main>
    <h2><?= $pageTitle ?></h2>
    <?php if (count($categories)) : ?>
        <ul>
            <?php foreach ($categories as $category) : ?>
                <li>
                    <a href="?c=posts&m=categories&id=<?= $category->id ?>"><?= $category->title ?></a>
                    <code><?= $category->posts ?></code>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p>No categories yet.</p>
    <?php endif; ?>
</main>