<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/register.php
-   Description: register new user in database 
-->
<html lang="en">

<head>

    <?php require("../main.php"); ?>

    <?php

        /* on signin button submit */

        if (isset($_REQUEST['signin_submit'])) {

            $first_name = $_REQUEST['first_name'];
            $last_name = $_REQUEST['last_name'];
            $email = $_REQUEST['email'];
            $contact = $_REQUEST['contact'];
            $role = $_REQUEST['role'];
            $username = $_REQUEST['username'];
            $passcode = md5($_REQUEST['passcode']);


            if (empty($first_name) || empty($email) || empty($contact) || empty($username == null) || empty($passcode)) {

                echo "<div class='alert alert-danger w-25 m-2 mx-auto'> Field is Empty? </div>";

            } else {

                if ($last_name == '') {

                    $last_name = null;
                }

                require_once("modal.php");

                if (DB_Modal::is_password_strong($passcode)) {
                
                    $result = DB_Modal::register($first_name, $last_name, $email, $contact, $role, $username, $passcode);

                    echo "<div class='alert alert-success w-25 m-2 mx-auto'> " . $result . " </div>";

                    // if (mysqli_num_rows($result) > 0) 
                    // {
                    // } 
                    // else 
                    // {
                    //     echo "<div class='alert alert-danger w-25 m-2 mx-auto'> ERROR Data is Not Inserted </div>";
                    // }
                    
                } else {
                    
                    echo "<div class='alert alert-danger w-25 m-2 mx-auto'> Password is Not Strong? </div>";
                }
            }
        }
        
    ?>

</head>

<body>

    <!-- form frame -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6 col-md-8 col-12 offset-lg-3 offset-md-2 offset-0">

                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" class="border my-5 p-3">
                    <!-- form title -->
                    <div class="h3 py-2"> Singin Form </div>
                    <!-- -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter First Name </label>
                        <input type="text" name="first_name" id="" class="form-control my-2">
                        <div class="text-muted"> Your original name in text keep private </div>
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Last Name </label>
                        <input type="text" name="last_name" id="" class="form-control my-2">
                        <div class="text-muted"> Your original name in text keep private </div>
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Username </label>
                        <input type="text" name="username" id="" class="form-control my-2">
                        <div class="text-muted"> Public name show in website only text </div>
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Passwrod </label>
                        <input type="password" name="passcode" id="" class="form-control my-2">
                        <div class="text-muted"> Used number, letter, symbols for strong password </div>
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Email-ID </label>
                        <input type="email" name="email" id="" class="form-control my-2">
                        <div class="text-muted"> Used active personal email </div>
                    </div>
                    <!-- contact field for number data -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Contact </label>
                        <input type="tel" name="contact" id="" class="form-control my-2">
                        <div class="text-muted"> Used active recharged number to get OPT </div>
                    </div>
                    <!-- caption for secure -->
                    <div class="form-group my-5">
                        <div class="d-flex">
                            <label for="" class="py-2  w-50"> Join As </label>
                            <select name="role" class="form-select" aria-label="Default select example">
                                <option value="0" selected>User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="text-muted"> For Security, if join as admin your default account is disable </div>
                    </div>

                    <!-- button group -->
                    <div class="btn-group w-50 py-2">
                        <!-- submit button to send data -->
                        <input type="submit" value="Submit" name="signin_submit" class="btn btn-dark">
                        <!-- reset button to clear data -->
                        <input type="reset" value="Clear All" class="btn btn-outline-dark">

                    </div>

                </form>

            </div>

        </div>

        <div class="row mx-auto d-block w-lg-100 w-md-75 w-50">

        </div>

    </div>

    <?php include("../footer.php"); ?>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->