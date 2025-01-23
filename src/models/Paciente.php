<?php
class Paciente {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Método para buscar pacientes por DNI
    public function searchByDNI($dni) {
        $stmt = $this->pdo->prepare("SELECT dni, nombre, apellido FROM pacientes WHERE dni LIKE :dni");
        $stmt->execute(['dni' => "%$dni%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
