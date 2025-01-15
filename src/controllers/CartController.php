<?php
require_once "../models/nomenclador.php";
require_once "../config/database.php";

class CartController
{
    private $nomencladorModel;
    private $db;

    public function __construct()
    {

        $this->db = new DataBase();

        $pdo = $this->db->getConnection();

        $this->nomencladorModel = new Nomenclador($pdo);
    }

    public function handleRequest()
    {
        session_start();

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            // tomo lo que hay en "codigo" del formulario
            $codigo = htmlspecialchars($_POST["codigo"]);

            // buscar por codigo
            $producto = $this->nomencladorModel->getByCodigo($codigo);

            if ($producto) {
                // si no existe carrito, lo inicializo
                if (!isset($_SESSION["cart"])) {
                    $_SESSION["cart"] = [];
                }
            
                // Agregar el producto al carrito
                $_SESSION["cart"][] = $producto;
            
                // Redirigir con éxito y mostrar alerta
                echo "<script>
                        alert('Producto agregado al carrito.');
                        window.location.href = '../views/search/s-code.html';
                      </script>";
            } else {
                // Producto no encontrado
                echo "<script>
                        alert('Código no encontrado.');
                        window.location.href = '../views/search/s-code.html';
                      </script>";
            }
            
        } elseif ($_SERVER["REQUEST_METHOD"] === "GET" && isset($_GET["action"]) && $_GET["action"] === "remove") {
            // Manejo de la acción de eliminar del carrito
            $codigo = htmlspecialchars($_GET["codigo"]);

            if (isset($_SESSION["cart"])) {
                // Filtrar el carrito para eliminar el producto con el código proporcionado
                $_SESSION["cart"] = array_filter($_SESSION["cart"], function ($item) use ($codigo) {
                    return $item["CODIGO"] !== $codigo;
                });
            }

            echo "<script>
                    alert('Producto eliminado del carrito.');
                    window.location.href = '../views/search/s-code.html';
                  </script>";
        }
    }
}

// Instancia del controlador y manejo de la solicitud
$controller = new CartController();
$controller->handleRequest();