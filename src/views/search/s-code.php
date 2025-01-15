<?php
require_once "../../config/database.php";
require_once "../../models/Nomenclador.php";

session_start();

// Conexión a la base de datos
$db = new DataBase();
$pdo = $db->getConnection();

// Modelo nomenclador
$nomencladorModel = new Nomenclador($pdo);

// Inicializar carrito si no existe
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Obtener resultados (AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $response = [];
    if ($_POST["action"] === "search") {
        $keyword = htmlspecialchars($_POST["keyword"]);
        $response = $nomencladorModel->searchByKeyword($keyword);
    }
    echo json_encode($response);
    exit;
}

// Carrito actual
$cart = $_SESSION["cart"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar práctica</title>
    <link rel="stylesheet" href="../../../public/css/s-code.css">
</head>
<body>
<header>
    <div id="goHome">
        <a href="./select.html" class="button-link">Ir al inicio</a>
    </div>
</header>

<h1>Buscar práctica</h1>
<form id="searchForm">
    <label for="codigo">Buscar por código o descripción:</label>
    <div class="search-container">
        <input type="text" id="codigo" name="codigo" placeholder="Codigo desde 000001 al 440101 ó por nombre de práctica">
        <button type="button" id="searchBtn">Buscar</button>
    </div>
</form>

<!-- Modal para mostrar resultados -->
<div id="resultsModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2>Resultados de la búsqueda</h2>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody id="resultsTable"></tbody>
        </table>
    </div>
</div>

<!-- Tabla de seleccionados -->
<br>
<h2>Seleccionados</h2>
<table border="1" id="selectedTable">
    <thead>
        <tr>
            <th>Código</th>
            <th>Descripción</th>
            <th>Eliminar</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cart as $index => $item): ?>
            <tr>
                <td><?= htmlspecialchars($item["CODIGO"]) ?></td>
                <td><?= htmlspecialchars($item["DESCRIPCION"]) ?></td>
                <td><button type="button" class="removeBtn" data-index="<?= $index ?>">Eliminar</button></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<script src="../../../public/js/s-code.js"></script>
</body>
</html>
