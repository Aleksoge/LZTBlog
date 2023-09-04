<?php
require __DIR__.'/app/config.php';
require __DIR__.'/app/appController.php';
require __DIR__.'/app/userController.php';
require __DIR__.'/app/adminController.php';

function front($route, $path_to_include, $front_type)
{
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		route($route, $path_to_include, $front_type);
	}
}
function get($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		route($route, $path_to_include);
	}
}
function post($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		route($route, $path_to_include);
	}
}
function put($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
		route($route, $path_to_include);
	}
}
function patch($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
		route($route, $path_to_include);
	}
}
function delete($route, $path_to_include)
{
	if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		route($route, $path_to_include);
	}
}
function any($route, $path_to_include)
{
	route($route, $path_to_include);
}

function route($route, $path_to_include, $front_type)
{
	$global_settings = R::load('settings', 1);
	if(!isset($_SESSION)) { session_start(); }
	if(!isset($_SESSION['user'])) {
		if(isset($_COOKIE['remember_token'])) {
			$authorizedUser = R::findOne('users', 'remember_token = ?', [$_COOKIE['remember_token']]);
			if ($authorizedUser) {
				if($authorizedUser->confirmed > 0) { 
					$_SESSION['user'] = [
						"username" => $authorizedUser->username,
						"email" => $authorizedUser->email,
						"avatar" => $authorizedUser->avatar
					];
				}
			}
		}
	} else {
		$authorizedUser = R::findOne('users', 'username = ?', [$_SESSION['user']['username']]);
		if($authorizedUser->confirmed < 1) { 
			unset($_SESSION['user']);
			unset($_COOKIE['remember_token']);
			setcookie('remember_token', '', -1, '/'); 
		}
	}
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
	if(isset($front_type)) {
		include_once __DIR__.'/views/layouts/'.$front_type.'_header.php';
	}
	include_once __DIR__ . "/$path_to_include";
	if(isset($front_type)) {
		include_once __DIR__.'/views/layouts/'.$front_type.'_footer.php';
	}
	exit();
}