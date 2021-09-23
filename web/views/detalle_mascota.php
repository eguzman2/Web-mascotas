<!DOCTYPE html>
<html lang="es">
<head>
    <?php include 'header.php'; ?>
</head>
<body>
    <?php include 'navbar.php'; ?>
    <?php include '../controllers/pet_detail_controller.php';?>
    <main role="main">
        <div class="jumbotron" style="padding: 4rem 2rem 1rem 2rem;">
            <div class="container">
                <h1 class="display-4"><?php echo $name;?></h1>
                <p>Visualiza los detalles de la mascota.</p>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <!-- IMAGES -->
                <div class="col-md-6">
                    <?php
                        // SHOW ERROR MESSAGE
                        if ($error){
                    ?>
                            <div class='alert alert-danger' role='alert'>
                                <?php echo $error; ?>
                            </div>
                    <?php
                        }
                    ?>

                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <?php 
                                foreach ($images as $key => $image) {
                            ?>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="<?php echo $key;?>" <?php if ($key == 0) { echo 'class="active"';}?>></li>
                            <?php
                                }
                            ?>
                        </ol>
                        <div class="carousel-inner">
                            <?php 
                                foreach ($images as $key => $image) {
                            ?>
                                    <div class="carousel-item <?php if ($key == 0) { echo 'active';}?>">
                                        <img class="d-block w-100" src="<?php echo $image['file'];?>" alt="<?php echo $image['name'];?>">
                                    </div>
                            <?php
                                }
                            ?>
                            <!-- <div class="carousel-item">
                            <img class="d-block w-100" src="https://dummyimage.com/1000x400/000/fff" alt="Third slide">
                            </div> -->
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>

                </div>
                <div class="col-md-6">
                    <p>
                        <b>Nombre:</b> <?php echo $name;?>
                    </p> 
                    <p>
                        <b>Raza:</b> <?php echo $race;?>
                    </p> 
                    <p>
                        <b>Tamaño:</b> <?php echo $size;?>
                    </p> 
                    <p>
                        <b>Estado:</b> <?php echo $status;?>
                    </p> 
                    
                    <?php 
                        if ($description) {
                    ?>
                            <p>
                                <b>Descripción:</b> <?php echo $description;?>
                            </p> 
                    <?php
                        }
                    ?>
                </div>
            </div>

        <hr>

        </div>
    </main>

    <?php include 'footer.php'?>

</body>
</html>