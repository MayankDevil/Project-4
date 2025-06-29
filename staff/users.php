<?php

if (!isset($_SESSION["userename"]) && !isset($_SESSION["user_role"])) {
 
    header("Location:login.php");
    exit;
}

$request_page = isset($_REQUEST['page_num']) ? intval($_REQUEST['page_num']) : 1;

?>
<!-- USER SECTION -->
<section class="collapses" id="user_section">
    <div class="my-5" id="">

        <div class="w-100 d-flex justify-content-between align-items-center">
            <h4 class="h4"> USER </h4>

            <a href="register.php" class="btn btn-sm btn-dark"> <span class="bi bi-person-plus-fill m-1"></span> New
                User </a>
        </div>

        <table class="table w-100 m-3 mx-auto" id="user_data_table">
            <thead class="">
                <tr>
                    <th class=''> ID</th>
                    <th class=''> Username </th>
                    <th class=''> First Name </th>
                    <th class=''> Last Name </th>
                    <th class=''> Email </th>
                    <th class=''> Contact </th>
                    <th class=''> Role </th>
                    <th class=''> STATUS </th>
                    <th class=''> EDIT </th>
                </tr>
            </thead>
            <tbody>
                <?php

                $total_users = DB_Modal::countThe('USERS');

                $data_count = intval($total_users['TOTAL_USERS']);

                $pages = 3;

                $page_data_count = ceil($data_count / $pages);

                $control = ($request_page - 1) * $page_data_count;

                $output = DB_Modal::get_users($control, $page_data_count);

                if ($output && is_array($output)) {
                    if (count($output) > 0) {
                        foreach ($output as $row) {

                            $lname = empty($row["last_name"]) ? "NULL" : $row['last_name'];
                            $role = ($row['role']) ? "Admin" : "User";
                            $status = ($row['isActive']) ? "<a href='grant.php?user_id=" . $row['id'] . "&action=" . $row['isActive'] . "' class='btn btn-sm btn-success'> <span class=' bi bi-check-circle mx-1'></span> ENABLE </a>" : "<a href='grant.php?user_id=" . $row['id'] . "&action=" . $row['isActive'] . "' class='btn btn-sm btn-danger'> <span class=' bi bi-x-circle mx-1'></span> DISABLE </a>";

                            echo "<tr class=''>";
                            echo "<td class=''>" . $row['id'] . "</td>";
                            echo "<td class=''>" . $row['name'] . "</td>";
                            echo "<td class=''>" . $row['first_name'] . "</td>";
                            echo "<td class=''>" . $lname . "</td>";
                            echo "<td class=''>" . $row['email'] . "</td>";
                            echo "<td class=''>" . $row['contact_number'] . "</td>";
                            echo "<td class=''>" . $role . "</td>";
                            echo "<td class=''>" . $status . "</td>";
                            echo "<td class=''> <a href='#" . $row['id'] . "' class='btn btn-sm btn-dark bi bi-pencil-square'></a> </td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<div class='alert alert-warning w-50 m-3 mx-auto'> user table is empty </div>";
                    }
                } else {
                    echo "<div class='alert alert-danger w-50 m-3 mx-auto'> Query Problem Please checkout! </div>";
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