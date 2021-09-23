<!DOCTYPE html>
<html lang="es">
<head>
    <?php 
      session_start ();
      if(!isset($_SESSION["login"]))
        header("location:login.php"); 
    ?>
    <?php include 'views/header.php'; ?>
</head>
<body>
    <?php include 'views/navbar.php'; ?>

    <main role="main">

      <div class="jumbotron" style="padding: 4rem 2rem 1rem 2rem;">
        <div class="container">
          <h1 class="display-4">Listado de mascotas</h1>
          <p>Aquí apareceran todas las mascotas agregadas en el sitio</p>
          <p>
            <a class="btn btn-primary btn-lg" href="views/agregar_mascota.php" role="button">
              Agregar una nueva mascota »
            </a>
          </p>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-12">

          <?php
            // check messages
            if (!empty($_GET['success'])){
              if ($_GET['success']){
          ?>
              <div class='alert alert-success' role='alert'>
                <?php echo $_GET['success']; ?>
              </div>
          <?php
              }
            } 

            if(!empty($_GET['error'])){
              if ($_GET['error']){
          ?>
              <div class='alert alert-danger' role='alert'>
                <?php echo $_GET['error']; ?>
              </div>
            <?php
              }
            }
          ?>

            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Raza</th>
                    <th scope="col">Tamaño</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once 'models/pet_model.php';
                        $pet_data = getPets();
                        // echo json_encode($pet_data);
                        foreach ($pet_data as $pet) {
                            echo "<tr>
                                    <td>{$pet['id']}</td>
                                    <td>{$pet['name']}</td>
                                    <td>{$pet['race']}</td>
                                    <td>{$pet['size']}</td>
                                    <td>{$pet['status']}</td>
                                    <td>
                                      <div class='d-inline-flex'>
                                        <form action='views/detalle_mascota.php' method='get'>
                                          <input type='hidden' name='pet_id' value='{$pet['id']}'>
                                          <button type='submit' class='btn btn-info btn-sm mr-2' data-toggle='tooltip' data-placement='top' title='Ver/Editar'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                          </button>
                                        </form>
                                        <button type='submit' onclick='deletePetConfirmation({$pet['id']})' class='btn btn-danger btn-sm'
                                          data-toggle='tooltip' data-placement='top' title='Eliminar Mascota'>
                                          <i class='fa fa-trash'></i>
                                        </button>
                                        <form id='formDeletePet{$pet['id']}' action='controllers/delete_pet_controller.php' method='post'>
                                          <input type='hidden' name='pet_id' value='{$pet['id']}'>
                                        </form>
                                      </div>
                                    </td>
                                </tr>";
                        }
                    ?>
                </tbody>
            </table>
          </div>
        </div>

        <hr>

      </div>
    </main>

    <?php include 'views/footer.php'?>

    <script>
      function deletePetConfirmation(pet_id){
        let confirmation = confirm("¿Está seguro de eliminar esta mascota? Esta acción no se puede deshacer");
        if (confirmation) {
          formId = 'formDeletePet' + pet_id.toString();
          form = document.getElementById(formId);
          console.log(formId);
          form.submit();
        }
      }
    </script>
</body>
</html>