<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");
    $adm_recursos = "adm_recursos";

    $id_nombre = trim($_POST['id_nombre']);
    $NOMBRE = trim($_POST['NOMBRE']);
    $CORREO = trim($_POST['CORREO']);
    $CONTRASEÑA = trim($_POST['CONTRASEÑA']);
    $CLAVE_ADM = trim($_POST['CLAVE_REC']);

    $dirLocal = "fotos_empleados";

    if (isset($_FILES['avatar'])) {
        $archivoTemporal = $_FILES['avatar']['tmp_name'];
        $nombreArchivo = $_FILES['avatar']['name'];

        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        // Generar un nombre único y seguro para el archivo
        $nombreArchivo = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
        $rutaDestino = $dirLocal . '/' . $nombreArchivo;

        // Mover el archivo a la ubicación deseada
        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {

            $sql = "INSERT INTO $administradores (id_nombre, NOMBRE, CORREO, CONTRASEÑA, CLAVE_REC) VALUES ('$id_nombre','$NOMBRE', '$CORREO', '$CONTRASEÑA', '$CLAVE_REC')"; 

            if ($conexion->query($sql) === TRUE) {
                header("location:../");
            } else {
                echo "Error al crear el registro: " . $conexion->error;
            }
        } else {
            echo json_encode(array('error' => 'Error al mover el archivo'));
        }
    } else {
        echo json_encode(array('error' => 'No se ha enviado ningún archivo o ha ocurrido un error al cargar el archivo'));
    }
}

/**
 * Función para obtener todos los empleados 
 */

function obtenerEmpleados($conexion)
{
    $sql = "SELECT * FROM adm_recursos ORDER BY id_nombre ASC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado;
}
