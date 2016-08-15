<section>
    <h2>
        <?php if (isset($content['auth']) && $content['auth'] === true): ?>
            You are logged
        <?php else: ?>
            You are not logged
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