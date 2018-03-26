<?php
	@require_once('initialized.php');


	if($session->is_logged_in()){
		header("Location: index.php");
	} 

	if(isset($_POST['sign-in'])) {
		$email = trim($_POST['email']);
		$password = trim($_POST['password']);
		$found_user = User::authenticate($email, $password);
		if($found_user){
			$session->login($found_user);
			header("Location: index.php");
		}
	}

?>