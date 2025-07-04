<?php

	session_start();

	if (!isset($_SESSION["userename"]) && !isset($_SESSION["user_role"])) {

		header("Location:login.php");
		exit;
	}
	require("modal.php");

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

<body class="bgs-white">
	<!-- main -->
	<main id="root">

		<?php include("../header.php"); ?>

		<div class="container-fluid">
			<div class="container">

				<?php include("posts.php"); ?>

				<?php include("categories.php"); ?>
				
				<?php include("users.php"); ?>

			</div>
		</div>

		<?php include("../footer.php"); ?>

	</main>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->