<?php

// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');

try {
    // Obtener los datos del formulario
    $nom_usu = $_POST['nom_usu'] ?? null;
    $cor_usu = $_POST['cor_usu'] ?? null;

    if (empty($_POST['con_usu'])) {
        throw new Exception("La contraseña no puede estar vacía.");
    }
    $con_usu = password_hash($_POST['con_usu'], PASSWORD_DEFAULT);


    if (!$nom_usu || !$cor_usu || !$con_usu) {
        throw new Exception("Todos los campos son obligatorios.");
    }

    

    // Incluir el modelo y crear una instancia
    require_once "../Models/0InsercionUsuarioModel.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "INSERT INTO usuarios (nom_usu, cor_usu, con_usu) VALUES (?, ?, ?)";
    $typeParameters = "sss"; // String String Integer

    // Llamar al método del modelo para insertar los datos
    $data1 = $obj1->insertData($sql1, $typeParameters, $nom_usu, $cor_usu, $con_usu);
    
    // Enviar la respuesta como JSON
    echo json_encode($data1);

} catch (Exception $e) {
    // Manejo de excepciones y respuesta de error en JSON
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}

?>