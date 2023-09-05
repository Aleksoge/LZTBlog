<?php
if(!is_csrf_valid()) {  responseOutput(false, 'Ошибка, что-то пошло не так..'); }
$data = $_POST;
$errors = array();

if (strlen(trim($data['title'])) < 1) {
    $errors['title'] = "Заголовок статьи не может быть пустым.";
}

$imgPath = $data['img_path']; 
if (isset($_FILES['img_load']) && $_FILES['img_load']['error'] === UPLOAD_ERR_OK) {
    $imgFilename = uploadFile($_FILES['img_load'], $_SERVER['DOCUMENT_ROOT'].'/uploads');
    if ($imgFilename) {
        $imgPath = '/uploads/' . $imgFilename;
    } else {
        $errors['img_load'] = "Ошибка загрузки картинки.";
    }
}

if (strlen(trim($data['shortdescription'])) < 1) {
    $errors['shortdescription'] = "Краткое содержание статьи не может быть пустым.";
}

if (strlen(trim($data['description'])) < 1) {
    $errors['description'] = "Содержание статьи не может быть пустым.";
}

if (!empty($errors)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    if(isset($data['itemId'])) { 
        $article = R::load('articles', $data['itemId']);
    } else {
        $article = R::dispense('articles');
    }
    $article->title = $data['title'];
    $article->author = $data['author'];
    $article->img = $imgPath;
    $article->shortdescription = $data['shortdescription'];
    $article->description = $data['description'];
    $article->createdby = $authorized_user->id;
    $article->updated = date('Y-m-d H:i:s');
    R::store($article);
    responseOutput(true, 'Статья успешно сохранена.');
}

header('Content-Type: application/json');
echo json_encode($response);
?>
