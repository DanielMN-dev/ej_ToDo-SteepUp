<?php


// Configurar el encabezado de respuesta como JSON
header('Content-Type: application/json');
try{

    // Obtener los datos del formulario
    $cor_usu = $_POST['cor_usu'] ?? null;
    $cor_usu = "%" . $cor_usu . "%";

    if (empty($_POST['con_usu'])) {
        throw new Exception("La contraseña no puede estar vacía.");
    }
    $con_usu = $_POST['con_usu'];

    /*
    if (!$cor_usu || !$con_usu) {
        throw new Exception("Todos los campos son obligatorios.");
    }*/

    // Incluir el modelo y crear una instancia
    require_once "../Models/0ConsultaUsuarioModel.php";
    $obj1 = new Datos();

    // Definir la instrucción SQL y los tipos de parámetros
    $sql1 = "SELECT ide_usu, nom_usu, cor_usu, con_usu FROM usuarios WHERE cor_usu LIKE ?";
    $typeParameters = "s"; // String

    // Obtener los datos del usuario
    $data1 = $obj1->getData1($sql1, $typeParameters, $cor_usu);

    /*
    // Verificar si el correo existe
    if (count($data1) === 0) {
        throw new Exception("El correo no está registrado.");
    }*/

    // Guardar el hash de la contraseña que viene de la base de datos
    if (!empty($data1)) {
        $hash_guardado = $data1[0]['con_usu'];
    
        if (password_verify($con_usu, $hash_guardado)) {
            $nombreUsu = $data1[0]['nom_usu'];
            $ideUsu = $data1[0]['ide_usu'];
            echo json_encode([
                "status" => "success",
                "message" => "Inicio de sesión exitoso.",
                "nombreUsu" => $nombreUsu,
                "ideUsu" => $ideUsu
            ]);
        } else {
            throw new Exception("Contraseña incorrecta.");
        }
    } else {
        throw new Exception("El correo no está registrado.");
    }

    
    /*
    $nombreUsu = $data1[0]['nom_usu'];
    // Devolución de datos en formato JSON
    header('Content-Type: application/json');
    echo json_encode($nombreUsu);*/

}
catch (Exception $e) {
    
    echo json_encode([
        "status" => "error",
        "message" => $e->getMessage()
    ]);
}
?>
