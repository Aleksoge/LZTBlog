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
front('/admin/articles', 'views/admin/articles', 'default', ['admin']);
front('/admin/article', 'views/admin/article', 'default', ['admin']);
front('/admin/article/$item_id', 'views/admin/article', 'default', ['admin']);

get('/api/articles', 'api/articles', ['admin']); // Информация о статьях
get('/api/articles/$item_id', 'api/articles', ['admin']); // Информация о статье
post('/api/articles', 'api/article', ['admin']); // Добавление статьи
patch('/api/articles/$item_id', 'api/article', ['admin']); // Редактирование статьи
delete('/api/articles/$item_id', 'api/article_delete', ['admin']); // Удаление статьи
post('/api/editor_upload_video', 'api/editor_upload_video', ['admin']); 
post('/api/editor_upload_file', 'api/editor_upload_file', ['admin']);
post('/api/editor_upload_image', 'api/editor_upload_image', ['admin']); 

//// 404 ///
any('/404','views/404');  