<?php
// Incluir el método para la conexión a la base de datos
require_once "../Db/Con1Db.php"; 

class Datos
{
    // Devuelve Datos (select)
    public function getData1($sql1, $typeParameters, $p1)
    {
        // Conexión
        $mysqli = Conex1::con1();

        // Protección frente a SQL inyectado (mysql_real_escape_string)
        $p1 = $mysqli->real_escape_string($p1);
        // Sentencia
        $statement = $mysqli->prepare($sql1);
        // Parámetros (ejemplo: si = string integer)
        $statement->bind_param($typeParameters, $p1);
        // Ejecución de la sentencia
        $statement->execute();
        // Obtención del resultado
        $result = $statement->get_result();
        // Obtención del numero de registros devueltos
        $data = [];

        if ($result->num_rows >= 1) {
            // Obtención de los datos
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    'ide_usu' => $row['ide_usu'],
                    'nom_usu' => $row['nom_usu'],
                    'cor_usu' => $row['cor_usu'],
                    'con_usu' => $row['con_usu']
                ];
            }
        }

        // Liberación del conjunto de resultados
        $result->free();
        // Cierre de la declaración
        $statement->close();
        // Cierre de la conexión
        $mysqli->close();

        // Devolución del resultado
        return $data;
    }

    public function getData2($sql1, $typeParameters, $p1)
    {
        // Conexión
        $mysqli = Conex1::con1();

        // Protección frente a SQL inyectado (mysql_real_escape_string)
        $p1 = $mysqli->real_escape_string($p1);
        // Sentencia
        $statement = $mysqli->prepare($sql1);
        // Parámetros (ejemplo: si = string integer)
        $statement->bind_param($typeParameters, $p1);
        // Ejecución de la sentencia
        $statement->execute();
        // Obtención del resultado
        $result = $statement->get_result();
        // Obtención del numero de registros devueltos
        $data = [];

        if ($result->num_rows >= 1) {
            // Obtención de los datos
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    'ide_tar' => $row['ide_tar'],
                    'titulo_tar' => $row['titulo_tar'],
                    'des_tar' => $row['des_tar'],
                    'est_tar' => $row['est_tar'],
                    'fec_tar' => $row['fec_tar']
                ];
            }
        }

        // Liberación del conjunto de resultados
        $result->free();
        // Cierre de la declaración
        $statement->close();
        // Cierre de la conexión
        $mysqli->close();

        // Devolución del resultado
        return $data;
    }

    public function getData3($sql1, $typeParameters, ...$params)
    {
        // Conexión
        $mysqli = Conex1::con1();

        // Preparar la sentencia SQL
        $statement = $mysqli->prepare($sql1);
        
        if (!$statement) {
            return ["error" => "Error en la preparación de la consulta"];
        }

        // Usar "call_user_func_array" para pasar los parámetros dinámicamente
        $statement->bind_param($typeParameters, ...$params);

        // Ejecutar la consulta
        $statement->execute();

        // Obtener el resultado
        $result = $statement->get_result();

        // Almacenar los datos en un array
        $data = [];

        if ($result->num_rows >= 1) {
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    'ide_tar' => $row['ide_tar'],
                    'titulo_tar' => $row['titulo_tar'],
                    'des_tar' => $row['des_tar'],
                    'est_tar' => $row['est_tar'],
                    'fec_tar' => $row['fec_tar']
                ];
            }
        }

        // Liberar memoria y cerrar conexión
        $result->free();
        $statement->close();
        $mysqli->close();

        return $data;
    }

    // Método para ejecutar consultas de inserción, modeficación y eliminación con parámetros preparados
    public function insertData($sql, $typeParameters, ...$params)
    {
        try {
            // Conexión a la base de datos
            $mysqli = Conex1::con1();

            // Preparar la sentencia SQL
            $stmt = $mysqli->prepare($sql);
            if (!$stmt) {
                throw new Exception("Error en la preparación de la consulta: " . $mysqli->error);
            }

            // Vincular los parámetros a la sentencia preparada
            $stmt->bind_param($typeParameters, ...$params);

            // Intento de ejecución de la instrucción
            if (!$stmt->execute()) {
                throw new Exception("Error en la ejecución de la consulta: " . $stmt->error);
            }

            // Éxito en la ejecución
            $result = ["status" => "success", "message" => "Operación realizada con éxito."];

        } catch (Exception $e) {
            // Error en la ejecución
            $result = ["status" => "error", "message" => $e->getMessage()];
        } finally {
            // Cierre de la conexión y la sentencia
            if ($stmt) $stmt->close();
            $mysqli->close();
        }

        // Devolver el resultado de la operación
        return $result;
    }

}
?>
