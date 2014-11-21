<?php
   /*
      Template Name: signout
      Purpose: users can sign out
   */
?>

<?php get_header() ?>

<?php 
	session_start();
	$_SESSION['username'] = NULL;
	$_SESSION['loggedin'] = FALSE;
	
	header('Location: ../home');
?>