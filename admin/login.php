
<!doctype html>
<html lang="es">
  <head>
    <?php include 'views/header.php'; ?>
    <link href="src/css/login_styles.css" rel="stylesheet">
  </head>
  <body class="text-center">
    <form class="form-signin" action="controllers/login_controller.php">
        <img class="mb-4" src="src/img/footprint.png" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">WebMascotas</h1>
        <label for="inputEmail" class="sr-only">Usuario</label>
        <input type="text" id="inputEmail" name="uname" class="form-control" placeholder="Usuario" required autofocus>
        <label for="inputPassword" class="sr-only">Contraseña</label>
        <input type="password" id="inputPassword" name="upassword" class="form-control" placeholder="Contraseña" required>
        <!-- <div class="checkbox mb-3">
        <label>
            <input type="checkbox" value="remember-me"> Remember me
        </label>
        </div> -->
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="sub">Iniciar Sesión</button>
        <a href="/web-mascotas/web/index.php" class="btn btn-link" type="submit" name="sub">< Volver al sitio</a>

        <br>
        <?php 
            if(isset($_REQUEST["err"]))
                $msg="Usuario o contraseña incorrecta";
        ?>
        <p style="color:red;">
        <?php if(isset($msg))
            {
            echo $msg;
            }
        ?>
        </p>
      <p class="mt-5 mb-3 text-muted">&copy; WebMascotas 2021</p>
    </form>
  </body>
</html>
