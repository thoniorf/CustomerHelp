<?php
if (!isset( $_SESSION['user_id'])) {
	
	if(isset($_GET['content']))
	{
		if($_GET['content'] == 'registration' || $_GET['content'] == 'login')
		{
			$current_content ='/' .  $_GET['content'] . '.php';
			
		}
		else
		{
			$current_content = '/login.php';
		}
	}
	else
	{
		$current_content = '/login.php';
		
	}
} 
else 
{
	if(isset($_GET['content'])){
		$current_content ='/' .  $_GET['content'] . '.php';
	} else {
		$current_content = "/home.php";
	}
}
?>