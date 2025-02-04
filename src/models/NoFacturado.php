<?php
// models/NoFacturado.php

class NoFacturado
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para insertar un nuevo registro en la tabla 'no_facturados'
    public function insertarNoFacturado($nombre, $apellido, $dni, $obraSocial, $codigo)
    {
        $sql = "INSERT INTO no_facturados (nombre, apellido, dni, obra_social, codigo) 
                VALUES (:nombre, :apellido, :dni, :obra_social, :codigo)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->bindParam(':nombre', $nombre, PDO::PARAM_STR);
        $stmt->bindParam(':apellido', $apellido, PDO::PARAM_STR);
        $stmt->bindParam(':dni', $dni, PDO::PARAM_STR);
        $stmt->bindParam(':obra_social', $obraSocial, PDO::PARAM_STR);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        
        try {
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }
}
?>
