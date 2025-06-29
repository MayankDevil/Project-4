<?php

session_start();

if (!isset($_SESSION["userename"]) && !isset($_SESSION["user_role"])) {
	header("Location:login.php");
	exit;
} else {

	include("modal.php");
}

?>
<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/dashboard.php
-   Description: controller of all post user categories data;
-->
<html lang="en">

<head>

	<?php require("../main.php"); ?>

</head>

<body>

	<!-- main -->
	<main id="root">

		<?php #include("test.php"); die; ?>

		<?php include("header.php"); ?>

		<div class="container-fluid">
			<div class="container">

				<!-- POST SECTION -->
				<section class="collapse" id="post_section">
					<div class="row">
						<div class="col">

							<h4 class="h4"> ALL POST DATA </h4>

							<a href="new_post.php" class="btn btn-info"> New Post <span class="bi bi-file-txt"></span>
							</a>

						</div>
					</div>
				</section>
				<?php include("categories.php"); ?>
				
				<?php include("users.php"); ?>

			</div>
		</div>

		<?php include("../footer.php"); ?>

	</main>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->