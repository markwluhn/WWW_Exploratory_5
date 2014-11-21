<?php
   /*
      Template Name: signin
      Purpose: returning users can sign in
   */
?>

<?php get_header() ?>

<?php session_start();?>

<?php 
	global $wpdb;

	require_once('wp-config.php');

	if($_SESSION['loggedin'] == TRUE)
	{
		header('Location: home');
	}
?>

<h1>Sign In</h1>
	<form method="POST">
		Username:
			<input type="text" name="username" required>
		Password:
			<input type="password" name="password"required>
		
		<input type="submit" value="Sign In" name="submit">
	</form>
	
	<p>Click <a href = '../register'>Here</a> to Register</p> 

<?php
	if (isset($_POST['submit']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$signin = $wpdb->get_row($wpdb->prepare("SELECT * FROM user WHERE username = %s", $username));
		
		$salt = $result->salt;
		
		if(sha1($password.$salt) == $signin->password)
		{
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['username'] = $username;
			header('Location: ../home');
		}
		else
		{
			echo "Username or Password are Incorrect";
		}
	}
?>

<?php get_footer() ?>