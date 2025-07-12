<!DOCTYPE html>
<!--
-   Project: ""
-   File: frontend/user/app.php
-   Description: application 
-->

<?php session_start(); ?>

<html lang="en">

<head>

	<?php include("main.php"); ?>

</head>

<body>

	<!-- main -->
	<main id="root">

		<?php include("popup.php"); ?>

		<?php include("header.php"); ?>

		<section class="container-fluid bgs-white">
			<div class="container">
				<div class="row">

					<?php include("app.php"); ?>

				</div>
			</div>
		</section>

		<?php include("footer.php"); ?>

	</main>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->