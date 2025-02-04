<?php 
require_once "../../config/database.php";
require_once "../../models/Nomenclador.php";
require_once "../../models/Paciente.php"; // Importamos el modelo de Paciente
require_once "../../models/ObraSocial.php"; // Importamos el modelo de ObraSocial
require_once "../../controllers/ObraSocialController.php"; // Importamos el controlador de ObraSocial
require_once "../../controllers/NoFacturadoController.php"; // Importamos el controlador de NoFacturado

session_start();

// Conexión a la base de datos
$db = new DataBase();
$pdo = $db->getConnection();

// Modelos
$nomencladorModel = new Nomenclador($pdo);
$pacienteModel = new Paciente($pdo); // Instanciamos el modelo Paciente
$noFacturadoController = new NoFacturadoController(); // Instanciamos el controlador de NoFacturado

// Obtener las obras sociales
$obraSocialController = new ObraSocialController();
$obrasSociales = $obraSocialController->getAll();

// Inicializar carrito si no existe
if (!isset($_SESSION["cart"])) {
    $_SESSION["cart"] = [];
}

// Obtener resultados (AJAX)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"])) {
    $response = [];

    // Búsqueda de prácticas
    if ($_POST["action"] === "search") {
        $keyword = htmlspecialchars($_POST["keyword"]);
        $response = $nomencladorModel->searchByKeyword($keyword);
    }

    // Búsqueda de pacientes
    if ($_POST["action"] === "searchPatient") {
        $dni = htmlspecialchars($_POST["dni"]);
        $response = $pacienteModel->searchByDNI($dni);
    }

    // Inserción de datos en la tabla no_facturados
    if ($_POST["action"] === "insertNoFacturado") {
        $nombre = htmlspecialchars($_POST["nombre"]);
        $apellido = htmlspecialchars($_POST["apellido"]);
        $dni = htmlspecialchars($_POST["dni"]);
        $obraSocial = htmlspecialchars($_POST["obra_social"]);
        $codigo = htmlspecialchars($_POST["codigo"]);

        $insertSuccess = $noFacturadoController->insertarNoFacturado($nombre, $apellido, $dni, $obraSocial, $codigo);
        $response = ["success" => $insertSuccess];
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
    <link rel="stylesheet" href="../../../public/css/navbar.css" />
</head>
<body>
    <header>
        <?php include '../partials/navbar.php' ?>
    </header>
    <br><br>
    <form id="searchForm">
        <div class="container1">
            <div class="search-container-n">
                <input type="text" id="codigo" name="codigo" placeholder="Codigo desde 000001 al 440101 ó por nombre de práctica">
                <button type="button" id="searchBtn">Buscar</button>
            </div>
            <div class="search-container-o">
                <select id="osocial" name="osocial">
                    <option value="">Seleccione obra social</option>
                    <?php foreach ($obrasSociales as $obraSocial): ?>
                        <option value="<?= htmlspecialchars($obraSocial['codigo']) ?>">
                            <?= htmlspecialchars($obraSocial['titulo']) ?> - 
                            Código: <?= htmlspecialchars($obraSocial['codigo']) ?> - 
                            CUIT: <?= htmlspecialchars($obraSocial['cuit']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="container2">
            <div id="patientSearchContainer">
                <input type="text" id="paciente" name="paciente" placeholder="Ingrese DNI del paciente">
                <button type="button" id="searchBtnp">Buscar</button>
            </div>
            <div id="selectedPatientContainer" style="display: none;">
                <span id="patientInfo">
                    <p><strong>DNI:</strong> <span id="patientDNI"></span></p>
                    <p><strong>Nombre:</strong> <span id="patientName"></span></p>
                    <p><strong>Apellido:</strong> <span id="patientLastName"></span></p>
                    <button type="button" id="removePatientBtn">Quitar</button>
                </span>
            </div>
        </div>
    </form>

    <!-- Modal para mostrar resultados de prácticas -->
    <div id="resultsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Resultados de la búsqueda</h2>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Descripción práctica</th>
                        <th>Seleccionar</th>
                    </tr>
                </thead>
                <tbody id="resultsTable"></tbody>
            </table>
        </div>
    </div>

    <!-- Modal para mostrar resultados de pacientes -->
    <div id="patientResultsModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Resultados de búsqueda de paciente</h2>
            <table>
                <thead>
                    <tr>
                        <th>DNI</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody id="patientResultsTable"></tbody>
            </table>
        </div>
    </div>

    <!-- Tabla de seleccionados -->
    <br>
    <div id="practicasDiv">
        <h2>Practicas realizadas</h2>
        <div id="practicaBtns">
            <button type="button" id="removepracticasBtn">Cancelar</button>
            <button type="button" id="sendBtn">Confirmar</button>
        </div>
    </div>
    <table border="1" id="selectedTable">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción práctica</th>
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

    <script src="../../../public/js/jquery.min.js"></script>
    <script src="../../../public/js/s-code.js"></script>
</body>
</html>
