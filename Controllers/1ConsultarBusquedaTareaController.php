<?php
header('Content-Type: application/json');

// Obtener el ID del usuario desde la URL
$ide_usu = isset($_GET['id']) ? $_GET['id'] : null;

// Validar que el ID del usuario sea un número válido
if (empty($ide_usu) || !ctype_digit($ide_usu)) {
    echo json_encode(["error" => "Id inválido o faltante"]);
    exit;
}

// Obtener datos JSON de la solicitud
$inputJSON = file_get_contents("php://input");

// Validar que se hayan recibido datos
if (!$inputJSON) {
    echo json_encode(["error" => "No se recibieron datos en la petición"]);
    exit;
}

$datos = json_decode($inputJSON, true);

// Validar que el JSON se haya decodificado correctamente
if ($datos === null) {
    echo json_encode(["error" => "Error al decodificar JSON"]);
    exit;
}

// Verificar si se recibieron los datos esperados
if (!is_array($datos) || !array_key_exists("texto", $datos) || !array_key_exists("estado", $datos)) {
    echo json_encode(["error" => "Datos incompletos"]);
    exit;
}

// Preparar variables para la consulta
$busqueda = "%" . $datos["texto"] . "%";
$estado = $datos["estado"];

// Incluir archivos necesarios
require_once '../Db/Con1Db.php';
require_once '../Models/0ConsultaUsuarioModel.php';

// Instanciar el objeto para acceder a la base de datos
$obj1 = new Datos();

// Definir la consulta SQL
$sql1 = "SELECT ide_tar, titulo_tar, des_tar, est_tar, fec_tar 
         FROM tareas 
         WHERE ide_usu = ? 
         AND est_tar = ? 
         AND (titulo_tar LIKE ? OR des_tar LIKE ? OR fec_tar LIKE ?) 
         ORDER BY titulo_tar, des_tar, fec_tar";

// Definir los tipos de parámetros (todos son strings)
$typeParameters = "sssss";

// Ejecutar la consulta
$data1 = $obj1->getData3($sql1, $typeParameters, $ide_usu, $estado, $busqueda, $busqueda, $busqueda);

// Verificar si la consulta tuvo éxito
if ($data1 === false) {
    echo json_encode(["error" => "Error en la consulta"]);
    exit;
}

// Devolver los datos en formato JSON
echo json_encode(["success" => true, "data" => $data1]);
?>

