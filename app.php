<!-- FIRST COLUMN -->
<div class="col-md-9 col py-3" id="first_col">
    <?php

    # call posts data according to active request

    $title = '';

    if (isset($_REQUEST['active_category_id'])) {
        $title = '' . $_REQUEST['category_name'];
        $return_output = DB_Modal::get_all_posts('category', $_REQUEST['active_category_id']);
    } else if (isset($_REQUEST['active_user_id'])) {
        $title = '' . $_REQUEST['request_user'];
        $return_output = DB_Modal::get_all_posts('user', $_REQUEST['active_user_id']);
    } else if (isset($_REQUEST['active_post_id'])) {
        $title = '' . $_REQUEST['post_user'];
        $return_output = DB_Modal::get_all_posts('post', $_REQUEST['active_post_id']);
    } else if (isset($_REQUEST['active_post_stamp'])) {
        $return_output = DB_Modal::get_all_posts('stamp', $_REQUEST['active_post_stamp']);
    } else {
        $title = 'All World Wide Post';
        $return_output = DB_Modal::get_all_posts();
    }
    ?>
    <!-- title -->
    <div class="w-100 py-3">
        <h2 class="h6 texts-brown bgs-shade text-white rounded p-3"> <?= $title ?> </h2>
    </div>
    <!-- all article -->
    <div class="w-100">
        <?php

        # if return output is array and they contain value then execute loop

        if ($return_output && is_array($return_output) && (count($return_output) > 0)) {
            foreach ($return_output as $row) {

                $image = (file_exists($row['post_image']))? $row['post_image'] : 'image/wave.jpg';
        ?>

                <article class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-5 p-1">
                            <a href="<?= $image ?>" target="_self" title="click to see full view image">
                                <img src="<?= $image ?>" class="img-fluid rounded-start" alt="loading">
                            </a>
                        </div>
                        <div class="col-md-7">
                            <div class="card-body">

                                <h5 class="card-title m-0"><?= $row['post_title'] ?></h5>
                                <p class="card-text text-secondary py-3"><?= $row['post_description'] ?></p>

                                <div class="row">
                                    <div class="col">

                                        <a href="index.php?active_user_id=<?= $row['user_id'] ?>&request_user=<?= $row['author_name'] ?>" class="info_link"> <span class="bi bi-person"></span> <?= $row['author_name'] ?></a>
                                        <a href="index.php?active_post_stamp=<?= $row['post_stamp'] ?>" class="info_link"> <span class="bi bi-clock"></span> <?= $row['post_stamp'] ?> </a>
                                        <a href="index.php?active_category_id=<?= $row['categories_id'] ?>&category_name=<?= $row['post_category'] ?>" class="info_link"> <span class="bi bi-clipboard"></span> <?= $row['post_category'] ?></a>

                                    </div>
                                    <div class="col-3">

                                        <a href="index.php?active_post_id=<?= $row['post_id'] ?>&post_user=<?= $row['author_name'] ?>" id="" class="btn btn-sm btn-outline-dark"> READ MOR <span class="bi bi-chevron-double-right"></span> </a>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </article>

            <?php
            }
        } else {
            echo "<div class='alert alert-danger w-50 m-3 mx-auto'> $return_output </div>";

            ?>
            <article class="card mb-3 placeholder_article">
                <div class="row g-0">
                    <div class="col-md-5 p-1 placeholder-glow">
                        <a class="btn btn-dark disabled w-100 h-100 placeholder w-25" aria-disabled="true"></a>
                    </div>
                    <div class="col-md-7">
                        <h5 class="m-3 placeholder-glow">
                            <span class="placeholder col-6"></span>
                        </h5>
                        <p class="m-3 placeholder-glow">
                            <span class="placeholder col-7"></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-4"></span>
                            <span class="placeholder col-6"></span>
                            <span class="placeholder col-8"></span>
                        </p>
                        <div class="m-3">
                            <span class="placeholder col-1 bgs-brown"></span>
                            <span class="placeholder col-1"></span>
                            <span class="placeholder col-2"></span>
                            <span class="placeholder col-2"></span>
                        </div>
                    </div>
                </div>
            </article>

        <?php } ?>

    </div>

    <!-- pagination -->
    <nav id="pagination">

        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="#" aria-label="Previous">
                    <span class="bi bi-chevron-double-left"></span>
                </a>
            </li>

            <li class="page-item active"><a class="page-link" href="#">1</a></li>

            <li class="page-item"><a class="page-link" href="#">2</a></li>

            <li class="page-item"><a class="page-link" href="#">3</a></li>

            <li class="page-item">
                <a class="page-link" href="#" aria-label="Next">
                    <span class="bi bi-chevron-double-right"></span>
                </a>
            </li>
        </ul>

    </nav>
</div>

<!-- LAST COLUMN -->

<div class="col-md-3 col" id="last_col">
    <div class="row position-sticky">

        <!-- search box -->
        <div class="py-3" id="search">

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Search ..."
                    aria-label="Username" aria-describedby="basic-addon1" id="search_bar">
                <a href="#" class="input-group-text bgs-shade texts-light" id="basic-addon1">
                    <span class="bi bi-search"></span>
                </a>
            </div>

        </div>

        <!-- categories list -->

        <div class="col">

            <h3 class="h3 p-2"> Categories </h3>
            <div class="list-group">
                <a href='<?= BASE_URL ?>' class='list-group-item list-group-item-action'> ALL Post </a>
                <?php

                $categorie_list = DB_Modal::get_categories();

                if ($categorie_list && is_array($categorie_list)) {
                    if (count($categorie_list) > 0) {
                        foreach ($categorie_list as $list_item) {

                            echo "<a href='index.php?active_category_id=" . $list_item['category_id'] . "&category_name=" . $list_item['category_type'] . "' class='list-group-item list-group-item-action'>" . $list_item['category_type'] . "</a>";
                        }
                    } else {
                        echo "<div class='alert alert-warning w-50 m-3 mx-auto'> user table is empty </div>";
                    }
                } else {
                    echo "<div class='alert alert-danger w-50 m-3 mx-auto'> $categorie_list </div>";
                }

                ?>
            </div>

        </div>

    </div>
</div>