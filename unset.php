<?php
    session_start();
    $_SESSION['username'] = null;
    $_SESSION['role'] = null;
    session_unset();

    // destroy the session
    session_destroy();
    header('location: login.php')
    ?>