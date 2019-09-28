<?php
// Clase abstracta utilizando la librería mysqli de PHP
abstract class ModeloBase 
{
	private $conexion;
	private $servidor;
    private $usuario;
    private $password;
    private $base_datos;

    protected $tabla_categorias;
	
    public function __construct()
    {
		$this->servidor   = "localhost";
		$this->base_datos = "negocio";
		$this->usuario    = "root";
		$this->password   = "";
		// Nombre de las tablas de la DB
		$this->tabla_categorias = $this->base_datos.'.categorias';
	}

	/**
	 * Establece la conexión con la base de datos
	 * @return resource $this->conexion
	 */
	public function conectarDB()
	{
		// Se conecta a la base de datos
		$this->conexion = new mysqli($this->servidor, $this->usuario, $this->password, $this->base_datos);
		
		// Si surgió un error
		if ($this->conexion->connect_errno)
			throw new RuntimeException("Falló la conexión a MySQL:" . $this->conexion->connect_error);
				
		// Se establece la codificación utf-8
		$this->conexion->set_charset("utf8");
		
		return $this->conexion;	
	}

    /**
     * Se cierra la conexión
     * @param $pconexion
     */
    public function desconectarDB($pconexion)
    {
		$pconexion->close();	
	}
	
    /**
     * Ejecuta una query determinada,
     * en caso de surgir un error se registra en un archivo de log de errores y lanza una excepción
     * @param string $query
     * @return resource $resultado
     */
    public function ejecutarQuery($query)
    {
		if ($query == null)
			return null;

		// Se ejecuta la query
		$resultado = $this->conexion->query($query);
		
		// Si surgió un error
		if ( !$resultado ) {
			// Se registra el error
			$this->registrarErrorSQL($this->conexion->errno, $this->conexion->error, $query);
			
			// Se lanza la excepción
			throw new RuntimeException("Error al ejecutar la query:".$this->conexion->error);
		}
		
		return $resultado;
	}	

	/**
	 * Se registra el error al ejecutar una consulta SQL determinada, en el directorio "sgl/log/"
	 * 
	 * @param integer $numero_error
	 * @param string $texto_error
	 * @param string $query_error
	 */
	public function registrarErrorSQL($numero_error, $texto_error, $query_error)
	{
		$info_del_error  = "#####################################################";
		$info_del_error .= "\n Usuario: ".$this->usuario;
		$info_del_error .= "\n Fecha y hora: ".date("d/m/Y H:i")." hs.";
		$info_del_error .= "\n #####################################################";
		$info_del_error .= "\n Error # ".$numero_error;
		$info_del_error .= "\n\n Mensaje del Error: ".$texto_error;
		$info_del_error .= "\n\n En la siguiente consulta SQL:\n\n";
		$info_del_error .= $query_error;
				
		fputs(fopen("error_al_ejecutar_query.txt", 'w'), print_r($info_del_error, true));
	}
	
    /**
     * Devuelve un array asociativo con la información obtenida de una query determinada,
     * en caso que la query no devuelva información retorna null
     * @param resource $resultado
     * @return NULL|array asociativo
     */
    public function obtenerCjtoRegistrosDB($resultado)
	{
		// Si no se recibió ningún resultado
		if ($resultado == null)
			return null;

		$datos = null;
		$i = 0;
		while ( $row = $resultado->fetch_assoc() ) {
			$datos[$i] = $row;
			$i++;
		}
		
		return $datos;
    }
    
	/**
	 * Se obtiene un array asociativo con el resultado de una query
	 * @param resource $resultado
	 * @return array Registro obtenido
	 */
	public function obtenerRegistroDB($resultado)
	{
		return ($resultado != null) ? $resultado->fetch_assoc() : null;
	}
	
}
?>
