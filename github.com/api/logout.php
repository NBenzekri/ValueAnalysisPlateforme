<?php
	require_once('session.php');
	require_once('MembreAPI.php');
	$user_logout = new MembreAPI();
	
	if($user_logout->is_loggedin()!="")
	{
		$user_logout->redirect('../eoa.php');
	}
	if(isset($_GET['logout']) && $_GET['logout']=="true")
	{
		$user_logout->logout();
		$user_logout->redirect('../index.php');
	}
