<?php 

    session_start(); 

    if (!isset($_SESSION["userename"]) && !isset($_SESSION["user_role"]))
    {
        header("Location:login.php");
    }
?>
<!DOCTYPE html>
<!--
-   Project: ""
-   File: staff/dashboard.php
-   Description: controller of all data or user 
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

				<h1 class="h1"> dashboard </h1>

			</div>
		</div>
		
		<?php include("../footer.php"); ?>

	</main>

</body>

</html>
<!-- Developer: Mayank Devil | https://mayankdevil.github.io/MayankDevil -->