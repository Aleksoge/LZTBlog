<?php 
$errors = array();

$response = array('success' => false, 'message' => 'Ошибка, что-то пошло не так..', 'errors' => $errors);

header('Content-Type: application/json');
echo json_encode($response);
?>