<header id="header">

    <?php

    require("staff/modal.php");

    $login_username = 'User';

    $subtitle = "Creating an account is free and easy on this site So Please <a href='" . BASE_URL . "/staff/register.php' class='badge rounded-pill bg-light text-decoration-none texts-red'> Register </a>";

    if (isset($_SESSION['username']) && isset($_SESSION['user_id']) && isset($_SESSION['user_role'])) {

        $login_username = $_SESSION['username'];

        $return_output = DB_Modal::countThe('USER_POSTS', $_SESSION['user_id']);

        if (is_array($return_output) && isset($return_output['TOTAL_USER_POSTS']) && $return_output['TOTAL_USER_POSTS'] > 0) {
            $total = $return_output['TOTAL_USER_POSTS'];
            $subtitle = "You’ve written <strong>$total</strong> " . ($total == 1 ? "post" : "posts") . ". Keep it up!";
        } else {
            $subtitle = "You haven't posted anything yet. Start sharing your thoughts with the world!";
        }
    }

    ?>

    <div class="container-fluid py-5 banner">
        <div class="container py-4">
            <div class="row d-flex align-items-center">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="brand-name lead text-light text-decoration-none"> Welcome <?php echo $login_username; ?> in Simriti </a>
                        </div>
                        <div class="col-12 text-light"> <?= $subtitle ?> </div>
                    </div>
                </div>
                <div class="col text-end">
                    <?php

                    $logname = (!isset($_SESSION["userename"]) && !isset($_SESSION["user_id"])) ? "login" : "logout";

                    $log = (!isset($_SESSION["userename"]) && !isset($_SESSION["user_id"])) ? "login" : "logout";

                    $log = BASE_URL . "staff/" . $log . ".php";

                    ?>

                    <a href="<?php echo $log; ?>" class="btn btn-outline-light"> <?php echo $logname; ?> </a>

                </div>
            </div>
        </div>
    </div>

    <?php

    if (isset($_SESSION['user_id']) && isset($_SESSION['username'])) {

    ?>

        <div class="container-fluid bg-light">
            <div class="container">
                <nav class="" id="navbar">

                    <a href="<?= BASE_URL ?>" class="btn btn-sm btn-outline-secondary link" id=""> Home </a>

                    <a href="<?= BASE_URL ?>staff/posts.php" class="btn btn-sm btn-outline-secondary link" id=""> Posts </a>

                    <?php

                    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 1) {

                    ?>
                        <a href="<?= BASE_URL ?>staff/categories.php" class="btn btn-sm btn-outline-secondary link" id=""> Categories </a>
                        <a href="<?= BASE_URL ?>staff/users.php" class="btn btn-sm btn-outline-secondary link" id=""> Users </a>
                        <a href="<?= BASE_URL ?>staff/db_backup.php" class="btn btn-sm btn-outline-secondary link" title="on click save database backup" id="backup_btn"> Backup </a>

                    <?php } ?>

                </nav>
            </div>
        </div>

    <?php } ?>

</header>