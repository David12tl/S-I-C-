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
                            <a href="../home_rec.php" class="btn btn-primary" title="Regresar al Inicio" style="text-decoration: none;">
                            <i class="bi bi-house"> REGRESAR</i>
                        </a>
                    </span>
                    Lista de libros (<?php echo $totalLibros ?>)
                    <span class="float-end">
                    
                    </span>
                    <hr>
                </h1>
                <?php
                include("../catalogo/components/rec_catalogo_funcion.php"); ?>
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
    
</body>

</html>