<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'views/header.php'; ?>
</head>
<body>
    <?php include 'views/navbar.php'; ?>

    <main role="main">

      <div class="jumbotron" style="padding: 4rem 2rem 1rem 2rem;">
        <div class="container">
          <h1 class="display-4">Listado de mascotas</h1>
          <!-- <p>Administra las mascotas</p> -->
          <p><a class="btn btn-primary btn-lg" href="views/agregar_mascota.php" role="button">Agregar una nueva mascota »</a></p>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <div class="col-12">
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
                                    <td></td>
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

</body>
</html>