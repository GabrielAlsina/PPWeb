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
    $username = $_POST['username'];
    $password = $_POST['password'];

    // el usuario existe?
    $user_data = $user->userExists($username); 

    if ($user_data) {
        // si existe, verificar la contraseña
        if (password_verify($password, $user_data['userpass'])) {
            // si la contraseña es correcta, iniciar sesión
            session_start();
            $_SESSION['user_id'] = $user_data['id'];
            $_SESSION['username'] = $user_data['username'];

            // redirigir a la seleccion
            header("Location: ../views/search/select.html");
            exit;
        } else {
            // si la contraseña no es correcta
            echo "Contraseña incorrecta. Redirigiendo...";
            
            // Redirigir a la página anterior (si existe)
            $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'login.html';
            
            // Redirigir a la página anterior después de 5 segundos
            header("Refresh: 5; url=$previous_page");
            exit;
        }
    } else {
        // Si el usuario no existe
        echo "Usuario no encontrado. Redirigiendo...";

        // Redirigir a la página anterior después de 5 segundos
        $previous_page = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : 'login.html';
        
        // Redirigir a la página anterior después de 5 segundos
        header("Refresh: 5; url=$previous_page");
        exit;
    }
}

?>
