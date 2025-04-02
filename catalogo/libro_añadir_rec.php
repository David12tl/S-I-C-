<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="../assets/icons/book.ico" />
    <title>LEXIS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />
    <link rel="stylesheet" href="../css/Catalogo.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.2/css/dataTables.bootstrap5.css">

    <!-- Libreria para alertas ----->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

</head>

<body>
    <?php
    include("../config/config.php");
    include("../acciones/acciones_libro.php");

    $Libros = obtenerLibros($conexion);
    $totalLibros = $Libros->num_rows;
    ?>

    <h1 class="text-center mt-5 mb-5 fw-bold"><img src="assets/img/logo_ingetec.jpg" alt=""  style="width: 50px; height: auto;" > Catalogos de libros</h1>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-12">
                <h1 class="text-center">
                    </a>
                    <span class="float-start">
                        <a href="#" onclick="modalRegistrarLibro()" class="btn btn-success" title="Registrar Nuevo Libro">
                            <i class="bi bi-plus"></i>
                        <a href="../home_rec.php" class="btn btn-primary" title="Regresar al Inicio" style="text-decoration: none; margin-left: 10px;">
                            <i class="bi bi-house"> REGRESAR </i>
                        </a>
                    </span>
                    Lista de libros (<?php echo $totalLibros ?>)
                    <span class="float-end">
                        <a href="acciones/exportar.php" class="btn btn-success" title="Exportar a CSV" download="empleados.pdf"><i class="bi bi-filetype-pdf"></i></a>
                    </span>
                    <hr>
                </h1>
                <?php
                include("../catalogo/components/libro_funcion_rec.php"); ?>
            </div>
        </div>
    </div>

    <!-- Modal para registrar libro -->
    <div class="modal fade" id="ModalRegistrarLibro" tabindex="-1" role="dialog" aria-labelledby="ModalRegistrarLibroLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ModalRegistrarLibroLabel">Registrar Nuevo Libro</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Formulario de registro de libro -->
                    <form id="formularioLibro" action="../acciones/acciones_libro.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="nombre" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Autor</label>
                        <input type="text" name="autor" class="form-control" required />
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Espacio</label>
                            <select class="form-select" name="espacio" required>
                                <option value=""> Seleccione </option>
                                <option value="ocupado">ocupado</option>
                                <option value="disponible">disponible</option>
                                <option value="reservado">reservado</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Fecha de publicacion</label>
                            <input type="date" name="fecha_publicacion" class="form-control" required />
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Edicion</label>
                        <input type="text" name="edicion" class="form-control" required />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Genero</label>
                        <input type="text" name="genero" class="form-control" required />
                    </div>
                    <div class="mb-3 mt-4">
                        <label class="form-label">Cambiar Foto del libro</label>
                        <input class="form-control form-control-sm" type="file" name="Portada" accept="image/png, image/jpeg" />
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn_add">
                            Registrar nuevo libro
                        </button>
                    </div>
                     </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="assets/js/detallesEmpleado.js"></script>
    <script src="assets/js/addLibro.js"></script>
    <script src="assets/js/editarEmpleado.js"></script>
    <script src="assets/js/eliminarEmpleado.js"></script>
    <script src="assets/js/refreshTableAdd.js"></script>
    <script src="assets/js/refreshTableEdit.js"></script>
    <script src="assets/js/alertas.js"></script>

    <!-------------------------Librería  datatable para la tabla -------------------------->
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.2/js/dataTables.bootstrap5.js"></script>
    <script>
        $(document).ready(function() {
            $("#table_empleados").DataTable({
                pageLength: 5,
                language: {
                    url: "https://cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json",
                },
            });

            // Manejar el envío del formulario con AJAX
            $('#formularioLibro').on('submit', function(event) {
                event.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // Manejar la respuesta del servidor
                        $('#ModalRegistrarLibro').modal('hide');
                        toastr.success('Libro registrado exitosamente');
                        // Recargar la tabla de libros
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Manejar el error
                        toastr.error('Error al registrar el libro');
                    }
                });
            });
        });

        function modalRegistrarLibro() {
            $('#ModalRegistrarLibro').modal('show');
        }
    </script>

</body>

</html>