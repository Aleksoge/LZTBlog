<?php
if(!is_csrf_valid()) {  responseOutput(false, 'Ошибка, что-то пошло не так..'); }
if(isset($_SESSION['user'])) { responseOutput(false, 'Ошибка, вы уже авторизованы..'); }
$data = $_POST;
$errors = array();

if (strlen(trim($data['username'])) < 4) {
    $errors['username'] = "Имя пользователя должно содержать минимум 4 символа.";
}

if (strlen(trim($data['email'])) < 5 || !isValidEmail($data['email'])) {
    $errors['email'] = "Неверный формат email. Пожалуйста, введите корректный адрес электронной почты.";
}

if (strlen($data['password']) < 5) {
    $errors['password'] = "Пароль должен содержать минимум 5 символов.";
}

if($data['password_2'] != $data['password']){
    $errors['password_2'] = "Пароли не совпадают. Пожалуйста, введите одинаковые пароли в оба поля.";
}

if (!empty($errors)) {
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors); //перед обращениям проверок к БД сначала обработаем базовые фильтры
}

if(R::count("users", "username = ?", array($data['username'])) > 0){
    $errors['username'] = "Это имя пользователя уже используется.";
}

if(R::count("users", "email = ?", array($data['email'])) > 0){
    $errors['email'] = "Этот Email уже используется.";
}

if (!empty($errors)){
    responseOutput(false, 'Ошибка, что-то пошло не так..', $errors);
} else {
    $user = R::dispense('users');
    $user->username = $data['username'];
    $user->email = $data['email'];
    $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
    $user->avatar = '/assets/img/avatars/default.webp';
    $user->refferal = isset($_COOKIE['refferal_code']) ? htmlspecialchars($_COOKIE['refferal_code']) : NULL;
    $user->role = "user";
    $user->confirmed = 1;
    $user->registration_date = date('Y-m-d H:i:s');
    $user->updated = date('Y-m-d H:i:s');
    $token = bin2hex(random_bytes(48));
    $expiry = time() + (30 * 24 * 60 * 60); 
    $user->remember_token = $token;
    $user->remember_expiry = $expiry;
    R::store($user);
    $_SESSION['user'] = [
        "username" => $user->username,
        "email" => $user->email,
        "avatar" => $user->avatar
    ];
    setcookie('remember_token', $token, $expiry, '/', '', false, true);
    responseOutput(true, 'Вы успешно зарегистрированы. Добро пожаловать!');
}

header('Content-Type: application/json');
echo json_encode($response);
?>