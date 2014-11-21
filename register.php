<?php
   /*
      Template Name: register
      Purpose: register new account
   */
?>

<?php get_header() ?>

<?php session_start();?>

<?php 
	global $wpdb;
	
	require_once('wp-config.php');
	
	if($_SESSION['loggedin'] == TRUE)
	{
		header('Location: postLogin');
	}
?>
	<h1>Register a New Account</h1>
	
	<form method="POST">
		Username:
			<input type="text" name="username">
		Password:
			<input type="password" name="password"required>
		
		<hr>		
		<input type="submit" value="Register" name="register">

	</form>

<?php
	if(isset($_POST['register']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		$salt = sha1(rand());
		$hash = sha1($password.$salt);
		
		$success = $wpdb->insert('user', array(
			'username' => $username,
			'salt' => $salt,
			'password' => $hash));
		if($success == false)
		{
			echo "Could not register. Try again.";
		}
		else
		{
			echo "Success! You are Registered!";
			$_SESSION['username'] = $username;
			$_SESSION['loggedin'] = TRUE;
			
		}
		
	}
?>

<?php get_footer() ?>