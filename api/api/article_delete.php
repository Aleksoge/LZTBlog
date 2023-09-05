<?php
$data = $_POST;
$errors = array();

if(!isset($item_id)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..');
} else {
    $article = R::load('articles', $item_id);
    R::trash($article);
    $response = array('success' => true, 'message' => 'Запись успешно удалена.', 'thisid' => $item_id);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
