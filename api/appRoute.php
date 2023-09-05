<?php
require_once __DIR__.'/routeController.php';

front('/', 'views/index.php', 'default');
front('/login', 'views/login', 'default', ['guest']);
front('/register', 'views/register', 'default', ['guest']);

get('/logout', 'api/logout');
post('/api/login', 'api/login', ['guest']);
post('/api/register', 'api/register', ['guest']);

// ADMIN //
front('/admin', 'views/admin/index', 'default', ['admin']);

get('/api/articles/$itemId', 'api/articles', ['admin']); // Информация о статье
post('/api/articles', 'api/articles', ['admin']); // Добавление статьи
patch('/api/articles/$itemId', 'api/articles', ['admin']); // Редактирование статьи
delete('/api/articles/$itemId', 'api/articles', ['admin']); // Удаление статьи

//// 404 ///
any('/404','views/404');  