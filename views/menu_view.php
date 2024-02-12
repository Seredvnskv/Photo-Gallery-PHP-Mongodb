<ul>
    <?php  
        if (!empty($_SESSION['user_id'])) {
            echo '<li><a href="/logout">Logout</a></li>';
        } else {
            echo '<li><a href="/login">Login</a></li>';
        }
        echo '<li><a href="/register">Register</a></li>';
        echo '<li><a href="/gallery">View Gallery</a></li>';
        if (!empty($_SESSION['selected_photos'])) {
            echo '<li><a href="/remembered">Remembered Photos</a></li>';
        }
    ?>
</ul>