<?php

// Incluir la configuración de la base de datos y el modelo de contacto
include_once '../config/Database.php';
include_once '../models/Contacto.php';

// Crear la conexión a la base de datos
$database = new DataBase();
$db = $database->getConnection();

// Crear una instancia del modelo de contacto
$contacto = new Contacto($db);

// Comprobar si se enviaron datos mediante POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibir los datos del formulario
    $nombre = $_POST['nombre'] ?? null;
    $email = $_POST['email'] ?? null;
    $telefono = $_POST['telefono'] ?? null;
    $tema = $_POST['tema'] ?? null;
    $comentarios = $_POST['comentarios'] ?? null;

    // Validar que los campos obligatorios no estén vacíos
    if (!$nombre || !$email || !$tema) {
        echo "Por favor, completa todos los campos obligatorios.";
        header("Refresh: 5; url=" . $_SERVER['HTTP_REFERER']);
        exit;
    }

    // Registrar los datos en la base de datos
    $resultado = $contacto->registrarContacto($nombre, $email, $telefono, $tema, $comentarios);

    if ($resultado) {
        echo "Gracias por tu mensaje. Nos pondremos en contacto contigo pronto.";
    } else {
        echo "Hubo un problema al enviar tu mensaje. Inténtalo de nuevo más tarde.";
    }

    // Redirigir a la página anterior después de 5 segundos
    header("Refresh: 5; url=" . $_SERVER['HTTP_REFERER']);
    exit;
}
?>
