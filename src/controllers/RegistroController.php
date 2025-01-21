<?php
include_once '../config/Database.php';
include_once '../models/User.php';

// Crear la conexión a la base de datos
$database = new Database();
$db = $database->getConnection();

// Crear una instancia del modelo de usuario
$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['pass'] ?? '';

    // Validar que todos los campos estén completos
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode([
            'success' => false,
            'message' => 'Todos los campos son obligatorios.'
        ]);
        exit;
    }

    // Comprobar si el usuario o el correo ya existen
    if ($user->userExists($username, $email)) {
        echo json_encode([
            'success' => false,
            'message' => 'El usuario o el correo electrónico ya están registrados.'
        ]);
        exit;
    }

    // Registrar el usuario solo si no existe
    if ($user->register($username, $email, $password)) {
        echo json_encode([
            'success' => true,
            'message' => 'Usuario registrado exitosamente.'
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Hubo un error al registrar el usuario. Inténtalo nuevamente.'
        ]);
    }
}
