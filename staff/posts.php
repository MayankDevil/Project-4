<!DOCTYPE html>

<!--
-   Project: "smriti" Project-4 
-   File: staff/posts.php
-   Description: all post data of users
-->

<?php

session_start();

if (!isset($_SESSION["userename"]) && !isset($_SESSION["user_id"])) {

    header("Location:logout.php");
    exit;
}
require("modal.php");

$request_page = isset($_REQUEST['page_num']) ? intval($_REQUEST['page_num']) : 1;

?>

<html lang="en">

<head>

    <?php require("../main.php"); ?>

</head>

<body class="bgs-white">
    <!-- main -->
    <main id="root">

        <?php include("../header.php"); ?>

        <div class="container-fluid">
            <div class="container">

                <!-- POST SECTION -->
                <section class="collapses" id="post_section">
                    <div class="my-5" id="">

                        <div class="w-100 d-flex justify-content-between align-items-center">
                            <h4 class="h4"> POST </h4>

                            <a href="new_post.php" class="btn btn-sm btn-dark"> <span class="bi bi-folder-plus m-1"></span> New Post </a>
                        </div>

                        <table class="table w-100 m-3 mx-auto" id="user_data_table">
                            <thead class="">
                                <tr>
                                    <th class=''> ID</th>
                                    <th class=''> Title </th>
                                    <th class=''> Description </th>
                                    <th class=''> Created </th>
                                    <th class=''> Author </th>
                                    <th class=''> Categories </th>
                                    <th class=''> EDIT </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $total_posts = DB_Modal::countThe('POSTS');

                                $data_count = intval($total_posts['TOTAL_POSTS']);

                                $pages = 3;

                                $page_data_count = ceil($data_count / $pages);

                                $control = ($request_page - 1) * $page_data_count;

                                $output = DB_Modal::get_posts($control, $page_data_count);

                                if ($output && is_array($output)) {
                                    if (count($output) > 0) {
                                        foreach ($output as $row) {

                                            echo "<tr class=''>";
                                            echo "<td class=''>" . $row['id'] . "</td>";
                                            echo "<td class=''>" . $row['title'] . "</td>";
                                            echo "<td class=''>" . $row['description'] . "</td>";
                                            echo "<td class=''>" . $row['created_at'] . "</td>";
                                            echo "<td class=''>" . 'loadinng' . "</td>";
                                            echo "<td class=''>" . 'loadinng' . "</td>";
                                            echo "<td class=''> <a href='#" . $row['id'] . "' class='btn btn-sm btn-dark bi bi-pencil-square'></a> </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<div class='alert alert-warning w-50 m-3 mx-auto'> user table is empty </div>";
                                    }
                                } else {
                                    echo "<div class='alert alert-danger w-50 m-3 mx-auto'> $output </div>";
                                }

                                ?>
                            </tbody>
                        </table>

                        <!-- pagination -->
                        <nav id="pagination">
                            <ul class="pagination">
                                <?php

                                /* previous page */
                                if ($request_page > 1) {

                                    echo "<li class='page-item'>
                                        <a class='page-link' href='?page_num=" . ($request_page - 1) . "' aria-label='Previous'>
                                            <span class='bi bi-chevron-double-left'></span>
                                        </a>
                                    </li>";
                                }

                                /* numbers page */

                                for ($i = 1; $i <= $pages; $i++) {

                                    if ($request_page == $i) {
                                        echo "<li class='page-item active'><a class='page-link' href='?page_num=$i'>$i</a></li>";
                                    } else {
                                        echo "<li class='page-item'><a class='page-link' href='?page_num=$i'>$i</a></li>";
                                    }
                                }

                                /* next page */

                                if ($request_page < $pages) {

                                    echo "<li class='page-item'>
                                        <a class='page-link' href='?page_num=" . ($request_page + 1) . "' aria-label='Next'>
                                            <span class='bi bi-chevron-double-right'></span>
                                        </a>
                                    </li>";
                                }

                                ?>
                            </ul>
                        </nav>

                    </div>
                </section>

            </div>
        </div>

        <?php include("../footer.php"); ?>

    </main>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->