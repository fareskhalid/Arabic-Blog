<?php
    session_start();
    if (isset($_SESSION['admin_is_in'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
    }