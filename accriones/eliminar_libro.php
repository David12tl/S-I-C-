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

$data = json_decode(file_get_contents("php://input"), true);
$id_libro = $data['id_libro'];
$portada = $data['portada'];

$sql = "DELETE FROM libros WHERE id_libros = $id_libro";

if ($conn->query($sql) === TRUE) {
    if ($portada && $portada != 'assets/imgs/sin-foto.jpg') {
        unlink("../acciones/fotos_portadas/" . $portada);
    }
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $conn->error]);
}

$conn->close();
?>
