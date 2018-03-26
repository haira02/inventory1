<?php
	@require_once('initialized.php');


	if (isset($_POST['sign-up'])) {
		$record = [];
		$record['first_name'] = $_POST['fname'];
		$record['last_name'] = $_POST['lname'];
		$record['email'] = $_POST['email'];
		$record['password'] = $_POST['pass'];

		$user = User::make($record);
		$user->create();

		header("Location: signin.php");
	}

?>