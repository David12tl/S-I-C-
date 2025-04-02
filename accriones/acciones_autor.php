<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../config/config.php");
    $autores = "autores";

    $id_autor = trim($_POST['id_autor']);
    $nombre = trim($_POST['nombre']);
    $biografia = trim($_POST['biografia']);
    $Libro = trim($_POST['Libro']);
    $fecha_nacimiento = trim($_POST['fecha_nacimiento']);
    $ESTADO = trim($_POST['ESTADO']);

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

            $sql = "INSERT INTO $autores (id_autor, nombre, biografia, Libro, fecha_nacimiento, ESTADO ) VALUES ('$id_autor','$nombre', '$biografia', '$Ligro, '$fecha_nacimiento','$ESTADO')"; 

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
    $sql = "SELECT * FROM autores ORDER BY id_autor ASC";
    $resultado = $conexion->query($sql);
    if (!$resultado) {
        return false;
    }
    return $resultado;
}
