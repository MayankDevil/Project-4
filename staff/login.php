<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/login.php
-   Description: login for staff and user
-->

<?php

session_start();

if (isset($_SESSION["username"]) && isset($_SESSION["user_id"])) {
    header('Location:posts.php');
    exit;
}

?>


<html lang="en">

<head>

    <?php require("../main.php"); ?>

</head>

<body class="bgs-white">

    <div class="container">
        <div class="row">

            <div class="col-md-6 col-sm-6 col-12 bg-light py-5 vh-100 bg-hex">

                <div class="text-light" id="">

                    <div class="h1 p-2">If you're not registered on this site, please sign up first before logging in. Creating an account is free and easy. </div>

                    <div class="p-2 text-end">
                        <a href="register.php" class="btn btn-lg btn-outline-light"> Register Know! </a>
                    </div>

                    <div class="h3 p-2"> else you go back to <a href="<?= BASE_URL ?>" class="btn btn-danger"> Home </a> </div>


                </div>

            </div>

            <div class="col"></div>

            <div class="col-md-5 col-sm-6 col-12 pt-md-5 pt-sm-3 pt-0 my-5">

                <?php

                /* on login button click */

                if (isset($_REQUEST['login_submit'])) {

                    $username = $_REQUEST['username'];
                    $password = md5($_REQUEST['password']);

                    if (empty($username) || empty($password)) {

                        echo "<div class='alert alert-danger w-100 m-2 mx-auto'> Field is Empty </div>";
                    } else {

                        require("modal.php");

                        $return_output = DB_Modal::login($username, $password);

                        if (!$return_output || is_string($return_output)) {

                            echo "<div class='alert alert-danger w-100 m-2 mx-auto'> $return_output </div>";
                        } else if ($return_output && is_array($return_output)) {

                            // print_r($return_output); die;

                            if ($return_output['isSafe']) {

                                $_SESSION['user_id'] = $return_output["user_id"];
                                $_SESSION['username'] = $return_output["username"];
                                $_SESSION['user_role'] = $return_output["user_role"];
                            }
                            header('Location:' . BASE_URL . 'staff/posts.php');
                            exit;
                        }
                    }
                }
                ?>

                <form action="<?php $_SERVER['PHP_SELF']; ?>" class="p-3 bgs-light border rounded">

                    <div class="h3 py-3"> Login </div>

                    <p class="text-secondary py-3">This is the login page. If you are a registered user, please enter your username and password to sign in. </p>

                    <!-- username -->
                    <div class="form-floating mb-3">
                        <!-- text field -->
                        <input type="text" name="username" id="sign_username_field" placeholder="Enter Username" class="form-control">

                        <label for="sign_username_field"> Email/Username </label>

                        <!-- username feedback -->
                        <div id="sign_username_feedback" class=""></div>

                    </div>
                    <!-- password -->
                    <div class="form-floating mb-3">
                        <!-- password field -->
                        <input type="password" name="password" id="sign_password_field" placeholder="Enter Password" class="form-control">

                        <label for="sign_password_field"> Password </label>

                        <!-- password feedback -->
                        <div id="sign_password_feedback" class=""></div>

                    </div>
                    <!-- submit & reset button -->
                    <div class="row">
                        <!-- forget button -->
                        <div class="p-3">
                            <a href="forget.php" class="d-block text-dark text-decoration-none">  if you forget your login detail click here? </a>
                        </div>
                        <!-- submit buttom -->
                        <div class="text-end">
                            <input type="submit" value="Login" name="login_submit" id="login_submit_button" class="btn btn-dark px-5 py-2">
                        </div>
                    </div>
                </form>

            </div>

        </div>
    </div>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->