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
            foreach ($Libros as $Libro) { ?>
                <tr id="Libros_<?php echo $Libro['id_libros']; ?>">
                    <th scope='row'><?php echo $Libro['id_libros']; ?></th>
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
                        <a title="Editar datos del libro" href="#" onclick="editarLibro(<?php echo $Libro['id_libros']; ?>)" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editarLibroModal">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a title="Eliminar datos del libro" href="#" onclick="confirmarEliminarLibro(<?php echo $Libro['id_libros']; ?>, '<?php echo $Libro['Portada']; ?>')" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#eliminarLibroModal">
                            <i class="bi bi-trash"></i>
                        </a>
                        <?php
                        if ($Libro['espacio'] == 'disponible') {
                            echo '<a href="../fpdf/libro_descarga.php?id_libros=' . $Libro['id_libros'] . '" target="_blank" class="btn btn-success" style="display: block; text-align: center; margin-top: 10px; "><p>DESCARGAR</p></a>';
                        } elseif ($Libro['espacio'] == 'reservado') {
                            echo "<td></td>";
                        } elseif ($Libro['espacio'] == 'ocupado') {
                            echo "<td></td>";
                        } elseif ($Libro['espacio'] == 'descargado') {
                            echo '<a href="../fpdf/libro_descarga.php?id_libros=' . $Libro['id_libros'] . '" target="_blank" class="btn btn-success" style="display: block; text-align: center;"><h3>DESCARGAR</h3></a>';
                        }

                        if ($Libro['espacio'] == 'desocupado') {
                            echo "<td><button>Descargar</button></td>";
                        }
                         ?>
                    </td>
                </tr>
            <?php } ?>
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

<!-- Modal para editar datos del libro -->
<div class="modal fade" id="editarLibroModal" tabindex="-1" aria-labelledby="editarLibroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarLibroModalLabel">Editar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarLibroForm" action="acciones/editar_libro.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id_libros" id="editarLibroId">
                    <input type="hidden" name="PortadaActual" id="editarPortadaActual">
                    <div class="mb-3">
                        <label for="editarNombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="editarNombre" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarAutor" class="form-label">Descripcion</label>
                        <input type="text" name="autor" class="form-control" id="editarAutor" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarEdicion" class="form-label">Codigo</label>
                        <input type="text" name="edicion" class="form-control" id="editarEdicion" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarGenero" class="form-label">Tipo</label>
                        <input type="text" name="genero" class="form-control" id="editarGenero" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarFechaPublicacion" class="form-label">Fecha de Publicación</label>
                        <input type="date" name="fecha_publicacion" class="form-control" id="editarFechaPublicacion" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarEspacio" class="form-label">Espacio</label>
                        <input type="text" name="espacio" class="form-control" id="editarEspacio" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarPortada" class="form-label">Portada</label>
                        <input type="file" class="form-control" id="editarPortada">
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal para eliminar libro -->
<div class="modal fade" id="eliminarLibroModal" tabindex="-1" aria-labelledby="eliminarLibroModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eliminarLibroModalLabel">Eliminar Libro</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>¿Estás seguro de que deseas eliminar este libro?</p>
                <input type="hidden" id="eliminarLibroId">
                <input type="hidden" id="eliminarLibroPortada">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" onclick="eliminarLibro()">Eliminar</button>
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

function editarLibro(id_libro) {
    fetch(`../acciones/obtener_detalles_libro.php?id=${id_libro}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('editarLibroId').value = data.libro.id_libros;
                document.getElementById('editarNombre').value = data.libro.nombre;
                document.getElementById('editarAutor').value = data.libro.autor;
                document.getElementById('editarEdicion').value = data.libro.edicion;
                document.getElementById('editarGenero').value = data.libro.genero;
                document.getElementById('editarFechaPublicacion').value = data.libro.fecha_publicacion;
                document.getElementById('editarEspacio').value = data.libro.espacio;
                document.getElementById('editarPortadaActual').value = data.libro.Portada;
            } else {
                alert('Error al obtener los detalles del libro.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error al obtener los detalles del libro.');
        });
}

document.getElementById('editarLibroForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    if (document.getElementById('editarPortada').files[0]) {
        formData.append('Portada', document.getElementById('editarPortada').files[0]);
    }

    fetch('../acciones/editar_libro.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Libro actualizado correctamente.');
            location.reload();
        } else {
            alert('Error al actualizar el libro.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al actualizar el libro.');
    });
});

function confirmarEliminarLibro(id_libro, portada) {
    document.getElementById('eliminarLibroId').value = id_libro;
    document.getElementById('eliminarLibroPortada').value = portada;
}

function eliminarLibro() {
    const id_libro = document.getElementById('eliminarLibroId').value;
    const portada = document.getElementById('eliminarLibroPortada').value;

    fetch(`../acciones/eliminar_libro.php`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id_libro, portada })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Libro eliminado correctamente.');
            location.reload();
        } else {
            alert('Error al eliminar el libro.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Error al eliminar el libro.');
    });
}
</script>