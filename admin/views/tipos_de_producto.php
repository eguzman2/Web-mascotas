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
          <h1 class="display-4">Tipos de producto</h1>
          <p>Identifica de la mejor manera tus productos asignandoles un tipo</p>
          <p>
            <a class="btn btn-primary btn-lg" href="agregar_tipo_de_producto.php" role="button">
              Agregar un nuevo tipo »
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
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once '../models/product_model.php';
                        $type_data = getProductTypes();
                        // echo json_encode($type_data);
                        foreach ($type_data as $type) {
                            echo "<tr>
                                    <td>{$type['id']}</td>
                                    <td>{$type['name']}</td>
                                    <td>
                                      <div class='d-inline-flex'>
                                        <form action='detalle_tipo_de_producto.php' method='get'>
                                          <input type='hidden' name='type_id' value='{$type['id']}'>
                                          <button type='submit' class='btn btn-info btn-sm mr-2' data-toggle='tooltip' data-placement='top' title='Ver/Editar'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                          </button>
                                        </form>
                                        <button type='submit' onclick='deleteTypeConfirmation({$type['id']})' class='btn btn-danger btn-sm'
                                          data-toggle='tooltip' data-placement='top' title='Eliminar Tipo de producto'>
                                          <i class='fa fa-trash'></i>
                                        </button>
                                        <form id='formDeleteType{$type['id']}' action='../controllers/delete_product_type_controller.php' method='post'>
                                          <input type='hidden' name='type_id' value='{$type['id']}'>
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
      function deleteTypeConfirmation(type_id){
        let confirmation = confirm("¿Está seguro de eliminar este tipo de producto? Se eliminaran los productos relacionados, esta acción no se puede deshacer");
        if (confirmation) {
          formId = 'formDeleteType' + type_id.toString();
          form = document.getElementById(formId);
          console.log(formId);
          form.submit();
        }
      }
    </script>
</body>
</html>