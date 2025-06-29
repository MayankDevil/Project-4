<?php

    session_start();

    if (!isset($_SESSION["userename"]) || !isset($_SESSION["user_role"])) {

        header("Location:logout.php");
    }
    else {
        require('modal.php');
    }

    if (isset($_GET['user_id']) && isset($_GET['action'])) {
    
        $userid = intval($_GET['user_id']);
        $action = intval($_GET['action']);

        if ($action === 0 || $action === 1) {
        
            $output = DB_Modal::grant($userid, $action);

            if ($output) {
                header("Location: dashboard.php?page_num=1");
                exit;
            }
        }
    }

?>