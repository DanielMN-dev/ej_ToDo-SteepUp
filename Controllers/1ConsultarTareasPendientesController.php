<?php

    $ide_usu = isset($_GET['id']) ? $_GET['id'] : "";

    if (!$ide_usu) {
        throw new Exception("Falta el Id.");
    }

    // Llamada a la conexión
    require_once '../Db/Con1Db.php';
    // Llamada al modelo
    require_once '../Models/0ConsultaUsuarioModel.php';    

    // Instanciación del objeto
    $obj1 = new Datos;
    // Definición de la instrucción
    $sql1 = "SELECT ide_tar, titulo_tar, des_tar, est_tar, fec_tar FROM tareas WHERE ide_usu LIKE ? AND est_tar='pendiente';";
    // Definición del tipo de parámetros
    $typeParameters = "s"; // String String String 
    // Llamada al método
    $data1 = $obj1->getData2($sql1, $typeParameters, $ide_usu);

    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($data1);

?>