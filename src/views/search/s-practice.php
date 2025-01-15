
<?php
require_once "../../config/database.php";
require_once "../../models/nomenclador.php";

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

// Manejo del formulario
$message = "";
$productos = [];
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["codigo"])) {
    $codigo = htmlspecialchars($_POST["codigo"]);

    // Buscar productos en la base de datos
    $productos = $nomencladorModel->searchByKeyword($codigo);

    if ($productos) {
        $_SESSION["message"] = "Resultados encontrados.";
    } else {
        $_SESSION["message"] = "No se encontraron prácticas médicas.";
    }

    // Redirigir para evitar reenvío del formulario
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// Agregar producto al carrito
if (isset($_GET['action']) && $_GET['action'] === 'add' && isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    if (isset($productos[$index])) {
        $_SESSION["cart"][] = $productos[$index];  // Agregar al carrito
        $_SESSION["message"] = "Producto agregado al carrito.";
    }
    // Redirigir para evitar reenvío del formulario
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// Eliminar producto del carrito
if (isset($_GET['action']) && $_GET['action'] === 'remove' && isset($_GET['index'])) {
    $index = (int)$_GET['index'];
    if (isset($_SESSION["cart"][$index])) {
        unset($_SESSION["cart"][$index]);  // Eliminar del carrito
        $_SESSION["cart"] = array_values($_SESSION["cart"]);  // Reindexar el arreglo
        $_SESSION["message"] = "Producto eliminado del carrito.";
    }
    // Redirigir para evitar reenvío del formulario
    header("Location: " . $_SERVER["PHP_SELF"]);
    exit;
}

// Obtener mensaje almacenado en sesión (si existe)
if (isset($_SESSION["message"])) {
    $message = $_SESSION["message"];
    unset($_SESSION["message"]);
}

// Carrito actual
$cart = $_SESSION["cart"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar práctica médica</title>
    <link rel="stylesheet" href="../../../public/css/s-practice.css" />
</head>
<body>
<header>
    <div id="goHome">
        <a href="../home.html" class="button-link">Ir al inicio</a>
    </div>
</header>

<h1>Buscar práctica médica</h1>
<form action="" method="POST">
    <label for="codigo">Palabra clave</label>
    <input type="text" id="codigo" name="codigo" placeholder="Ej: Laberintectomia" required><br><br>
    <button type="submit" class="btn btn-outline-primary">Enviar</button>
    <button type="reset" class="btn btn-outline-primary">Resetear</button>
</form>

<!-- Mostrar mensaje -->
<?php if (!empty($message)): ?>
    <p style="color: green;"><?= htmlspecialchars($message) ?></p>
<?php endif; ?>

<!-- Mostrar resultados de búsqueda -->
<?php if (!empty($productos)): ?>
    <h2>Resultados de búsqueda</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($productos as $index => $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item["CODIGO"]) ?></td>
                    <td><?= htmlspecialchars($item["DESCRIPCION"]) ?></td>
                    <td>
                        <a href="?action=add&index=<?= $index ?>">Agregar al carrito</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- Mostrar el carrito -->
<h2>Carrito de Compras</h2>
<?php if (empty($cart)): ?>
    <p>El carrito está vacío.</p>
<?php else: ?>
    <table border="1">
        <thead>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $index => $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item["CODIGO"]) ?></td>
                    <td><?= htmlspecialchars($item["DESCRIPCION"]) ?></td>
                    <td>
                        <a href="?action=remove&index=<?= $index ?>">Eliminar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

</body>
</html>
