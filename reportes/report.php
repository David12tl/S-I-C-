<!DOCTYPE html>
<html lang="es">
<head>
    <title>Reportes</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="Shortcut Icon" type="image/x-icon" href="../assets/icons/book.ico" />
    <script src="../js/sweet-alert.min.js"></script>
    <link rel="stylesheet" href="../css/sweet-alert.css">
    <link rel="stylesheet" href="../css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="../css/normalize.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="../css/timeline.css">
    <link rel="stylesheet" href="../css/home.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.11.2.min.js"><\/script>')</script>
    <script src="../js/modernizr.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="../js/main.js"></script>
</head>
<body>
<?php
include("../config/config.php");
include("../acciones/reporte_disponible.php");

// Obtener todos los libros
$Libros = obtenerLibros($conexion);

// Inicializar arrays para cada estado
$librosDisponibles = [];
$librosOcupados = [];
$librosReservados = [];

// Separar los libros por estado
foreach ($Libros as $Libro) {
    if ($Libro['espacio'] == 'disponible') {
        $librosDisponibles[] = $Libro;
    } elseif ($Libro['espacio'] == 'ocupado') {
        $librosOcupados[] = $Libro;
    } elseif ($Libro['espacio'] == 'reservado') {
        $librosReservados[] = $Libro;
    }
}
?>
    <div class="navbar-lateral full-reset">
        <div class="visible-xs font-movile-menu mobile-menu-button"></div>
        <div class="full-reset container-menu-movile nav-lateral-scroll">
            <div class="logo full-reset all-tittles">
                <i class="visible-xs zmdi zmdi-close pull-left mobile-menu-button" style="line-height: 55px; cursor: pointer; padding: 0 10px; margin-left: 7px;"></i> 
            </div>
            <div class="nav-lateral-divider full-reset"></div>
            <div class="full-reset" style="padding: 10px 0; color:#fff;">
                <figure>
                    <img src="../assets/img/logo_ingetec.jpg" alt="Biblioteca" class="img-responsive center-box" style="width:100%; margin-top: -3.6%">
                </figure>
                <h1 class="text-center" style="padding-top: 15px;">S I C</h1>
            </div>
            <div class="nav-lateral-divider full-reset"></div>
            <div class="full-reset nav-lateral-list-menu">
                <ul class="list-unstyled">
                    <li><a href="../home_adm.php"><i class="zmdi zmdi-home zmdi-hc-fw"></i>&nbsp;&nbsp; Inicio</a></li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i>&nbsp;&nbsp; Listas <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="../listas/admin.php"><i class="zmdi zmdi-face zmdi-hc-fw"></i>&nbsp;&nbsp; Listas de administradores</a></li>
                            <li><a href="../listas/adm_users.php"><i class="zmdi zmdi-male-alt zmdi-hc-fw"></i>&nbsp;&nbsp;Listas de Usuario</a></li>
                            <li><a href="../listas/adm_rec.php"><i class="zmdi zmdi-accounts zmdi-hc-fw"></i>&nbsp;&nbsp; Listas administrador de recursos</a></li>
                            <li><a href="../autor/autor_añadir.php"><i class="zmdi zmdi-assignment-account zmdi-hc-fw"></i>&nbsp;&nbsp; Añadir</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-assignment-o zmdi-hc-fw"></i>&nbsp;&nbsp; Libros y catálogo <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="../catalogo/nuevo_libro.php"><i class="zmdi zmdi-book zmdi-hc-fw"></i>&nbsp;&nbsp; Nuevo libro</a></li>
                            <li><a href="../catalogo/catalogo_vista.php"><i class="zmdi zmdi-bookmark-outline zmdi-hc-fw"></i>&nbsp;&nbsp; Catálogo</a></li>
                        </ul>
                    </li>
                    <li>
                        <div class="dropdown-menu-button"><i class="zmdi zmdi-alarm zmdi-hc-fw"></i>&nbsp;&nbsp; Préstamos y reservaciones <i class="zmdi zmdi-chevron-down pull-right zmdi-hc-fw icon-sub-menu"></i></div>
                        <ul class="list-unstyled">
                            <li><a href="../libros/administrador/libros_disponibles.php"><i class="zmdi zmdi-calendar zmdi-hc-fw"></i>&nbsp;&nbsp;Libros desponibles</a></li>
                            <li>
                                <a href="../libros/administrador/libros_ocupados.php"><i class="zmdi zmdi-time-restore zmdi-hc-fw"></i>&nbsp;&nbsp;Libros Ocupados<span class="label label-danger pull-right label-mhover"></span></a>
                            </li>
                            <li>
                                <a href="../libros/administrador/libros_reservados.php"><i class="zmdi zmdi-timer zmdi-hc-fw"></i>&nbsp;&nbsp; Libros Reservaciones <span class="label label-danger pull-right label-mhover"></span></a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="../reportes/report.php"><i class="zmdi zmdi-trending-up zmdi-hc-fw"></i>&nbsp;&nbsp; Reportes y estadísticas</a></li>
                    <li><a href="#"><i class="zmdi zmdi-wrench zmdi-hc-fw"></i>&nbsp;&nbsp; Configuraciones avanzadas</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-page-container full-reset custom-scroll-containers">
        <nav class="navbar-user-top full-reset">
            <ul class="list-unstyled full-reset">
                <figure>
                   <img src="../assets/img/tecNM.jpg" alt="user-picture" class="img-responsive">
                </figure>
                <li style="color:#fff; cursor:default;">
                    <span class="all-tittles">Admin Name</span>
                </li>
                <li  class="tooltips-general exit-system-button" data-href="../Index.php" data-placement="bottom" title="Salir del sistema">
                    <i class="zmdi zmdi-power"></i>
                </li>
                <li  data-placement="bottom" title="Buscar libro">
                    <a href="../buscador/searchbook.php"> <h2><i class="zmdi zmdi-search"></i></h2></a>
                </li>
                <li  class="tooltips-general btn-help" data-placement="bottom" title="Ayuda">
                    <i class="zmdi zmdi-help-outline zmdi-hc-fw"></i>
                </li>
                <li class="mobile-menu-button visible-xs" style="float: left !important;">
                    <i class="zmdi zmdi-menu"></i>
                </li>
                <li class="desktop-menu-button hidden-xs" style="float: left !important;">
                    <i class="zmdi zmdi-swap"></i>
                </li>
            </ul>
        </nav>
        <div class="container">
            <div class="page-header">
              <h1 class="all-tittles">Sistema de control de inventario</h1>
            </div>
        </div>
        <div class="container-fluid">
            <ul class="nav nav-tabs nav-justified" role="tablist">
                <li role="presentation" class="active"><a href="#statistics" aria-controls="statistics" role="tab" data-toggle="tab">Estadísticas</a></li>
                <li role="presentation"><a href="#reports" aria-controls="reports" role="tab" data-toggle="tab">Reportes y fichas</a></li>
            </ul>
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane fade in active" id="statistics">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="../assets/img/chart.png" alt="chart" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de estadísticas, aquí puedes ver las diferentes estadísticas de los préstamos y libros.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="page-header">
                          <h2 class="all-tittles">Libros <small>Disponibles</small></h2>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">total préstamos disponibles</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Autor</th>
                                                <th>Edición</th>
                                                <th>Género</th>
                                                <th>Fecha Publicación</th>
                                                <th>Portada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($librosDisponibles as $Libro) { ?>
                                                <tr>
                                                    <td><?php echo $Libro['id_libros']; ?></td>
                                                    <td><?php echo $Libro['nombre']; ?></td>
                                                    <td><?php echo $Libro['autor']; ?></td>
                                                    <td><?php echo $Libro['edicion']; ?></td>
                                                    <td><?php echo $Libro['genero']; ?></td>
                                                    <td><?php echo $Libro['fecha_publicacion']; ?></td>
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
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Préstamos entregados (por usuarios)”</p>
                            </div>
                        </div>
                        <div class="page-header">
                          <h2 class="all-tittles">Libros <small> ocupados</small></h2>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">Libros ocupados</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Autor</th>
                                                <th>Edición</th>
                                                <th>Género</th>
                                                <th>Fecha Publicación</th>
                                                <th>Portada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($librosOcupados as $Libro) { ?>
                                                <tr>
                                                    <td><?php echo $Libro['id_libros']; ?></td>
                                                    <td><?php echo $Libro['nombre']; ?></td>
                                                    <td><?php echo $Libro['autor']; ?></td>
                                                    <td><?php echo $Libro['edicion']; ?></td>
                                                    <td><?php echo $Libro['genero']; ?></td>
                                                    <td><?php echo $Libro['fecha_publicacion']; ?></td>
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
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Préstamos entregados (por sección)”</p>
                            </div>
                        </div>
                        <div class="page-header">
                          <h2 class="all-tittles">libros <small>por reservar</small></h2>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h3 class="text-center all-tittles">libros por reservar</h3>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nombre</th>
                                                <th>Autor</th>
                                                <th>Edición</th>
                                                <th>Género</th>
                                                <th>Fecha Publicación</th>
                                                <th>Portada</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($librosReservados as $Libro) { ?>
                                                <tr>
                                                    <td><?php echo $Libro['id_libros']; ?></td>
                                                    <td><?php echo $Libro['nombre']; ?></td>
                                                    <td><?php echo $Libro['autor']; ?></td>
                                                    <td><?php echo $Libro['edicion']; ?></td>
                                                    <td><?php echo $Libro['genero']; ?></td>
                                                    <td><?php echo $Libro['fecha_publicacion']; ?></td>
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
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <p class="lead text-center"><strong><i class="zmdi zmdi-info-outline"></i>&nbsp; ¡Importante!</strong> Para imprimir esta tabla ve a la sección de reportes y selecciona “Reporte Libros por Categoría”</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="reports">
                    <div class="container-fluid"  style="margin: 50px 0;">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-3">
                                <img src="../assets/img/pdf.png" alt="pdf" class="img-responsive center-box" style="max-width: 120px;">
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 text-justify lead">
                                Bienvenido al área de reportes, aquí puedes generar fichas de préstamos vacías de estudiantes, docentes o visitantes en formato pdf, también puedes generar reportes de inventario entre otros.
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">fichas</h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                <a href="../fpdf/PruebaV.php" target="_blank" class="btn btn-success" style="display: block; text-align: center;"><h3>Fichas de Usuarios</h3></a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                <a href="../fpdf/admin_reporte.php" target="_blank" class="btn btn-success" style="display: block; text-align: center;"><h3>Fichas de Administradores</h3></a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                <a href="../fpdf/admin_repor_recur.php" target="_blank" class="btn btn-success" style="display: block; text-align: center;"><h3>Fichas de Adm Recursos</h3></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="page-header">
                              <h2 class="all-tittles">reportes <small>generales</small></h2>
                            </div><br>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                <a href="../fpdf/admin_repor_recur.php" target="_blank" class="btn btn-success" style="display: block; text-align: center; background-color: blue;"><h3>Reportes de Libros desocupados</h3></a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                <a href="../fpdf/admin_repor_recur.php" target="_blank" class="btn btn-success" style="display: block; text-align: center; background-color: blue;"><h3>Reportes de libros ocupados</h3></a>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-4">
                                <div class="full-reset report-content">
                                <a href="../fpdf/admin_repor_recur.php" target="_blank" class="btn btn-success" style="display: block; text-align: center; background-color: blue;"><h3>Reportes de libros reservados</h3></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="ModalHelp">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center all-tittles">ayuda del sistema</h4>
                </div>
                <div class="modal-body">
                Si tienes una duda específica, nuestro equipo de soporte está listo para ayudarte. Puedes contactarnos a través de Lexis@gmail.com.mx para obtener asistencia personalizada.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="zmdi zmdi-thumb-up"></i> &nbsp; De acuerdo</button>
                </div>
            </div>
          </div>
        </div>
        <footer class="footer full-reset">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="all-tittles">Acerca de</h4>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam quam dicta et, ipsum quo. Est saepe deserunt, adipisci eos id cum, ducimus rem, dolores enim laudantium eum repudiandae temporibus sapiente.
                        </p>
                    </div>
                    <div class="col-xs-12 col-sm-6">
                        <h4 class="all-tittles">Desarrollador</h4>
                        <ul class="list-unstyled">
                            <li><i class="zmdi zmdi-check zmdi-hc-fw"></i>&nbsp; Carlos Alfaro <i class="zmdi zmdi-facebook zmdi-hc-fw footer-social"></i><i class="zmdi zmdi-twitter zmdi-hc-fw footer-social"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer-copyright full-reset all-tittles">© 2018 Carlos Alfaro</div>
        </footer>
    </div>
</body>
</html>