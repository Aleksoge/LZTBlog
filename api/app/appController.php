<?php
function set_csrf()
{
	if(!isset($_SESSION)) { session_start(); }
	if (!isset($_SESSION["csrf"])) {
		$_SESSION["csrf"] = bin2hex(random_bytes(50));
	}
	echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function is_csrf_valid()
{
	if(!isset($_SESSION)) { session_start(); }
	if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
		return false;
	}
	if ($_SESSION['csrf'] != $_POST['csrf']) {
		return false;
	}
	return true;
}