<?php
class Practice {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para buscar prácticas médicas por palabra clave
    public function searchPractice($keyword) {
        $stmt = $this->pdo->prepare("SELECT * FROM practices WHERE name LIKE :keyword");
        $stmt->execute(['keyword' => '%' . $keyword . '%']);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
