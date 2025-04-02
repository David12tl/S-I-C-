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

$id_libro = $_GET['id'];

$sql = "SELECT * FROM libros WHERE id_libros = $id_libro";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $libro = $result->fetch_assoc();
    echo json_encode(['success' => true, 'libro' => $libro]);
} else {
    echo json_encode(['success' => false]);
}

$conn->close();
?>
