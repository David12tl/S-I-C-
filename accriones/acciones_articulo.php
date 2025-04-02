<?php
require '../config/config.php'; // Conexión a la base de datos

// Verificar si el formulario fue enviado correctamente
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar'])) {
    $nombre = $_POST['nombre'];

    // Directorios donde se guardarán los archivos
    $directorioImagen = "fotos_portadas/";
    $directorioArchivos = "fotos_portadas_documentos/";


    // 🔍 CORRECCIÓN: Usar `name="imagen"` y `name="documento"` en el formulario
    if (!empty($_FILES['imagen']['name'])) {
        $nombreImagen = time() . "_" . basename($_FILES['imagen']['name']);
        $rutaImagen = $directorioImagen . $nombreImagen;

        // 📌 Obtener información del archivo
        $extensionImg = strtolower(pathinfo($rutaImagen, PATHINFO_EXTENSION));
        $mimeImg = mime_content_type($_FILES['imagen']['tmp_name']); // Obtener MIME type

        // 📌 Validar formatos permitidos
        $formatosImagenPermitidos = ['jpg', 'jpeg', 'png', 'gif'];
        $mimesImagenPermitidos = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($extensionImg, $formatosImagenPermitidos) || !in_array($mimeImg, $mimesImagenPermitidos)) {
            die(" Formato de imagen no permitido. Solo JPG, PNG y GIF.");
        }

        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen)) {
            die(" Error al subir la imagen.");
        }
    } else {
        die(" La imagen es obligatoria.");
    }

    // 📌 Manejo del documento (Word o PDF)
    if (!empty($_FILES['documento']['name'])) {
        $nombreArchivo = time() . "_" . basename($_FILES['documento']['name']);
        $rutaArchivo = $directorioArchivos . $nombreArchivo;

        // Obtener la extensión y MIME type
        $extensionArchivo = strtolower(pathinfo($rutaArchivo, PATHINFO_EXTENSION));
        $mimeArchivo = mime_content_type($_FILES['documento']['tmp_name']); // Obtener MIME type

        // Validar formatos permitidos
        $formatosArchivoPermitidos = ['pdf', 'doc', 'docx'];
        $mimesArchivoPermitidos = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];

        if (!in_array($extensionArchivo, $formatosArchivoPermitidos) || !in_array($mimeArchivo, $mimesArchivoPermitidos)) {
            die(" Formato de archivo no permitido. Solo PDF, DOC y DOCX.");
        }

        if (!move_uploaded_file($_FILES['documento']['tmp_name'], $rutaArchivo)) {
            die(" Error al subir el archivo.");
        }
    } else {
        die(" El archivo es obligatorio.");
    }

    // 📌 Insertar en la base de datos
    $sql = "INSERT INTO documentos (nombre, portada	, archivo) VALUES (?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sss", $nombre, $rutaImagen, $rutaArchivo);

        if ($stmt->execute()) {
            echo " Documento registrado exitosamente.";
        } else {
            echo " Error al registrar: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo " Error en la consulta.";
    }

    $conexion->close();
} else {
    echo " Acceso denegado.";
}
?>
