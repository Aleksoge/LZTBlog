<?php
$articles_count = 8; 

$result = [];

if (!empty($errors)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    $articles_number = R::count('articles');
    $result[] = [
        'count' => $articles_number,
        'total_pages' => ceil($articles_number / $articles_count)
    ];
    $response = $result;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
