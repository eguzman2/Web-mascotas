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
            <h1 class="display-4">Detalles del Producto</h1>
            <p>¡Consulta y edita los detalles del producto!</p>
            <p>
                <a class="btn btn-secondary" href="productos.php" role="button">
                   < Volver a Productos
                </a>
            </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- FORMULARIO DETALLES MASCOTA -->
                    <div class="col-md-12">

                      <?php require '../controllers/edit_product_controller.php'; ?>

                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?product_id=' . $product_id;?>" method="post">
                          
                        <input type="hidden" name="inputProductId" value="<?php echo $product_id;?>">

                        <fieldset id="detail-form" disabled>
                          <div class="form-group">
                              <label for="inputName">Nombre*</label>
                              <input type="text" class="form-control" name="inputName" placeholder="Nombre" value="<?php echo $name;?>" required>
                          </div>

                          <div class="form-row">
                              <div class="form-group col-md-6">
                                <label for="inputType">Tipo</label>
                                <select name="inputType" class="form-control" required>
                                    <option value="" <?php if (isset($type) && $type=="") echo "selected";?> >Selecciona...</option>
                                    <?php
                                        include_once '../models/product_model.php';
                                        $type_array = getProductTypes();
                                        
                                        foreach ($type_array as $s) {
                                            if (isset($type) && $type==$s['id']) {
                                                echo "<option value='{$s['id']}' selected>{$s['name']}</option>";
                                            } else {
                                                echo "<option value='{$s['id']}'>{$s['name']}</option>";
                                            }
                                        }
                                    ?>
                                </select>
                              </div>
                              <div class="form-group col-md-6">
                                  <label for="inputBrand">Marca</label>
                                  <input type="text" class="form-control" name="inputBrand" placeholder="Marca" value="<?php echo $brand;?>">
                              </div>
                          </div>
                          
                          <div class="form-group">
                              <label for="inputObservations">Observaciones</label>
                              <input type="text" class="form-control" name="inputObservations" placeholder="Observaciones" value="<?php echo $observations;?>">
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

    <script src="../src/js/product-detail.js"></script>

    <?php include 'footer.php'?>
    
</body>
</html>