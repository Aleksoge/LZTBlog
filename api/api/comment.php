<?php
if(!is_csrf_valid()) {  responseOutput(false, 'Ошибка, что-то пошло не так..'); }
$data = $_POST;
$errors = array();

if (strlen(trim($data['comment'])) < 10) {
    $errors['comment'] = "Комментарий должен содержать не менее 10 символов";
}

if(!isset($article_id)) {
    $errors['comment'] = "Ошибка, неизвестная статья";
} else {
    $article = R::load('articles', (int)$article_id);
    if($article->title == null) {
        $errors['comment'] = "Ошибка, статьи не существует";
    }
}

if (!empty($errors)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    $comment = R::dispense('comments');
    $comment->article = (int)$article_id;
    $comment->name = $authorized_user->username;
    //$comment->comment = htmlspecialchars($data['comment'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $comment->comment = $data['comment'];
    $comment->createdby = $authorized_user->id;
    $comment->updated = date('Y-m-d H:i:s');
    R::store($comment);
    responseOutput(true, 'Спасибо, ваш комментарий успешно сохранён.');
}

header('Content-Type: application/json');
echo json_encode($response);
?>