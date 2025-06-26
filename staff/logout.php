<?php
    /**
     * 
     * File: staff/logout.php
     */

    session_start();

    session_unset();

    session_destroy();

    header("Location: login.php");
?>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->
