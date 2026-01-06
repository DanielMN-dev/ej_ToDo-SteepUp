<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    $ide_usu = isset($_GET['id']) ? $_GET['id'] : "";
    // Obtener los datos del formulario
    //$ide_usu = $_POST['ide_usu'] ?? null;
    $titulo_tar = $_POST['titulo_tar'] ?? null;
    $des_tar = $_POST['des_tar'] ?? null;


    if (!$ide_usu || !$titulo_tar || !$des_tar) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    

    // Incluir el modelo y crear una instancia
    require_once "../Models/0InsercionUsuarioModel.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO tareas (ide_usu, titulo_tar, des_tar) VALUES (?, ?, ?)";
    $typeParameters = "sss"; // String String Integer

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $ide_usu, $titulo_tar, $des_tar);
    
    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>