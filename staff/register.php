<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/register.php
-   Description: register new user in database 
-->

<?php session_start(); ?>

<html lang="en">
    
<head>

    <?php require("../main.php"); ?>

    <?php

        if (isset($_SESSION['username']) && isset($_SESSION['user_id'])) {

            header('Location:'. BASE_URL);
            exit('USER IS LOGIN!');
        }

        /* on signin button submit */

        if (isset($_REQUEST['signin_submit'])) {

            $first_name = $_REQUEST['first_name'];
            $last_name = $_REQUEST['last_name'];
            $email = $_REQUEST['email'];
            $contact = $_REQUEST['contact'];
            $role = $_REQUEST['role'];
            $username = $_REQUEST['username'];
            $passcode = md5($_REQUEST['passcode']);


            if (empty($first_name) || empty($email) || empty($contact) || empty($username) || empty($passcode)) {

                echo "<div class='alert alert-danger w-25 m-2 mx-auto'> Field is Empty? </div>";

            } else {

                if ($last_name == '') $last_name = null;
    
                require_once("modal.php");

                if (DB_Modal::is_password_strong($passcode)) {
                
                    $result = DB_Modal::register($first_name, $last_name, $email, $contact, $role, $username, $passcode);

                    echo "<div class='alert alert-success w-25 m-2 mx-auto'> " . $result . " </div>";

                } else {
                    
                    echo "<div class='alert alert-danger w-25 m-2 mx-auto'> Password is Not Strong? </div>";
                }
            }
        }
        
    ?>

</head>

<body class="bgs-white">

    <div class="container">
        <div class="row">

            <div class="col d-grid align-items-center">

                <div class="" id="">
                    <div class="h3 py-2"> Registeration Form </div>
                    <p class="text-muted"> For Security Purpose, if join as admin your default account is disable </p>
                    <p>  Go back to <a href="<?=BASE_URL?>" class="badge pill-rounded bgs-brown text-decoration-none"> Home </a> page </p>
                    
                </div>

            </div>

            <div class="col">

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="shadow p-3 pattern" id="register_form">
                    <!-- -->
                    <div class="form-group mb-3">
                        <label for="" class="py-2"> Enter First Name </label>
                        <input type="text" name="first_name" id="" class="form-control my-2" placeholder="Your original name in text keep private">
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Last Name </label>
                        <input type="text" name="last_name" id="" class="form-control my-2" placeholder="Your original name in text keep private">
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Username </label>
                        <input type="text" name="username" id="" class="form-control my-2" placeholder="Public name show in website only text">
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Passwrod </label>
                        <input type="password" name="passcode" id="" class="form-control my-2" placeholder="Used number, letter, symbols for strong password">
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Email-ID </label>
                        <input type="email" name="email" id="" class="form-control my-2" placeholder="active personal email">
                    </div>
                    <!-- contact field for number data -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Contact </label>
                        <input type="tel" name="contact" id="" class="form-control my-2" placeholder="active recharged number to get OPT">
                    </div>
                    <!-- caption for secure -->
                    <div class="form-group my-3 d-flex">
                        <label for="" class="py-2  w-50"> Join As </label>
                        <select name="role" class="form-select" aria-label="Default select example">
                            <option value="0" selected>User</option>
                            <option value="1">Admin</option>
                        </select>
                    </div>

                    <!-- button group -->
                    <div class=" w-50 py-2">
                        <!-- submit button to send data -->
                        <input type="submit" value="Submit" name="signin_submit" class="btn btn-sm btn-dark">
                        <!-- reset button to clear data -->
                        <input type="reset" value="Clear All" class="btn btn-sm btn-outline-dark">

                    </div>

                </form>

            </div>
        </div>
    </div>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->