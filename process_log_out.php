<?php
	@require_once('initialized.php');
	
	if($session->is_logged_in()){
		$session->logout();
		header("Location: signin.php");
	}

?>