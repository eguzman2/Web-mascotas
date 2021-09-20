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
          <h1 class="display-4">Agregar Mascota</h1>
          <p>¡Crea una nueva mascota, define sus detalles y luego agregale imágenes!</p>
          <p>
                <a class="btn btn-secondary" href="../index.php" role="button">
                   < Volver a Mascotas
                </a>
            </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-12">
                <?php require '../controllers/add_pet_controller.php'; ?>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                    
                    <div class="form-group">
                        <label for="inputName">Nombre*</label>
                        <input type="text" class="form-control" name="inputName" placeholder="Nombre" value="<?php echo $name;?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputRace">Raza</label>
                            <input type="text" class="form-control" name="inputRace" placeholder="Raza" value="<?php echo $race;?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputSize">Tamaño</label>
                            <input type="text" class="form-control" name="inputSize" placeholder="Tamaño" value="<?php echo $size;?>">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="inputState">Estado</label>
                        <select name="inputState" class="form-control" required>
                            <option value="" <?php if (isset($status) && $status=="") echo "selected";?> >Selecciona...</option>
                            <?php
                                include_once '../models/pet_model.php';
                                $status_array = getPetStatuses();
                                // echo json_encode($status_array);
                                foreach ($status_array as $s) {
                                    echo "{$status} - {$s['id']}";
                                    if (isset($status) && $status==$s['id']) {
                                        echo "<option value='{$s['id']}' selected>{$s['name']}</option>";
                                    } else {
                                        echo "<option value='{$s['id']}'>{$s['name']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="inputDescription">Descripción</label>
                        <textarea class="form-control" name="inputDescription" rows="3"><?php echo $description;?></textarea>
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