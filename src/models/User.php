<?php

class User
{
    private $conn;
    private $table_name = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // Método para obtener datos del usuario por username o email
    public function getUser($username)
    {
        $query = "SELECT * 
                  FROM " . $this->table_name . " 
                  WHERE username = :username 
                  LIMIT 1";

        $stmt = $this->conn->prepare($query);

        // Limpiar y vincular parámetros
        $username = htmlspecialchars(strip_tags($username));
        $stmt->bindParam(":username", $username);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna los datos del usuario o false
        }

        return false; // En caso de error, retorna false
    }

    public function userExists($username)
{
    $query = "SELECT * 
              FROM " . $this->table_name . " 
              WHERE username = :username 
              LIMIT 1";

    $stmt = $this->conn->prepare($query);

    // Limpiar y vincular parámetros
    $username = htmlspecialchars(strip_tags($username));
    $stmt->bindParam(":username", $username);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        return $stmt->fetch(PDO::FETCH_ASSOC); // Retorna los datos del usuario o false si no existe
    }

    return false; // En caso de error, retorna false
}


    // Método para registrar un nuevo usuario
    public function register($username, $email, $password)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $query = "INSERT INTO " . $this->table_name . " (username, email, userpass) 
                  VALUES (:username, :email, :userpass)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $username);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":userpass", $hashed_password);

        return $stmt->execute();
    }
}
