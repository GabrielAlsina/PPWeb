<?php

class User
{
    private $conn;
    private $table_name = "users";

    public $id;
    public $username;
    public $userpass;
    public $email;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // metodo para verificar si el usuario existe (por username o email)
    public function userExists($username, $email = null)
    {
        // Si solo se pasa el username, consulta solo por username
        if ($email === null) {
            $query = "SELECT id, username, userpass, email FROM " . $this->table_name . " WHERE username = :username LIMIT 1";
        } else {
            // Si se pasa el email, consulta por username o email
            $query = "SELECT id, username, userpass, email FROM " . $this->table_name . " WHERE username = :username OR email = :email LIMIT 1";
        }

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $username = htmlspecialchars(strip_tags($username));
        if ($email !== null) {
            $email = htmlspecialchars(strip_tags($email));
        }

        // Vincular los parámetros
        $stmt->bindParam(":username", $username);
        if ($email !== null) {
            $stmt->bindParam(":email", $email);
        }

        // Ejecutar la consulta
        $stmt->execute();

        // Verificar si el usuario o email existen
        if ($stmt->rowCount() > 0) {
            // Si el usuario existe, devolver los datos
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        return false;
    }

    // Método para registrar un nuevo usuario
    public function register($username, $email, $password)
    {
        // Primero, verificar si el usuario o email ya existen
        if ($this->userExists($username, $email)) {
            return false;  // Usuario o email ya existen, no se puede registrar
        }

        // Encriptar la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Consulta SQL para insertar un nuevo usuario
        $query = "INSERT INTO " . $this->table_name . " (username, email, userpass) VALUES (:username, :email, :userpass)";

        $stmt = $this->conn->prepare($query);

        // Enlazar los parámetros
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":userpass", $hashed_password);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
