<?php
header('Content-Type: application/json');

// Obtener el ID del usuario desde la URL
$ide_tar = isset($_GET['id']) ? $_GET['id'] : null;

// Validar que el ID del usuario sea un número válido
if (empty($ide_tar) || !ctype_digit($ide_tar)) {
    echo json_encode(["error" => "Id inválido o faltante"]);
    exit;
}

//$ide_usu = "%" . $ide_usu . "%";


// Incluir archivos necesarios
require_once '../Db/Con1Db.php';
require_once '../Models/0ConsultaUsuarioModel.php';

// Instanciar el objeto para acceder a la base de datos
$obj1 = new Datos();

// Definir la consulta SQL
$sql1 = "DELETE FROM tareas WHERE ide_tar = ?;";

// Definir los tipos de parámetros (todos son strings)
$typeParameters = "s";

// Ejecutar la consulta
$data1 = $obj1->insertData($sql1, $typeParameters, $ide_tar);

// Verificar si la consulta tuvo éxito
if ($data1 === false) {
    echo json_encode(["error" => "Error en la consulta"]);
    exit;
}

// Devolver los datos en formato JSON
echo json_encode(["success" => true, "data" => $data1]);
?>

