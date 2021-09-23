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
          <h1 class="display-4">Agregar Producto</h1>
          <p>¡Crea un nuevo producto y luego agregalo en el inventario!</p>
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
                <?php require '../controllers/add_product_controller.php'; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    
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
                                    include_once '../models/pet_model.php';
                                    $type_array = getProductTypes();
                                    // echo json_encode($type_array);
                                    foreach ($type_array as $s) {
                                        echo "{$type} - {$s['id']}";
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