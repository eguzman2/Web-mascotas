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
            <h1 class="display-4">Detalles del tipo de producto</h1>
            <p>¡Edita el nombre para un tipo de producto!</p>
            <p>
                <a class="btn btn-secondary" href="tipos_de_producto.php" role="button">
                   < Volver
                </a>
            </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- FORMULARIO DETALLES TIPO DE PRODUCTO -->
                    <div class="col-md-12">

                      <?php require '../controllers/edit_product_type_controller.php'; ?>

                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                          
                        <input type="hidden" name="inputTypeId" value="<?php echo $type_id;?>">
                        <fieldset id="detail-form" disabled>
                          <div class="form-group">
                              <label for="inputName">Nombre*</label>
                              <input type="text" class="form-control" name="inputName" placeholder="Nombre" value="<?php echo $name;?>" required>
                          </div>
                        </fieldset>
                        
                        <button id="btn-enable-edition" type="button" class="btn btn-primary">
                            Editar información
                        </button>

                        <input id="btn-submit-edition" type="submit" class="btn btn-success d-none" value="Guardar Cambios">

                        <button id="btn-cancel-edition" type="button" class="btn btn-secondary d-none">
                            Cancelar
                        </button>
                      </form>
                    </div>
                </div>

            </div>
        </div>

        <hr>

      </div>

    </main>

    <script src="../src/js/product-type-detail.js"></script>

    <?php include 'footer.php'?>
    
</body>
</html>