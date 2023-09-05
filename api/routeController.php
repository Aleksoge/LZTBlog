<?php
require __DIR__.'/app/config.php';
require __DIR__.'/app/appController.php';
require __DIR__.'/app/userController.php';
require __DIR__.'/app/adminController.php';

function front($route, $path_to_include, $front_type = null, $roles_allowed = null)
{
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		route($route, $path_to_include, $roles_allowed, $front_type);
	}
}
function get($route, $path_to_include, $roles_allowed = null)
{
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		route($route, $path_to_include, $roles_allowed);
	}
}
function post($route, $path_to_include, $roles_allowed = null)
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		route($route, $path_to_include, $roles_allowed);
	}
}
function put($route, $path_to_include, $roles_allowed = null)
{
	if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
		route($route, $path_to_include, $roles_allowed);
	}
}
function patch($route, $path_to_include, $roles_allowed = null)
{
	if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
		route($route, $path_to_include, $roles_allowed);
	}
}
function delete($route, $path_to_include, $roles_allowed = null)
{
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		route($route, $path_to_include, $roles_allowed);
	}
}
function any($route, $path_to_include, $roles_allowed = null)
{
	route($route, $path_to_include, $roles_allowed);
}

function checkAccess($authorized_user= null, $roles_allowed = null) {
	if (!isset($roles_allowed)) {
		return true;
	}
	if(in_array('guest', $roles_allowed)) {
		if (!isset($_SESSION['user'])) {
			return true;
		} else {
			return false;
		}
	}
	if (!isset($_SESSION['user'])) {
		return false;
	}
	return in_array($authorized_user->role, $roles_allowed);
}

function route($route, $path_to_include, $roles_allowed = null, $front_type = null) {
	$callback = $path_to_include;
	if (!is_callable($callback)) {
		if (!strpos($path_to_include, '.php')) {
			$path_to_include .= '.php';
		}
	}
	if ($route == "/404") {
		include_once __DIR__ . "/$path_to_include";
		exit();
	}
	$request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
	$request_url = rtrim($request_url, '/');
	$request_url = strtok($request_url, '?');
	$route_parts = explode('/', $route);
	$request_url_parts = explode('/', $request_url);
	array_shift($route_parts);
	array_shift($request_url_parts);
	if ($route_parts[0] == '' && count($request_url_parts) == 0) {
		// Callback function
		if (is_callable($callback)) {
			call_user_func_array($callback, []);
			exit();
		}
		$global_settings = R::load('settings', 1);
		$authorized_user = null;
		if(!isset($_SESSION['user'])) {
			if(isset($_COOKIE['remember_token'])) {
				$authorized_user = R::findOne('users', 'remember_token = ?', [$_COOKIE['remember_token']]);
				if ($authorized_user) {
					if($authorized_user->confirmed > 0) { 
						$_SESSION['user'] = [
							"username" => $authorized_user->username,
							"email" => $authorized_user->email,
							"avatar" => $authorized_user->avatar
						];
					}
				}
			}
		} else {
			$authorized_user = R::findOne('users', 'username = ?', [$_SESSION['user']['username']]);
			if($authorized_user->confirmed < 1) { 
				unset($_SESSION['user']);
				unset($_COOKIE['remember_token']);
				setcookie('remember_token', '', -1, '/'); 
			}
		}
		if(!checkAccess($authorized_user, $roles_allowed)) {
			include_once __DIR__ . "/views/404.php"; 
			exit();
		}
		if(isset($front_type)) {
			include_once __DIR__.'/views/layouts/'.$front_type.'_header.php';
		}
		include_once __DIR__ . "/$path_to_include";
		if(isset($front_type)) {
			include_once __DIR__.'/views/layouts/'.$front_type.'_footer.php';
		}
		exit();
	}
	if (count($route_parts) != count($request_url_parts)) {
		return;
	}
	$parameters = [];
	for ($__i__ = 0; $__i__ < count($route_parts); $__i__++) {
		$route_part = $route_parts[$__i__];
		if (preg_match("/^[$]/", $route_part)) {
			$route_part = ltrim($route_part, '$');
			array_push($parameters, $request_url_parts[$__i__]);
			$$route_part = $request_url_parts[$__i__];
		} else if ($route_parts[$__i__] != $request_url_parts[$__i__]) {
			return;
		}
	}
	// Callback function
	if (is_callable($callback)) {
		call_user_func_array($callback, $parameters);
		exit();
	}
	$global_settings = R::load('settings', 1);
	$authorized_user = null;
	if(!isset($_SESSION['user'])) {
		if(isset($_COOKIE['remember_token'])) {
			$authorized_user = R::findOne('users', 'remember_token = ?', [$_COOKIE['remember_token']]);
			if ($authorized_user) {
				if($authorized_user->confirmed > 0) { 
					$_SESSION['user'] = [
						"username" => $authorized_user->username,
						"email" => $authorized_user->email,
						"avatar" => $authorized_user->avatar
					];
				}
			}
		}
	} else {
		$authorized_user = R::findOne('users', 'username = ?', [$_SESSION['user']['username']]);
		if($authorized_user->confirmed < 1) { 
			unset($_SESSION['user']);
			unset($_COOKIE['remember_token']);
			setcookie('remember_token', '', -1, '/'); 
		}
	}
	if(!checkAccess($authorized_user, $roles_allowed)) {
		include_once __DIR__ . "/views/404.php"; 
		exit();
	}
	if(isset($front_type)) {
		include_once __DIR__.'/views/layouts/'.$front_type.'_header.php';
	}
	include_once __DIR__ . "/$path_to_include";
	if(isset($front_type)) {
		include_once __DIR__.'/views/layouts/'.$front_type.'_footer.php';
	}
	exit();
}