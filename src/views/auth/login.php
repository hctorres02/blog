<main>
    <h2><?= $pageTitle ?></h2>
    <?php if ($message) : ?>
        <p>
            <mark>
                <?= $message ?>
            </mark>
        </p>
    <?php endif; ?>
    <form method="post">
        <label>
            Email
            <input type="email" name="email" tabindex="1" value="<?= $bag->email ?? '' ?>" placeholder="john.doe@example.com">
        </label>
        <label>
            Password
            <input type="password" name="password" tabindex="2" placeholder="******">
        </label>
        <input type="submit" value="Log in" tabindex="3">
    </form>
</main>