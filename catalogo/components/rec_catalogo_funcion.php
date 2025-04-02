<?php
// Conexión a la base de datos
$con = mysqli_connect("localhost", "root", "", "lexis");

// Verificar si se recibió el ID del libro
if (isset($_GET['id'])) {
    $id_libro = $_GET['id'];

    // Consulta para obtener los detalles del libro
    $query = "SELECT * FROM libros WHERE id_libros = $id_libro";
    $result = mysqli_query($con, $query);

    // Verificar si se encontró el libro
    if (mysqli_num_rows($result) > 0) {
        $libro = mysqli_fetch_assoc($result); // Nota: Usamos $libro en minúsculas
        ?>
        <div class="container mt-5">
            <h1>Detalles del Libro</h1>
            <table class="table table-bordered">
                <tr>
                    <th>Nombre</th>
                    <td><?php echo $libro['nombre']; ?></td>
                </tr>
                <tr>
                    <th>Autor</th>
                    <td><?php echo $libro['autor']; ?></td>
                </tr>
                <tr>
                    <th>Edición</th>
                    <td><?php echo $libro['edicion']; ?></td>
                </tr>
                <tr>
                    <th>Género</th>
                    <td><?php echo $libro['genero']; ?></td>
                </tr>
                <tr>
                    <th>Fecha de Publicación</th>
                    <td><?php echo $libro['fecha_publicacion']; ?></td>
                </tr>
                <tr>
                    <th>Espacio</th>
                    <td><?php echo $libro['espacio']; ?></td>
                </tr>
                <tr>
                    <th>Portada</th>
                    <td>
                        <?php
                        $Portada = $libro['Portada'];
                        if ($Portada == '') {
                            $Portada = '../assets/imgs/sin-foto.jpg';
                        } else {
                            $Portada = "../acciones/fotos_portadas/" . $Portada;
                        }
                        ?>
                        <img src="<?php echo $Portada; ?>" alt="<?php echo $libro['nombre']; ?>" style="width: 200px; height: auto;">
                    </td>
                </tr>
                <tr>
                <td>
                    <?php
                        if ($libro['espacio'] == 'disponible') { // Cambiado $Libro a $libro
                            echo '<a href="../fpdf/libro_descarga.php?id_libros=' . $libro['id_libros'] . '" target="_blank" class="btn btn-success" style="display: block; text-align: center;"><h3>DESCARGAR</h3></a>';
                        } elseif ($libro['espacio'] == 'reservado') { // Cambiado $Libro a $libro
                            echo "";
                        } elseif ($libro['espacio'] == 'ocupado') { // Cambiado $Libro a $libro
                            echo "";
                        } elseif ($libro['espacio'] == 'desocupado') { // Cambiado $Libro a $libro
                            echo "<button>Descargar</button>";
                        } else {
                            echo "<button>No disponible</button>";
                        }
                    ?>
                </td>
                </tr>
            </table>
            <a href="../buscador/buscar_libro_rec.php" class="btn btn-primary">Volver a la búsqueda</a>
        </div>
        <?php
    } else {
        echo "<p>Libro no encontrado.</p>";
    }
} else {
    echo "<p>ID de libro no especificado.</p>";
}
?>
<div class="table-responsive">
    <table class="table table-hover" id="table_Libros">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Codigo</th>
                <th scope="col">Tipo</th>
                <th scope="col">fecha_publicacion</th>
                <th scope="col">Espacio</th>
                <th scope="col">Portada</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Consulta para obtener los libros
            $query = "SELECT * FROM libros";
            $result = mysqli_query($con, $query);

            // Verificar si hay resultados
            if (mysqli_num_rows($result) > 0) {
                while ($Libro = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $Libro['nombre']; ?></td>
                        <td><?php echo $Libro['autor']; ?></td>
                        <td><?php echo $Libro['edicion']; ?></td>
                        <td><?php echo $Libro['genero']; ?></td>
                        <td><?php echo $Libro['fecha_publicacion']; ?></td>
                        <td><?php echo $Libro['espacio']; ?></td>
                        <td>
                            <?php
                            $Portada = $Libro['Portada'];
                            if ($Portada == '') {
                                $Portada = '../assets/imgs/sin-foto.jpg';
                            } else {
                                $Portada = "../acciones/fotos_portadas/" . $Portada;
                            }
                            ?>
                            <img src="<?php echo $Portada; ?>" alt="<?php echo $Libro['nombre']; ?>" style="width: 100px; height: auto;">
                        </td>
                        <td>
                            <a title="Ver detalles del libro" href="#" onclick="verDetallesLibro(<?php echo $Libro['id_libros']; ?>)" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#detallesLibroModal">
                                <i class="bi bi-binoculars"></i>
                            </a>
                            <?php
                            if ($Libro['espacio'] == 'disponible') {
                               echo '<a href="../fpdf/libro_descarga.php?id_libros=' . $Libro['id_libros'] . '" target="_blank" class="btn btn-success" style="display: block; text-align: center; margin-top: 10px;"><h3>DESCARGAR</h3></a>';
                            } elseif ($Libro['espacio'] == 'reservado') {
                                echo "";
                            } elseif ($Libro['espacio'] == 'ocupado') {
                                echo "";
                            } elseif ($Libro['espacio'] == 'desocupado') {
                                echo "<button>Descargar</button>";
                            } else {
                                echo "<button>No disponible</button>";
                            }
                            ?>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                echo "<tr><td colspan='8'>No se encontraron libros.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Modal para ver detalles del libro -->
<div class="modal fade" id="detallesLibroModal" tabindex="-1" aria-labelledby="detallesLibroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detallesLibroModalLabel">Detalles del Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Contenido de los detalles del libro -->
                <div id="detallesLibroContenido">
                    <!-- Aquí se cargarán los detalles del libro mediante JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<script>
function verDetallesLibro(id_libro) {
    fetch(`../acciones/obtener_detalles_libro.php?id=${id_libro}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('detallesLibroContenido').innerHTML = `
                    <p><strong>Nombre:</strong> ${data.libro.nombre}</p>
                    <p><strong>Descripcion:</strong> ${data.libro.autor}</p>
                    <p><strong>Codigo:</strong> ${data.libro.edicion}</p>
                    <p><strong>Tipo:</strong> ${data.libro.genero}</p>
                    <p><strong>Fecha de Publicación:</strong> ${data.libro.fecha_publicacion}</p>
                    <p><strong>Espacio:</strong> ${data.libro.espacio}</p>
                    <img src="../acciones/fotos_portadas/${data.libro.Portada}" alt="${data.libro.nombre}" style="width: 100px; height: auto;">
                `;
            } else {
                document.getElementById('detallesLibroContenido').innerHTML = '<p>Error al obtener los detalles del libro.</p>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            document.getElementById('detallesLibroContenido').innerHTML = '<p>Error al obtener los detalles del libro.</p>';
        });
}
</script>