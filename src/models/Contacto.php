<?php

class Contacto {
    private $conn;
    private $table_name = "contactos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Método para registrar un contacto
    public function registrarContacto($nombre, $email, $telefono, $tema, $comentarios) {
        // Consulta SQL para insertar un nuevo contacto
        $query = "INSERT INTO " . $this->table_name . " 
                  (nombre, email, telefono, tema, comentarios) 
                  VALUES (:nombre, :email, :telefono, :tema, :comentarios)";

        // Preparar la consulta
        $stmt = $this->conn->prepare($query);

        // Limpiar los datos
        $nombre = htmlspecialchars(strip_tags($nombre));
        $email = htmlspecialchars(strip_tags($email));
        $telefono = htmlspecialchars(strip_tags($telefono));
        $tema = htmlspecialchars(strip_tags($tema));
        $comentarios = htmlspecialchars(strip_tags($comentarios));

        // Vincular los parámetros
        $stmt->bindParam(":nombre", $nombre);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":telefono", $telefono);
        $stmt->bindParam(":tema", $tema);
        $stmt->bindParam(":comentarios", $comentarios);

        // Ejecutar la consulta
        return $stmt->execute();
    }
}

?>
