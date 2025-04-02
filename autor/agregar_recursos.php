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
    $CLAVE_REC = $conexion->real_escape_string($_POST["CLAVE_REC"]);

    // Validar que la clave sea la correcta
    if ($CLAVE_REC === "1991920513110") {
        // Consulta SQL para insertar datos
        $sql = "INSERT INTO adm_recursos (NOMBRE, CORREO, CONTRASEÑA, CLAVE_REC) 
                VALUES ('$NOMBRE', '$CORREO', '$CONTRASEÑA', '$CLAVE_REC')";

        if ($conexion->query($sql) === TRUE) {
            Include"añadir_admin_rec.php";
        } else {
            echo "Error: " . $sql . "<br>" . $conexion->error;
        }
    } else {
        echo "Error: La clave de recurso es incorrecta.";
    }

    // Cerrar conexión
    $conexion->close();
}
?>