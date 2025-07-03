<?php

if (!isset($_SESSION["userename"]) && !isset($_SESSION["user_id"])) {
 
    header("Location:logout.php");
    exit;

}

if (isset($_REQUEST['new_categories_submit'])) {

    echo 'done';

    $new_categories = isset($_REQUEST['new_categories']) ? $_REQUEST['new_categories'] : '';

    if (empty($new_categories)) {   
        echo "<div class='alert alert-danger w-50 m-3 mx-auto'> Please enter new categories </div>";
    } else {

        $output = DB_Modal::set_categorie($new_categories);

        if ($output) {
            echo "<div class='alert alert-success w-50 m-3 mx-auto'> Update new categories </div>";
        } else {
            echo "<div class='alert alert-danger w-50 m-3 mx-auto'> $output </div>";
        }
    }

}

// $request_page = isset($_REQUEST['page_num']) ? intval($_REQUEST['page_num']) : 1;

?>
<!-- CATEGORIES SECTION -->
<section class="collapses" id="categorie_section">
    <div class="my-5" id="">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h4 class="h4"> Categories </h4>

            <form method="GET" action="<?php $_SERVER['PHP_SELF']; ?>" class="btn-group w-75">
                <!-- <label for="" class=""> Enter First Name </label> -->
                <input type="text" name="new_categories" id="new_categories_field" class="form-control form-control-sm w-75">
                <button type="submit" name="new_categories_submit" class="btn btn-sm btn-dark w-25"> <span class="bi bi-card-list"></span> New Categories </button>
            </form>

        </div>

        <table class="table w-100 m-3 mx-auto" id="user_data_table">
            <thead class="">
                <tr>
                    <th class=''> ID</th>
                    <th class='w-75'> TYPE </th>
                    <th class=''> COUNT </th>
                    <th class=''> Rename </th>
                </tr>
            </thead>
            <tbody>
                <?php

                // $total_categories = DB_Modal::countThe('CATEGORIES');

                // $data_count = intval($total_categories['TOTAL_CATEGORIES']);

                // $pages = 3;

                // $page_data_count = ceil($data_count / $pages);

                // $control = ($request_page - 1) * $page_data_count;

                $output = DB_Modal::get_categories();

                if ($output && is_array($output)) {
                    if (count($output) > 0) {
                        foreach ($output as $row) {

                            // $lname = empty($row["last_name"]) ? "NULL" : $row['last_name'];
                            // $role = ($row['role']) ? "Admin" : "User";
                            // $status = ($row['isActive']) ? "<a href='grant.php?user_id=" . $row['id'] . "&action=" . $row['isActive'] . "' class='btn btn-sm btn-success'> <span class=' bi bi-check-circle mx-1'></span> ENABLE </a>" : "<a href='grant.php?user_id=" . $row['id'] . "&action=" . $row['isActive'] . "' class='btn btn-sm btn-danger'> <span class=' bi bi-x-circle mx-1'></span> DISABLE </a>";

                            echo "<tr class=''>";
                            echo "<td class=''>" . $row['id'] . "</td>";
                            echo "<td class=''>" . $row['name'] . "</td>";
                            echo "<td class=''>" . $row['name'] . "</td>";
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
        <!-- <nav id="pagination">
            <ul class="pagination">
                <?php

                    // /* previous page */
                    // if ($request_page > 1) {

                    //     echo "<li class='page-item'>
                    //             <a class='page-link' href='?page_num=" . ($request_page - 1) . "' aria-label='Previous'>
                    //                 <span class='bi bi-chevron-double-left'></span>
                    //             </a>
                    //         </li>";
                    // }

                    // /* numbers page */

                    // for ($i = 1; $i <= $pages; $i++) {

                    //     if ($request_page == $i) {
                    //         echo "<li class='page-item active'><a class='page-link' href='?page_num=$i'>$i</a></li>";
                    //     } else {
                    //         echo "<li class='page-item'><a class='page-link' href='?page_num=$i'>$i</a></li>";
                    //     }
                    // }

                    // /* next page */

                    // if ($request_page < $pages) {

                    //     echo "<li class='page-item'>
                    //             <a class='page-link' href='?page_num=" . ($request_page + 1) . "' aria-label='Next'>
                    //                 <span class='bi bi-chevron-double-right'></span>
                    //             </a>
                    //         </li>";
                    // }
                    
                ?>
            </ul>
        </nav> -->

    </div>
</section>