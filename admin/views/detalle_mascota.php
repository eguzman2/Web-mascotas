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
            <h1 class="display-4">Detalles de la Mascota</h1>
            <p>¡Consulta y edita las imágenes y demás datos de la mascota!</p>
            <p>
                <a class="btn btn-secondary" href="../index.php" role="button">
                   < Volver
                </a>
            </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <!-- FORMULARIO DETALLES MASCOTA -->
                    <div class="col-md-6">

                      <?php require '../controllers/edit_pet_controller.php'; ?>

                      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?pet_id=' . $pet_id;;?>" method="post">
                          
                        <input type="hidden" name="inputPetId" value="<?php echo $pet_id;?>">
                        <fieldset id="detail-form" disabled>
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
                                        //   echo "{$status} - {$s['id']}";
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
                    <!-- IMAGENES -->
                    <div class="col-md-6">

                        <div class="row">
                            <div class="col-12">
                                <div id="div-upload-image" class="card bg-light mb-3 d-none">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>Nueva imágen</h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="btn-upload-image-cancel" type="button" class="btn btn-dark float-right">
                                                    Cancelar
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-inline" action="../controllers/upload_pet_image.php" method="post" enctype="multipart/form-data">
                                            <input type="hidden" name="pet_id" value="<?php echo $pet_id;?>">
                                            <div class="form-group mb-2">
                                                <input type="file" class="form-control-file" name="fileToUpload" id="fileToUpload" required>
                                            </div>
                                            <input type="submit" class="btn btn-primary mb-2" value="Subir imágen" name="submit">
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card bg-light mb-3">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4>Imágenes</h4>
                                            </div>
                                            <div class="col-sm-6">
                                                <button id="btn-upload-image" type="button" class="btn btn-secondary float-right">
                                                    <!-- data-toggle="tooltip" data-placement="top" title="Agregar nueva imágen" -->
                                                    <i class="fa fa-plus"></i> Agregar imágen
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <?php
                                                include_once '../models/photo_model.php';
                                                $images_array = getPhotosByPetId($pet_id);
                                                
                                                foreach ($images_array as $key => $value) {
                                                    # code...
                                            ?>
                                                    <div class="col-xs-12 col-sm-6 col-md-4 mb-2">
                                                        <img src="<?php echo $value['file']?>" alt="<?php echo $value['name']?>" class="img-thumbnail">
                                                    </div>  
                                            <?php
                                                }
                                            ?>
                                            <!-- TEST IMAGE -->
                                            <!-- <div class="col-xs-12 col-sm-6 col-md-4">
                                                <img src="https://dummyimage.com/600x600/000/fff.jpg" alt="..." class="img-thumbnail">
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <hr>

      </div>

    </main>

    <script src="../src/js/pet-detail.js"></script>

    <?php include 'footer.php'?>
    
</body>
</html>