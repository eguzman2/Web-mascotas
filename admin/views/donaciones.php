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
          <h1 class="display-4">Donaciones</h1>
          <p>Listado de las donaciones recibidas.</p>
          <p>
            <a class="btn btn-primary btn-lg" href="agregar_donacion.php" role="button">
              Agregar donación »
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
                    <th scope="col">Producto</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Nombre del donador</th>
                    <th scope="col">Fecha de la donación</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once '../models/donation_model.php';
                        $donation_data = getDonations();
                        foreach ($donation_data as $donation) {
                            echo "<tr>
                                    <td>{$donation['id']}</td>
                                    <td>{$donation['product_name']}</td>
                                    <td>{$donation['status']}</td>
                                    <td>{$donation['quantity']}</td>
                                    <td>{$donation['donor_name']}</td>
                                    <td>{$donation['timestamp_date']}</td>
                                    <td>
                                      <div class='d-inline-flex'>
                                        <form action='detalle_donacion.php' method='get'>
                                          <input type='hidden' name='donation_id' value='{$donation['id']}'>
                                          <button type='submit' class='btn btn-info btn-sm mr-2' data-toggle='tooltip' data-placement='top' title='Ver'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                          </button>
                                        </form>
                                        <button type='submit' onclick='deleteDonationConfirmation({$donation['id']})' class='btn btn-danger btn-sm'
                                          data-toggle='tooltip' data-placement='top' title='Eliminar donación'>
                                          <i class='fa fa-trash'></i>
                                        </button>
                                        <form id='formDeleteDonation{$donation['id']}' action='../controllers/delete_donation_controller.php' method='post'>
                                          <input type='hidden' name='donation_id' value='{$donation['id']}'>
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

    <?php include 'footer.php'?>

    <script>
      function deleteDonationConfirmation(donation_id){
        let confirmation = confirm("¿Está seguro de eliminar esta donación? Esta acción no se puede deshacer");
        if (confirmation) {
          formId = 'formDeleteDonation' + donation_id.toString();
          form = document.getElementById(formId);
          console.log(formId);
          form.submit();
        }
      }
    </script>
</body>
</html>