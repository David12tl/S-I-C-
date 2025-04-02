<?php
/*
ini_set('display_errors', 1);
error_reporting(E_ALL);
*/

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("../config/config.php");
    $Libros = "libros";
 
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $espacio = $_POST['espacio'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $edicion = $_POST['edicion'];
    $genero = $_POST['genero'];
    $portada = $_FILES['Portada'];

    $dirlocal = "fotos_portadas";
    
    if (isset($_FILES['Portada'])) {
        $archivoTemporal = $_FILES['Portada']['tmp_name'];
        $nombreArchivo = $_FILES['Portada']['name'];

        $extension = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));

        $nombreArchivo = substr(md5(uniqid(rand())), 0, 10) . "." . $extension;
        $rutaDestino = $dirlocal . '/' . $nombreArchivo;

        if (move_uploaded_file($archivoTemporal, $rutaDestino)) {
            $sql = "INSERT INTO $Libros (nombre, autor, espacio, fecha_publicacion, edicion, genero, portada, estado) 
            VALUES ('$nombre', '$autor', '$espacio', '$fecha_publicacion', '$edicion', '$genero', '$nombreArchivo', 'disponible')";

            if ($conexion->query($sql) === TRUE) {
                header("location:../");
            } else {
                echo "Error al crear el registro: " . $conexion->error;
            }
        } else {
            echo json_encode(array('error' => 'Error al mover el archivo'));
        }
    }
}

function obtenerLibros($conexion) {
    $sql = "SELECT * FROM libros WHERE espacio IN ('disponible', 'ocupado', 'reservado')";
    $result = $conexion->query($sql);
    return $result;
}