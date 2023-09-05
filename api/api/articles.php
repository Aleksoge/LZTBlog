<?php
$articles_count = 2; 

$result = [];
$page = (isset($_GET['page'])) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $articles_count;
setlocale(LC_TIME, 'ru_RU.UTF-8');

if (!empty($errors)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    if(isset($item_id)) {
        $articles = R::load('articles', (int)$item_id);
        if($articles->title == null) {
            $response = array('message' => 'Ошибка, данной статьи не существует.', 'result' => '');
            header('Content-Type: application/json');
            echo json_encode($response);
            exit();
        }
        $date = new DateTime($articles->created);
        $formatter = new IntlDateFormatter(
            'ru_RU',
            IntlDateFormatter::LONG,
            IntlDateFormatter::SHORT,
            'Europe/Moscow',
            IntlDateFormatter::GREGORIAN,
            'd MMMM y в HH:mm'
        );
        $result[] = [
            'id' => $articles->id,
            'title' => $articles->title,
            'author' => $articles->author,
            'shortdescription' => $articles->shortdescription,
            'description' => $articles->description,
            'date' => $formatter->format($date)
        ];
    } else {
        $articles = R::findAll('articles', 'ORDER BY created DESC LIMIT ? OFFSET ?', [$articles_count, $offset]);
        foreach ($articles as $item) {
            $date = new DateTime($item->created);
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
                'title' => $item->title,
                'author' => $item->author,
                'shortdescription' => $item->shortdescription,
                'description' => $item->description,
                'date' => $formatter->format($date)
            ];
        }
    }
    $response = array('result' => $result);
}

header('Content-Type: application/json');
echo json_encode($response);
?>
