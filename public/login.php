<?php
session_start();
require "../vendor/autoload.php";

use Clases\Usuarios;

//Creamos una funcion para mostrar un error
function mostrarError($texto)
{
    $_SESSION['error'] = $texto;
    header("Location:{$_SERVER['PHP_SELF']}");
    die();
}

//Comprobamos si hemos dado al boton de login
if (isset($_POST['login'])) {
    //Si existe procesamos nuestro formulario
    $nombre = trim($_POST['nombre']);
    $pass = trim($_POST['pass']);
    //Comprobamos si los campos estan vacios
    if (strlen($nombre) == 0 || strlen($pass) == 0) {
        mostrarError("Rellene los campos");
    }
    $contrasenaValida = hash('sha256', $pass);
    $usuario = new Usuarios();
    //Comprobamos si los datos introducidos son validos
    if ($usuario->usuarioCorrecto($nombre, $contrasenaValida)) {
        $usuario = null;
        die("Usuario validado con exito");
    } else {
        $usuario = null;
        mostrarError("El nombre o la contraseña son incorrectos");
    }
} else {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
        <title>Login</title>
    </head>

    <body style="background-color: bisque;">
        <div class="container mt-3 mb-4">
            <?php
            if (isset($_SESSION['error'])) {
                echo "<p class='my-3 p-3 bg-dark text-danger font-weight-bold'>{$_SESSION['error']}</p>";
                unset($_SESSION['error']);
            }
            ?>
            <h3 class="text-center mt-3">Posts Almería S.A.</h3>
            <div class="container mt-3 mb-4">
                <div class="card text-white bg-secondary mb-3 m-auto mt-5" style="max-width: 48rem;">
                    <div class="card-header text-center">Login</div>
                    <div class="card-body">
                        <form name="login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <label for="nu">Nombre de Usuario</label>
                                <input type="text" class="form-control" id="nu" placeholder="Ingrese su nombre" name="nombre" required>

                            </div>
                            <div class="form-group mt-3">
                                <label for="np">Password</label>
                                <input type="password" class="form-control" id="np" placeholder="Password" name="pass" required>
                            </div>
                            <div class="mt-3">
                                <button type='submit' class='btn btn-primary' name='login'><i class='fas fa-sign-in-alt mr-2'></i> Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

    </body>

    </html>
<?php } ?>