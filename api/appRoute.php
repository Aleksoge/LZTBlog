<?php
require_once __DIR__.'/routeController.php';

get('/', 'views/index.php');
get('/login', 'views/login');
get('/register', 'views/register');

//// 404 ///
any('/404','views/404');  