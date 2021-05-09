<main>
    <h2><?= $pageTitle ?></h2>
    <p><a href="?c=posts&m=create">Create post</a></p>
    <?php if ($message) : ?>
        <p><mark><?= $message ?></mark></p>
    <?php endif; ?>
    <?php if ($posts) : ?>
        <div>
            <table role="grid">
                <thead>
                    <tr>
                        <th>Post title</th>
                        <th colspan="3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    /**
                     * @var \src\models\Post $p
                     */
                    foreach ($posts as $p) : ?>
                        <tr>
                            <td style="width: 80%">
                                <?= $p->title ?>
                            </td>
                            <td style="text-align: center; width: fit-content;">
                                <a href="?c=posts&id=<?= $p->id ?>">&#128065;</a>
                            </td>
                            <td style="text-align: center;">
                                <a href="?c=posts&m=edit&id=<?= $p->id ?>">&#x270E;</a>
                            </td>
                            <td style="text-align: center;">
                                <a href="?c=posts&m=destroy&id=<?= $p->id ?>" onclick="return confirmDelete(<?= $p->id ?>, '<?= $p->title ?>')">&#x1F5D1;</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p>No posts yet.</p>
    <?php endif; ?>
</main>