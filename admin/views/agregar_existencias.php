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
          <h1 class="display-4">Agregar Productos al inventario</h1>
          <p>¡Agrega existencias para un producto!</p>
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
                <?php require '../controllers/add_stock_controller.php'; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    <div class="form-group">
                        <label for="inputProduct">Producto</label>
                        <select name="inputProduct" class="form-control" required>
                            <option value="" <?php if (isset($product) && $product=="") echo "selected";?> >Selecciona...</option>
                            <?php
                                include_once '../models/product_model.php';
                                $product_array = getProducts();
                                // echo json_encode($product_array);
                                foreach ($product_array as $s) {
                                    echo "{$product} - {$s['id']}";
                                    if (isset($product) && $product==$s['id']) {
                                        echo "<option value='{$s['id']}' selected>{$s['name']}</option>";
                                    } else {
                                        echo "<option value='{$s['id']}'>{$s['name']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputQuantity">Cantidad</label>
                            <input type="number" class="form-control" name="inputQuantity" placeholder="Cantidad" value="<?php echo $quantity;?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputStatus">Estado</label>
                            <input type="text" class="form-control" name="inputStatus" placeholder="Estado" value="<?php echo $status;?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputObservations">Observaciones</label>
                        <input type="text" class="form-control" name="inputObservations" placeholder="Observaciones" value="<?php echo $observations;?>">
                    </div>
                    
                    <input type="submit" class="btn btn-primary" value="Agregar nuevas existencias">
                </form>

            </div>
        </div>

        <hr>

      </div>

    </main>

    <?php include 'footer.php'?>
    
</body>
</html>