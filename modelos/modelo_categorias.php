<?php
// CLASE BASE PARA TRABAJAR CON MySQL
require_once("librerias/modelo_base_mysqli.php");

class categoriasModelo extends ModeloBase
{
	public function __construct() {
		parent::__construct();
	}
	
	public function conectar() {
		return parent::conectarDB();
	}

	public function listar()
	{	
		$conexion = $this->conectar();
		
		$query = "SELECT * FROM ".$this->tabla_categorias." WHERE c_habilitado = 1";

		$resultado = $this->ejecutarQuery($query);
		
		$datos = $this->obtenerCjtoRegistrosDB($resultado);
		
		$this->desconectarDB($conexion);
		
		return $datos;
	}
}