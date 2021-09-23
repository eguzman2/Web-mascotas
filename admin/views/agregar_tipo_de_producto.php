<!DOCTYPE html>
<html lang="es">
<head>
    <?php require 'check_session.php';?>
    <?php include 'header.php'; ?>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main role="main">
      <div class="jumbotron" style="padding: 4rem 2rem 1rem 2rem;">
        <div class="container">
          <h1 class="display-4">Agregar Tipo de producto</h1>
          <p>¡Crea un nuevo tipo de producto!</p>
          <p>
                <a class="btn btn-secondary" href="tipos_de_producto.php" role="button">
                   < Volver a Tipo de productos
                </a>
            </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-12">
                <?php require '../controllers/add_product_type_controller.php'; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    
                    <div class="form-group">
                        <label for="inputName">Nombre*</label>
                        <input type="text" class="form-control" name="inputName" placeholder="Nombre" value="<?php echo $name;?>" required>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Agregar nuevo">
                </form>

            </div>
        </div>

        <hr>

      </div>

    </main>

    <?php include 'footer.php'?>
    
</body>
</html>