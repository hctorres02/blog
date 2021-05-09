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
        <fieldset>
            <label>
                Title
                <input type="text" name="title" tabindex="1" value="<?= $post->title ?? '' ?>">
            </label>
            <label>
                Category
                <select name="category_id" tabindex="2">
                    <option disabled selected>Category</option>
                    <?php foreach ($categories as $c) :
                        echo $selected = $c->id == ($post->category_id ?? '') ? 'selected' : ''; ?>
                        <option value="<?= $c->id ?>" <?= $selected ?>><?= $c->title ?></option>
                    <?php endforeach ?>
                </select>
            </label>
            <label>
                Body
                <textarea name="body" rows="10" tabindex="3"><?= $post->body ?? '' ?></textarea>
            </label>
            <fieldset>
                <label>
                    <input type="radio" name="active" tabindex="4" value="1" <?php if (empty($post) || (isset($post) && $post->active)) echo 'checked' ?>>
                    Active
                </label>
                <label>
                    <input type="radio" name="active" tabindex="5" value="0" <?php if (isset($post) && !$post->active) echo 'checked' ?>>
                    Inactive
                </label>
            </fieldset>
            <input type="submit" value="<?= $mode ?> post" tabindex="6">
        </fieldset>
    </form>
</main>