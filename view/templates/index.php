<section>
    <h2>
        <?php
        if (!empty($_SESSION['auth']) && $_SESSION['auth'] == TRUE) {
            echo 'You are logged in';
        } else {
            echo '<b>You are not logged in</b>';
        }
        ?>
    </h2>
</section>


<div class="users">
    <?php
    echo '<ul>';
    foreach ($content as $user) {
        echo '<li>' . $user->id . ': ' . $user->login . '</li>';
    }
    echo '</ul>';
    ?>
</div>