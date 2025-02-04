<?php
// controllers/NoFacturadoController.php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/NoFacturado.php';

class NoFacturadoController
{
    private $noFacturadoModel;

    public function __construct()
    {
        $db = new DataBase();
        $pdo = $db->getConnection();
        $this->noFacturadoModel = new NoFacturado($pdo);
    }

    // Método para insertar un nuevo registro de no facturado
    public function insertarNoFacturado($nombre, $apellido, $dni, $obraSocial, $codigo)
    {
        return $this->noFacturadoModel->insertarNoFacturado($nombre, $apellido, $dni, $obraSocial, $codigo);
    }
}
?>
