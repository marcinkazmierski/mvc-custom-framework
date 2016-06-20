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
    foreach ($content as $row) {
        echo '<li>' . $row['id'] . ': ' . $row['login'] . '</li>';
    }
    echo '</ul>';
    ?>
</div>