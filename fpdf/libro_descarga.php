<?php

require('./fpdf.php');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "lexis");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se recibió un ID por la URL
if (!isset($_GET['id_libros']) || empty($_GET['id_libros'])) {
    die("ID del libro no especificado.");
}

$id = intval($_GET['id_libros']); // Sanitizar el ID recibido

class PDF extends FPDF
{
    // Cabecera del PDF
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(190, 10, utf8_decode('Ficha Articulo'), 0, 1, 'C');
        $this->Ln(5);
        $this->Image('logo_ingetec.jpg', 150, 5, 50); 
        $this->Image('TECNM.png', 10, 5, 20); 
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 10);
        $this->Cell(0, 10, utf8_decode('Biblioteca Lexis - Página ') . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);

// Consulta a la base de datos para obtener los datos del libro por ID
$sql = "SELECT Portada, Nombre, Autor, Edicion, Genero, Fecha_Publicacion, Espacio FROM libros WHERE id_libros = $id";
$result = $conexion->query($sql);

// Verificar si se encontró el libro
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $portada = $row['Portada'];
    $nombre = $row['Nombre'];
    $autor = $row['Autor'];
    $edicion = $row['Edicion'];
    $genero = $row['Genero'];
    $fecha_publicacion = $row['Fecha_Publicacion'];
    $espacio = $row['Espacio'];

    // Verificar si la portada está definida
    if ($portada == '') {
        $portada = '../assets/imgs/sin-foto.jpg'; // Imagen por defecto si no hay portada
    } else {
        $portada = "../acciones/fotos_portadas/" . $portada; // Ruta completa de la portada
    }

    // Estilo de la tabla
    $pdf->SetFont('Arial', '', 12);

    // Línea decorativa
    $pdf->SetDrawColor(50, 50, 100);
    $pdf->SetLineWidth(1);
    $pdf->Line(10, $pdf->GetY(), 200, $pdf->GetY());
    $pdf->Ln(5);

    // Mostrar la imagen de la portada si existe
    if (file_exists($portada)) {
        $pdf->Image($portada, 75, $pdf->GetY(), 60, 80);
        $pdf->Ln(90); // Espaciado después de la imagen
    } else {
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(190, 10, utf8_decode('No hay portada disponible'), 0, 1, 'C');
        $pdf->Ln(10);
    }

    // Mostrar los datos del libro
    $pdf->SetFont('Arial', '', 12);
    $pdf->SetFillColor(230, 230, 250); // Color de fondo para las celdas
    $pdf->SetTextColor(0, 0, 0);

    $pdf->Cell(50, 10, 'Nombre:', 1, 0, 'L', true);
    $pdf->Cell(140, 10, utf8_decode($nombre), 1, 1, 'L');

    $pdf->Cell(50, 10, 'Descripcion:', 1, 0, 'L', true);
    $pdf->Cell(140, 10, utf8_decode($autor), 1, 1, 'L');

    $pdf->Cell(50, 10, 'Codigo:', 1, 0, 'L', true);
    $pdf->Cell(140, 10, utf8_decode($edicion), 1, 1, 'L');

    $pdf->Cell(50, 10, 'Tipo:', 1, 0, 'L', true);
    $pdf->Cell(140, 10, utf8_decode($genero), 1, 1, 'L');

    $pdf->Cell(50, 10, 'Fecha de Publicacion:', 1, 0, 'L', true);
    $pdf->Cell(140, 10, utf8_decode($fecha_publicacion), 1, 1, 'L');

    $pdf->Cell(50, 10, 'Espacio:', 1, 0, 'L', true);
    $pdf->Cell(140, 10, utf8_decode($espacio), 1, 1, 'L');

    $pdf->Ln(15); // Espacio para la firma

    // Espacio para firma del usuario
    $pdf->SetFont('Arial', 'I', 12);
    $pdf->Cell(190, 10, 'Firma del usuario: ___________________________', 0, 1, 'C');

} else {
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, utf8_decode('No se encontró el libro con el ID especificado.'), 0, 1, 'C');
}

$pdf->Output('Ficha_Prestamo.pdf', 'I'); // Mostrar el PDF en el navegador
?>
