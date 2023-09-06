<?php
$result = [];
setlocale(LC_TIME, 'ru_RU.UTF-8');

if (!empty($errors)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    $comments = R::findAll('comments', 'WHERE article = ?', [$article_id]);
    foreach ($comments as $item) {
        $date = new DateTime($item->updated);
        $formatter = new IntlDateFormatter(
            'ru_RU',
            IntlDateFormatter::LONG,
            IntlDateFormatter::SHORT,
            'Europe/Moscow',
            IntlDateFormatter::GREGORIAN,
            'd MMMM y в HH:mm'
        );
        $result[] = [
            'id' => $item->id,
            'name' => $item->name,
            'comment' => $item->comment,
            'article' => $item->article,
            'date' => $formatter->format($date)
        ];
    }
    $response = $result;
}

header('Content-Type: application/json');
echo json_encode($response);
?>
