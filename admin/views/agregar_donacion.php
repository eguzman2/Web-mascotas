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
          <h1 class="display-4">Agregar Donación</h1>
          <p>¡Registra una donación, e incluyela en el inventario!</p>
          <p>
                <a class="btn btn-secondary" href="donaciones.php" role="button">
                   < Volver a donaciones
                </a>
            </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-12">
                <?php require '../controllers/add_donation_controller.php'; ?>

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
                        <label for="inputDonorName">Nombre del donante</label>
                        <input type="text" class="form-control" name="inputDonorName" placeholder="Donante" value="<?php echo $donor_name;?>">
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input type="checkbox" class="custom-control-input" id="addToStock" name="inputAddToStock">
                            <label class="custom-control-label" for="addToStock">Agregar productos al inventario</label>
                        </div>
                    </div>

                    <input type="submit" class="btn btn-primary" value="Agregar nueva donación">
                </form>

            </div>
        </div>

        <hr>

      </div>

    </main>

    <?php include 'footer.php'?>
    
</body>
</html>