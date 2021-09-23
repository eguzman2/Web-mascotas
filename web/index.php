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
          <h1 class="display-4">Bienvenido</h1>
          <p>Te mostramos las mascotas disponibles dentro de nuestro albergue</p>
        </div>
      </div>

      <div class="container">
        <div class="row">
          <!-- <div class="col-lg-3 col-md-4 col-sm-6 col-12"> -->
          <div class="col-12">
            <div class="card-columns">
              <?php include 'models/pet_model.php';
                $pets = getPets();

                foreach ($pets as $pet) {
                  ?>
                  <div class="card">
                    <img class="card-img-top" src="<?php echo getPetImageUrl($pet['image']);?>" alt="Foto de la mascota">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $pet['name'];?></h5>
                      <p class="card-text"><?php echo $pet['race'] . ', ' . $pet['size'];?></p>
                      <a href="views/detalle_mascota.php?pet_id=<?php echo $pet['id'];?>" class="btn btn-secondary">Ver mascota</a>
                    </div>
                  </div>
                  <?php
                }
              ?>
            </div>
          </div>
        </div>

        <hr>

      </div>
    </main>

    <?php include 'views/footer.php'?>

</body>
</html>