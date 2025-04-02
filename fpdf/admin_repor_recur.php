<?php

require('./fpdf.php');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "lexis");
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->Image('logo_ingetec.jpg', 185, 5, 20); // Logo
        $this->SetFont('Arial', 'B', 11); // Fuente
        $this->Cell(45); // Movernos a la derecha
        $this->SetTextColor(0, 0, 0); // Color del texto
        $this->Cell(110, 15, utf8_decode('Reporte de Administradores'), 1, 1, 'C', 0); // Título
        $this->Ln(10); // Salto de línea

        // Encabezado de la tabla
        $this->SetFillColor(228, 100, 0); // Color de fondo
        $this->SetTextColor(255, 255, 255); // Color del texto
        $this->SetDrawColor(163, 163, 163); // Color del borde
        $this->SetFont('Arial', 'B', 9); // Fuente más pequeña
        $this->Cell(15, 10, utf8_decode('ID'), 1, 0, 'C', 1); // Ancho reducido
        $this->Cell(40, 10, utf8_decode('Nombre'), 1, 0, 'C', 1); // Ancho reducido
        $this->Cell(50, 10, utf8_decode('Correo'), 1, 0, 'C', 1); // Ancho reducido
        $this->Cell(40, 10, utf8_decode('Contraseña'), 1, 0, 'C', 1); // Ancho reducido
        $this->Cell(40, 10, utf8_decode('Clave Rec'), 1, 1, 'C', 1); // Ancho reducido
    }

    // Pie de página
    function Footer()
    {
        $this->SetY(-15); // Posición: a 1,5 cm del final
        $this->SetFont('Arial', 'I', 8); // Fuente
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); // Número de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $hoy = date('d/m/Y');
        $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // Fecha
    }
}

$pdf = new PDF();
$pdf->AddPage(); // Agregar página
$pdf->AliasNbPages(); // Total de páginas
$pdf->SetFont('Arial', '', 9); // Fuente más pequeña para las filas
$pdf->SetDrawColor(163, 163, 163); // Color del borde

// Consulta a la base de datos
$sql = "SELECT id_nombre, NOMBRE, CORREO, CONTRASEÑA, CLAVE_REC FROM adm_recursos";
$result = $conexion->query($sql);

// Verificar si hay resultados
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(15, 10, utf8_decode($row['id_nombre']), 1, 0, 'C', 0); // Ancho reducido
        $pdf->Cell(40, 10, utf8_decode($row['NOMBRE']), 1, 0, 'C', 0); // Ancho reducido
        $pdf->Cell(50, 10, utf8_decode($row['CORREO']), 1, 0, 'C', 0); // Ancho reducido
        $pdf->Cell(40, 10, utf8_decode($row['CONTRASEÑA']), 1, 0, 'C', 0); // Ancho reducido
        $pdf->Cell(40, 10, utf8_decode($row['CLAVE_REC']), 1, 1, 'C', 0); // Ancho reducido
    }
} else {
    $pdf->Cell(0, 10, utf8_decode('No se encontraron registros.'), 1, 1, 'C', 0);
}

$pdf->Output('Reporte_Administradores_recursos.pdf', 'I'); // Mostrar el PDF en el navegador
?>
