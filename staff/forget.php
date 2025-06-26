<?php 

    session_start(); 

    if (isset($_SESSION["userename"]) && isset($_SESSION["user_role"]))
    {
        header("Location:dashboard.php");
    }
?>
<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/forget.php
-   Description: forget login field remainder 
-->
<html lang="en">

<head>

    <?php require("../main.php"); ?>

    <?php

        /* on signin button submit */

        if (isset($_REQUEST['forget_submit'])) {

            $first_name = $_REQUEST['first_name'];
            $email = $_REQUEST['email'];

            if (empty($first_name) || empty($email)) {

                echo "<div class='alert alert-danger w-25 m-2 mx-auto'> Field is Empty? </div>";

            } else {

                require_once("modal.php");
                
                $output = DB_Modal::forget($first_name, $email);
                
                if ($output) 
                {
                    header("Location:login.php");
                } 
                else 
                {
                    echo "<div class='alert alert-danger w-25 m-2 mx-auto'> Error : Problem in mail! </div>";
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
                    <div class="h3 py-2"> Forget Login Field </div>
                    <!-- -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter First Name </label>
                        <input type="text" name="first_name" id="" class="form-control my-2">
                        <div class="text-muted"> Your original name in text keep private </div>
                    </div>
                    <!--  -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Email-ID </label>
                        <input type="email" name="email" id="" class="form-control my-2">
                        <div class="text-muted"> Used active personal email </div>
                    </div>

                    <!-- button group -->
                    <div class="btn-group w-50 py-2">
                        <!-- submit button to send data -->
                        <input type="submit" value="Submit" name="forget_submit" class="btn btn-dark">
                        <!-- reset button to clear data -->
                        <a href="login.php" class="btn btn-outline-dark"> Go Back <span class="bi bi-arrow-right text-info"></span> </a>

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