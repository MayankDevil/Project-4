<header  id="header">

    <?php
    
        $login_username = isset($_SESSION['username'])? $_SESSION['username'] :'User';
    
    ?>

    <div class="container-fluid py-5 banner">
        <div class="container py-4">
            <div class="row d-flex align-items-center">
                <div class="col">
                    <div class="row">
                        <div class="col-12">
                            <a href="#" class="brand-name lead text-light text-decoration-none"> Welcome <?php echo $login_username; ?> in Simriti </a>
                        </div>
                        <div class="col-12 text-light"> Lorem ipsum dolor, sit amet consectetur adipisicing elit. Dolor, nam. </div>
                    </div>
                </div>
                <div class="col text-end">

                    <?php

                        $logname = (!isset($_SESSION["userename"]) && !isset($_SESSION["user_id"]))? "login" : "logout";

                    
                        $log = (!isset($_SESSION["userename"]) && !isset($_SESSION["user_id"]))? "login" : "logout";

                        $log = BASE_URL ."staff/". $log .".php";
                    
                    ?>
                    
                    <a href="<?php echo $log; ?>" class="btn btn-outline-light"> <?php echo $logname; ?> </a>

                </div>
            </div>
        </div>
    </div>

    <?php
    
        if (isset($_SESSION['user_id']) && isset( $_SESSION['username'])) {
    
    ?>

    <div class="container-fluid bg-light">
        <div class="container">
            <nav class="" id="navbar">
                        
                <button class="btn btn-sm btn-outline-secondary link"> Post </button>

                <?php
                
                    if (!isset($_SESSION['user-role'])) {
                
                ?>

                <button class="btn btn-sm btn-outline-secondary link"> Categorie </button>
                <button class="btn btn-sm btn-outline-secondary link"> User </button>

                <?php } ?>

            </nav>
        </div>
    </div>

    <?php } ?>

</header>