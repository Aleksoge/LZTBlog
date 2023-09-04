<?php
require_once __DIR__.'/routeController.php';

front('/', 'views/index.php', 'default');
front('/login', 'views/login', 'default');
front('/register', 'views/register', 'default');

//// 404 ///
any('/404','views/404');  