<?php
// Conectar a la base de datos
$conexion = mysqli_connect("localhost", "root", "", "lexis");

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accion = $_POST["accion"];
    if ($accion == "registro") { 
        if (!empty($_POST['NOMBRE']) && !empty($_POST['CORREO']) && !empty($_POST['CONTRASEÑA']) && !empty($_POST['CLAVE_REC'])) {
            $NOMBRE = mysqli_real_escape_string($conexion, $_POST['NOMBRE']); 
            $CORREO = mysqli_real_escape_string($conexion, $_POST['CORREO']);
            $CONTRASEÑA = mysqli_real_escape_string($conexion, $_POST['CONTRASEÑA']);
            $CLAVE_REC = mysqli_real_escape_string($conexion, $_POST['CLAVE_REC']);

            $sql = "INSERT INTO adm_recursos (NOMBRE, CORREO, CONTRASEÑA, CLAVE_REC) VALUES ('$NOMBRE','$CORREO','$CONTRASEÑA','$CLAVE_REC')";

            if (mysqli_query($conexion, $sql)) {
                $mensaje = "Administrador registrado correctamente.";
            } else {
                $mensaje = "Error al registrar administrador: " . mysqli_error($conexion);
            }
        } else {
            $mensaje = "Todos los campos son obligatorios para el registro.";
        }
    } elseif ($accion == "login") {
        // INICIO DE SESIÓN
        if (!empty($_POST['CORREO']) && !empty($_POST['CONTRASEÑA'])) {
            $CORREO = mysqli_real_escape_string($conexion, $_POST['CORREO']);
            $CONTRASEÑA = mysqli_real_escape_string($conexion, $_POST['CONTRASEÑA']);

            $consulta = "SELECT * FROM adm_recursos WHERE CORREO='$CORREO' AND CONTRASEÑA='$CONTRASEÑA'";
            $resultado = mysqli_query($conexion, $consulta);
            $filas = mysqli_fetch_array($resultado);
if ($filas) {
                // Redirigir a home_adm.php
                header("Location: home_rec.php");
                exit(); // Asegúrate de detener la ejecución después de redirigir
            } else {
                $mensaje = "Correo o contraseña incorrectos.";
            }
        } else {
            $mensaje = "Todos los campos son obligatorios para iniciar sesión.";
        }
            
    }
}

mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="Shortcut Icon" type="image/x-icon" href="assets/icons/book.ico" />
    <link rel="stylesheet" href="css/Style_login.css">
    
    <title>LEXIS</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="POST">
                <h1 style="color: black;">Crear una cuenta</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>o use su correo electrónico para registrarse</span>
                <input type="hidden" name="accion" value="registro">
                <input type="text" placeholder="Name" name="NOMBRE">
                <input type="email" placeholder="Email" name="CORREO">
                <input type="password" placeholder="Password" name="CONTRASEÑA">
                <input type="text" placeholder="Clave de Recursos" name="CLAVE_REC">
                <?php if (!empty($mensaje) && $_POST['accion'] == 'login'): ?>
                    <div style="color: red; text-align: center; margin-bottom: 20px;">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>
                <input type="submit" value="Ingresar">
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="POST" value="login">
                <h1 class="inisia" style="color: black;">Inicia sesión</h1>
                <div class="social-icons">
                    <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                    <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                </div>
                <span>o use su contraseña de correo electrónico</span>
                <input type="hidden" name="accion" value="login">
                <input type="email" placeholder="Email" name="CORREO">
                <input type="password" placeholder="Password" name="CONTRASEÑA">
                <a href="#">¿Olvidaste tu contraseña?</a>
                <input type="submit" value="Ingresar">
                <?php if (!empty($mensaje) && $_POST['accion'] == 'login'): ?>
                    <div style="color: red; text-align: center; margin-bottom: 20px;">
                        <?php echo htmlspecialchars($mensaje); ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>¡Bienvenido!</h1>
                    <p>Introduce tus datos personales para utilizar todas las funciones del sitio</p>
                    <a href="Index.php" class="btn btn-success" style="decoreiton: none; color: white;">Regresar</a>
                    <img src="assets/img/ITSZ.png" alt="" style="width: 20%; border-radius: opx;">
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>¡Hola Amigo!</h1>
                    <p>Regístrese con sus datos personales para utilizar todas las funciones del sitio</p>
                    <button class="hidden" id="register">Inicia sesión</button>
                    <img src="assets/img/logo_ingetec.jpg" alt="" style="width: 70%; border-radius: opx;">
                </div>
            </div>
        </div>
    </div>

    <script src="scrip.js"></script>
</body>

</html>