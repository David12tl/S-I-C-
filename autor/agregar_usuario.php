<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conexion = new mysqli("localhost", "root", "", "lexis");

    // Verificar la conexión
    if ($conexion->connect_error) {
        die("Error de conexión: " . $conexion->connect_error);
    }

    // Obtener los datos del formulario
    $NOMBRE = $conexion->real_escape_string($_POST["NOMBRE"]);
    $CORREO = $conexion->real_escape_string($_POST["CORREO"]);
    $CONTRASEÑA = $conexion->real_escape_string($_POST["CONTRASEÑA"]);

    // Consulta SQL para insertar datos
    $sql = "INSERT INTO usuarios (NOMBRE, CORREO, CONTRASEÑA) 
            VALUES ('$NOMBRE', '$CORREO', '$CONTRASEÑA')";

    if ($conexion->query($sql) === TRUE) {
        Include"añadir_users.php";
    } else {
        echo "Error: " . $sql . "<br>" . $conexion->error;
    }

    // Cerrar conexión
    $conexion->close();
}


?>