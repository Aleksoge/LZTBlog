<?php
if(!is_csrf_valid()) {  responseOutput(false, 'Ошибка, что-то пошло не так..'); }
$data = $_POST;
$errors = array();

if (strlen(trim($data['comment'])) < 10) {
    $errors['comment'] = "Комментарий должен содержать не менее 10 символов";
}

if (!empty($errors)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    $comment = R::dispense('comments');
    $comment->name = $authorized_user->username;
    $comment->comment = $data['comment'];
    $comment->createdby = $authorized_user->id;
    $comment->updated = date('Y-m-d H:i:s');
    R::store($comment);
    responseOutput(true, 'Спасибо, ваш комментарий успешно сохранён.');
}

header('Content-Type: application/json');
echo json_encode($response);
?>