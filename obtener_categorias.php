<?php
// Se incluye el modelo de Categorias
require_once("modelos/modelo_categorias.php");

$modeloCategoria = new categoriasModelo();

// Se obtienen las Categorias
$listado_categorias = $modeloCategoria->listar();

echo json_encode($listado_categorias);
?>