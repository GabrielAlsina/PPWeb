<?php
// models/ObraSocial.php

class ObraSocial
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    // Método para obtener todas las obras sociales
    public function getAll()
    {
        $query = "SELECT titulo, codigo, cuit FROM obras_sociales";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}