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
    $CLAVE_ADM = $conexion->real_escape_string($_POST["CLAVE_ADM"]);

    // Validar que la clave sea la correcta
    if ($CLAVE_ADM === "9147520539193") {
        // Consulta SQL para insertar datos
        $sql = "INSERT INTO administradores (NOMBRE, CORREO, CONTRASEÑA, CLAVE_ADM) 
                VALUES ('$NOMBRE', '$CORREO', '$CONTRASEÑA', '$CLAVE_ADM')";

        if ($conexion->query($sql) === TRUE) {
            Include"autor_añadir.php";
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
