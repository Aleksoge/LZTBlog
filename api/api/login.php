<?php
if(!is_csrf_valid()) {  responseOutput(false, 'Ошибка, что-то пошло не так..'); }
if(isset($_SESSION['user'])) { responseOutput(false, 'Ошибка, вы уже авторизованы..'); }
$data = $_POST;
$errors = array();

if (strlen(trim($data['username'])) < 2) {
    $errors['username'] = "Пользователя с таким логином не существует.";
}

if (strlen(trim($data['password'])) < 2) {
    $errors['password'] = "Неверный пароль. Пожалуйста, проверьте правильность введенного пароля.";
}

$user = R::findone('users', 'username = ? OR email = ?', array($data['username'], $data['username']));

if(!$user) {
    $errors['username'] = "Пользователя с таким логином не существует.";
} else {
    if(password_verify($data['password'], $user->password)) {
        if($user->confirmed != 1) {
            $errors['username'] = "Учетная запись деактивирована. Пожалуйста, свяжитесь с администратором для получения дополнительной информации.";
        }
    } else {
        $errors['password'] = "Неверный пароль. Пожалуйста, проверьте правильность введенного пароля.";
    }
}

if (!empty($errors)){
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    $_SESSION['user'] = [
        "username" => $user->username,
        "email" => $user->email,
        "avatar" => $user->avatar
    ];
    if(isset($_POST['remember'])) {
        $token = bin2hex(random_bytes(48));
        $expiry = time() + (30 * 24 * 60 * 60); // 30 days from now
        $user->remember_token = $token;
        $user->remember_expiry = $expiry;
        R::store($user);
        setcookie('remember_token', $token, $expiry, '/', '', false, true);
    }
    responseOutput(true, 'Вы успешно авторизованы . Добро пожаловать!');
}

header('Content-Type: application/json');
echo json_encode($response);
?>