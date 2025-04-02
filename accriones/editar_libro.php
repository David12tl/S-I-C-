<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lexis";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Depuración: Verifica los datos recibidos
    error_log(print_r($_POST, true));
    error_log(print_r($_FILES, true));

    $id_libros = $_POST['id_libros'];
    $nombre = $_POST['nombre'];
    $autor = $_POST['autor'];
    $edicion = $_POST['edicion'];
    $genero = $_POST['genero'];
    $fecha_publicacion = $_POST['fecha_publicacion'];
    $espacio = $_POST['espacio'];

    if (isset($_FILES['Portada']) && $_FILES['Portada']['error'] == 0) {
        $Portada = $_FILES['Portada']['name'];
        $target_dir = "../acciones/fotos_portadas/";
        $target_file = $target_dir . basename($Portada);
        
        // Verificar si el archivo es una imagen real
        $check = getimagesize($_FILES['Portada']['tmp_name']);
        if($check !== false) {
            if (move_uploaded_file($_FILES['Portada']['tmp_name'], $target_file)) {
                // Imagen subida correctamente
            } else {
                echo json_encode(['success' => false, 'error' => 'Error al subir la imagen.']);
                exit();
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'El archivo no es una imagen.']);
            exit();
        }
    } else {
        $Portada = $_POST['PortadaActual'];
    }

    // Preparar la declaración SQL para evitar inyecciones SQL
    $stmt = $conn->prepare("UPDATE libros SET nombre=?, autor=?, edicion=?, genero=?, fecha_publicacion=?, espacio=?, Portada=? WHERE id_libros=?");
    $stmt->bind_param("sssssssi", $nombre, $autor, $edicion, $genero, $fecha_publicacion, $espacio, $Portada, $id_libros);

    if ($stmt->execute() === TRUE) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
}
?>
