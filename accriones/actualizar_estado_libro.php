<?php
// filepath: c:\xampp\htdocs\LEXIS\acciones\actualizar_estado_libro.php
include '../config/db.php'; // Asegúrate de incluir tu conexión a la base de datos

$id_libros = $_POST['id_libros'];
$nuevo_estado = $_POST['nuevo_estado'];

if ($nuevo_estado == 'reservado') {
    // Cambiar el estado a "reservado"
    $query = "UPDATE libros SET espacio = 'reservado' WHERE id_libros = $id_libros";
    if (mysqli_query($conn, $query)) {
        // Configurar un temporizador para volver a "disponible" después de 1 minuto
        sleep(60); // Esperar 1 minuto
        $query = "UPDATE libros SET espacio = 'disponible' WHERE id_libros = $id_libros";
        mysqli_query($conn, $query);

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el estado del libro.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Estado no válido.']);
}
?>