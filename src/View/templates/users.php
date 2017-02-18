<div class="users">
    <?php
    echo '<ul>';
    /** @var \Cqrs\Query\ViewObject\UserView $user */
    foreach ($content['users'] as $user) {
        echo '<li>' . $user->getId() . ', ' . $user->getEmail() . ', ' . $user->getUsername() . '</li>';
    }
    echo '</ul>';
    ?>
</div>