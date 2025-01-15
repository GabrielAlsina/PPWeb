<?php
class Nomenclador
{
    private $db;

    public function __construct($pdo)
    {
        $this->db = $pdo;  // Asignamos la conexión PDO
    }

    public function getByCodigo($codigo)
    {
        $sql = "SELECT * FROM nomenclador WHERE CODIGO = :codigo LIMIT 1";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function searchByKeyword($keyword) {
        $sql = "SELECT CODIGO, LEFT(DESCRIPCION, 100) AS DESCRIPCION 
                FROM nomenclador 
                WHERE CODIGO LIKE :keyword OR DESCRIPCION LIKE :keyword";
        $stmt = $this->db->prepare($sql);
        $stmt->execute(['keyword' => "%" . $keyword . "%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}
