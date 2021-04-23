<section>
    <h1>
        <?php print t('hello'); ?>
    </h1>
    <h2>
        <?php if (isset($content['auth']) && $content['auth'] === true): ?>
            <?php print t('You are logged'); ?>
        <?php else: ?>
            <?php print t('You are not logged'); ?>
        <?php endif; ?>
    </h2>
</section>


<div class="users">
    <?php
    echo '<ul>';
    foreach ($content['users'] as $user) {
        echo '<li>' . $user->id . ': ' . $user->login . '</li>';
    }
    echo '</ul>';
    ?>
</div>