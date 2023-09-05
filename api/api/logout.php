<?php 
	unset($_SESSION['user']);
    unset($_COOKIE['remember_token']);
    setcookie('remember_token', '', -1, '/'); 
	header('Location: /');
?>