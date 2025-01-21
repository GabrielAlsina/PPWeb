<?php

include_once '../config/Database.php';
include_once '../models/User.php';

// conexión a la base de datos
$database = new DataBase();
$db = $database->getConnection();

// instancia del modelo 
$user = new User($db);

// se enviaron datos mediante POST ?
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // tomar datos del formulario
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // validar que los campos no estén vacíos
    if (empty($username) || empty($password)) {
        echo "Por favor, completa todos los campos. Redirigiendo...";
        header("Refresh: 5; url=login.html");
        exit;
    }

    // buscar al usuario en la base de datos
    $user_data = $user->userExists($username); 

    if ($user_data) {
        // si existe, verificar la contraseña
        if (password_verify($password, $user_data['userpass'])) {
            // si la contraseña es correcta, iniciar sesión
            session_start();
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['username'] = $user_data['username'];

            // redirigir a la selección
            header("Location: ../views/search/select.php");
            exit;
        } else {
            // si la contraseña no es correcta
            echo "Contraseña incorrecta. Redirigiendo...";
            $previous_page = $_SERVER['HTTP_REFERER'] ?? 'login.html';
            header("Refresh: 5; url=$previous_page");
            exit;
        }
    } else {
        // si el usuario no existe
        echo "Usuario no encontrado. Redirigiendo...";
        $previous_page = $_SERVER['HTTP_REFERER'] ?? 'login.html';
        header("Refresh: 5; url=$previous_page");
        exit;
    }
}
?>
