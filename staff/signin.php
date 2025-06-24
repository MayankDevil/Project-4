<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/signin.php
-   Description: application 
-->
<html lang="en">

<head>

    <?php require("../main.php"); ?>

</head>

<body>

    <!-- form frame -->
    <div class="container-fluid">

        <div class="row">

            <div class="col-lg-6 col-md-8 col-12 offset-lg-3 offset-md-2 offset-0">

                <form action="#" class="border my-5 p-3">
                    <!-- form title -->
                    <div class="h3 py-2"> Singin Form </div>
                    <!-- username field for text data -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter First Name </label>
                        <input type="text" name="first_name" id="" class="form-control my-2">
                        <div class="text-muted"> Your original name in text keep private </div>
                    </div>
                    <!-- username field for text data -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Last Name </label>
                        <input type="text" name="last_name" id="" class="form-control my-2">
                        <div class="text-muted"> Your original name in text keep private </div>
                    </div>
                    <!-- username field for text data -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Username </label>
                        <input type="text" name="username" id="" class="form-control my-2">
                        <div class="text-muted"> Public name show in website only text </div>
                    </div>
                    <!-- password field for encoded data -->
                    <div class="form-group my-3">
                        <label for="" class="py-2"> Enter Passwrod </label>
                        <input type="password" name="password" id="" class="form-control my-2">
                        <div class="text-muted"> Used number, letter, symbols for strong password </div>
                    </div>
                    <!-- email field for email data -->
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
                            <select class="form-select" aria-label="Default select example">
                                <option value="0" selected>User</option>
                                <option value="1">Admin</option>
                            </select>
                        </div>
                        <div class="text-muted"> For Security, if join as admin your default account is disable </div>
                    </div>

                    <!-- button group -->
                    <div class="btn-group w-100 py-2">
                        <!-- submit button to send data -->
                        <input type="submit" value="Join Know" class="btn btn-dark">
                        <!-- reset button to clear data -->
                        <input type="reset" value="Clear" class="btn btn-outline-danger">

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