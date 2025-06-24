<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/login.php
-   Description: login for staff and user
-->
<html lang="en">

<head>

    <?php require("../main.php"); ?>

</head>

<body>

    <div class="container-fluid pt-lg-5 pt-md-3 pt-1">

        <div class="row">
            <div class="col"></div>
            <div class="col-lg-4 col-md-6 col-sm-8 col-12">

                <form class="p-3 border rounded">
        
                    <div class="h4 py-3"> Login Form </div>
                    
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
                        <!-- submit buttom -->
                        <div class="col-md-6 col-100">
                            <input type="button" value="Login" id="login_submit_button" class="btn btn-info px-5 py-2 w-100">
                        </div>
                        <!-- forget button -->
                        <div class="col py-3 text-end">
                            <a href="" class="btn btn-link text-decoration-none"> forget password? </a>
                        </div>
                    
                    </div>

                    <div class="w-100">
                        <a href="signin.php" class="text-decoration-none text-secondary"> Join to SignIn Now! </a>
                    </div>
        
                </form>

            </div>
            <div class="col"></div>
        </div>
        
    </div>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->