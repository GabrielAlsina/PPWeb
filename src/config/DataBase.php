<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Dotenv\Dotenv;

class DataBase
{
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $conn;

    public function __construct()
    {
        // para cargar variables de entorno desde el .env
        $dotenv = Dotenv::createImmutable(__DIR__);
        $dotenv->load();

        // Asignar los valores de las variables de entorno a las propiedades
        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
    }

    public function getConnection()
    {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exception) {
            echo "Conexión fallida: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
