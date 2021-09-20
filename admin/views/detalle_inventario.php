<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'header.php'; ?>
</head>
<body>
    <?php include 'navbar.php'; ?>

    <main role="main">
      <div class="jumbotron" style="padding: 4rem 2rem 1rem 2rem;">
        <div class="container">
            <h1 class="display-4">Existencias del producto</h1>
            <p>¡Modifica las existencias de un producto!</p>
            <p>
                <a class="btn btn-secondary" href="inventario.php" role="button">
                   < Volver al inventario
                </a>
            </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- FORMULARIO DETALLE INVENTARIO -->
                    <div class="col-md-12">

                      <?php require '../controllers/edit_stock_controller.php'; ?>

                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?stock_id=' . $stock_id;?>" method="post">
                          
                        <input type="hidden" name="inputStockId" value="<?php echo $stock_id;?>">

                        <div class="form-group">
                            <label for="inputProductName">Nombre del producto</label>
                            <input type="text" class="form-control" name="inputProductName" placeholder="Nombre del producto" value="<?php echo $product_name;?>" disabled>
                        </div>

                        <fieldset id="detail-form" disabled>
                            <div class="form-group">
                                <label for="inputQuantity">Cantidad</label>
                                <input type="number" class="form-control" name="inputQuantity" placeholder="Cantidad" value="<?php echo $quantity;?>" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="inputStatus">Estado</label>
                                    <input type="text" class="form-control" name="inputStatus" placeholder="Estado" value="<?php echo $status;?>">
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

    <script src="../src/js/stock-detail.js"></script>

    <?php include 'footer.php'?>
    
</body>
</html>