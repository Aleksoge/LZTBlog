<?php
require_once __DIR__.'/routeController.php';

front('/', 'views/index.php', 'default');
front('/login', 'views/login', 'default', ['guest']);
front('/register', 'views/register', 'default', ['guest']);

get('/logout/logout/logoust', 'api/logout');
get('/logout/logout/logout', 'api/logout');
post('/api/login', 'api/login', ['guest']);
post('/api/register', 'api/register', ['guest']);

// ADMIN //
front('/admin/dashboard', 'views/admin/index.php', 'admin', ['admin']);

//// 404 ///
any('/404','views/404');  