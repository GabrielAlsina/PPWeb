<?php
// controllers/ObraSocialController.php

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../models/ObraSocial.php';

class ObraSocialController
{
    private $obraSocialModel;

    public function __construct()
    {
        $db = new DataBase();
        $pdo = $db->getConnection();
        $this->obraSocialModel = new ObraSocial($pdo);
    }

    // Método para obtener todas las obras sociales
    public function getAll()
    {
        return $this->obraSocialModel->getAll();
    }
}