<?php
function set_csrf() {
	if(!isset($_SESSION)) { session_start(); }
	if (!isset($_SESSION["csrf"])) {
		$_SESSION["csrf"] = bin2hex(random_bytes(50));
	}
	echo '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
}

function is_csrf_valid() {
	if(!isset($_SESSION)) { session_start(); }
	if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
		return false;
	}
	if ($_SESSION['csrf'] != $_POST['csrf']) {
		return false;
	}
	return true;
}

function responseOutput(bool $result, string $message, array $errors = null): void {
	$response = array('success' => $result, 'message' => $message);
	if (isset($errors)) {
		$response['errors'] = $errors;
	}
	header('Content-Type: application/json');
	echo json_encode($response);
	exit();
}

function isValidEmail($email) {
    $pattern = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    return preg_match($pattern, $email);
}


function uploadFile($file, $destinationDir) {
    if ($file['error'] !== UPLOAD_ERR_OK) {
        return false;
    }

    // Проверим тип файла
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/svg'];
    if (!in_array($file['type'], $allowedTypes)) {
        return false;
    }

    // Генерация уникального имени файла
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = uniqid() . '.' . $extension;

    $destinationPath = $destinationDir . '/' . $filename;

    if (move_uploaded_file($file['tmp_name'], $destinationPath)) {
        return $filename;
    } else {
        return false;
    }
}