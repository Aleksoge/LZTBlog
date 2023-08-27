1<?php
require_once __DIR__.'/app/routeController.php';

get('/', 'views/index.php');
get('/login', 'views/login');
get('/register', 'views/register');

//// 404 ///
any('/404','views/404');  