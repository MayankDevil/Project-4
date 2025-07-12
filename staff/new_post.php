<?php

session_start();

if (!isset($_SESSION["userename"]) && !isset($_SESSION["user_id"])) {

    header("Location:logout.php");
    exit("logout");
}

require_once("modal.php");

?>
<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/new_post.php
-   Description: new post on site 
-->
<html lang="en">

<head>

    <?php require("../main.php"); ?>

    <?php

    # on new post submit

    if (isset($_REQUEST['new_post_submit'])) {

        $user_id = $_SESSION['user_id'];
        $title = $_REQUEST['post_title'];
        $description = $_REQUEST['post_description'];
        $categorie_id = $_REQUEST['categorie_type'];
        $upload = null;

        # if is file set and no error then check type or size then move file

        if (isset($_FILES['post_image']) && ($_FILES['post_image']['error'] === 0)) {

            if (in_array($_FILES['post_image']['type'], ['image/png', 'image/jpeg', 'image/jpg', 'image/svg'])) {

                if ($_FILES['post_image']['size'] < (500 * 1024 * 1024)) {

                    $upload_folder = BASE_URL . 'image/';

                    if (!is_dir($upload_folder)) {

                        mkdir($upload_folder, 0777, true);
                    }
                    $upload_file = time() . "_" . basename($_FILES['post_image']['name']);

                    $upload = $upload_folder . $upload_file; // set upload value

                    if (!move_uploaded_file($_FILES['post_image']['tmp_name'], $upload)) {

                        echo ("<div class='alert alert-danger w-25 m-2 mx-auto'> ERROR : file is unuploaded! </div>");
                    }
                }
            }
        } else {

            echo ("<div class='alert alert-danger w-25 m-2 mx-auto'>" . $_FILES['post_image']['error'] . " </div>");
        }

        if (empty($title) || empty($description) || empty($upload) || empty($user_id) || empty($categorie_id)) {

            echo "<div class='alert alert-danger w-25 m-2 mx-auto'> All field Reuired </div>";
        } else {

            require_once("modal.php");

            $result = DB_Modal::set_post($title, $description, $upload, $user_id, $categorie_id);

            if ($result) {

                echo "<div class='alert alert-success w-25 m-2 mx-auto'> $result </div>";
            }
        }
    }

    ?>

</head>

<body class="bgs-white">

    <!-- form frame -->
    <div class="container-fluid">
        <div class="container">
            <div class="row">

                <div class="col-4 postwoman vh-100">
                
                    <div class="bgs-light my-5 p-2 rounded shadow-lg">

                        <h1 class="display-5"> <?= $_SESSION['username'] ?> Write Someting new that make your simriti. </h1>

                        <a href="<?= BASE_URL ?>" class="btn btn-main mt-5"> GO BACK </a>
                    </div>
                    
                    <time class="d-block bg-light w-100 my-5 p-2 rounded shadow" id="timer"></time>

                    
                
                </div>

                <div class="col p-5">

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" enctype="multipart/form-data" class="bg-white p-3 border" id="new_post_form">
                        <!--  -->
                        <div class="form-floating mb-3">
                            <input type="text" name="post_title" class="form-control" id="post_title" placeholder="">
                            <label for="post_title" class=""> Title </label>
                        </div>

                        <div class="form-floating">
                            <textarea name="post_description" class="form-control" id="post_description"
                                placeholder=""></textarea>
                            <label for="post_description" class=""> Write less then 300 words </label>
                        </div>

                        <!-- -->
                        <div class="mb-3">
                            <label for="post_image" class="form-label"></label>
                            <input type="file" name="post_image" class="form-control" id="post_image" placeholder="">
                        </div>

                        <!-- caption for secure -->
                        <div class="form-group my-3">
                            <div class="d-flex">
                                <label for="" class="py-2  w-50"> Categories </label>
                                <select name="categorie_type" class="form-select" aria-label="Default select example">
                                    <?php

                                    $categorie_list = DB_Modal::get_categories();

                                    if ($categorie_list && is_array($categorie_list)) {
                                        if (count($categorie_list) > 0) {
                                            foreach ($categorie_list as $list_item) {

                                                echo "<option value='" . $list_item['category_id'] . "' selected> " . $list_item['category_type'] . " </option>";
                                            }
                                        } else {
                                            echo "<div class='alert alert-warning w-50 m-3 mx-auto'> user table is empty </div>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-danger w-50 m-3 mx-auto'> $categorie_list </div>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <!-- button group -->
                        <div class="btn-group w-25 py-2">
                            <!-- submit button to send data -->
                            <button type="submit" name="new_post_submit" class="btn btn-dark" id="new_post_submit"><span
                                    class='bi bi-post'></span> New Post</button>

                        </div>

                    </form>

                </div>
            
            </div>
        </div>
    </div>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->