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
          <h1 class="display-4">Productos</h1>
          <p>Crea y administra productos, esten o no en el inventario.</p>
          <p>
            <a class="btn btn-primary btn-lg" href="agregar_producto.php" role="button">
              Agregar un producto »
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
                    <th scope="col">Tipo</th>
                    <th scope="col">Marca</th>
                    <th scope="col">Observaciones</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once '../models/product_model.php';
                        $product_data = getProducts();
                        foreach ($product_data as $product) {
                            echo "<tr>
                                    <td>{$product['id']}</td>
                                    <td>{$product['name']}</td>
                                    <td>{$product['type_name']}</td>
                                    <td>{$product['brand']}</td>
                                    <td>{$product['observations']}</td>
                                    <td>
                                      <div class='d-inline-flex'>
                                        <form action='detalle_producto.php' method='get'>
                                          <input type='hidden' name='product_id' value='{$product['id']}'>
                                          <button type='submit' class='btn btn-info btn-sm mr-2' data-toggle='tooltip' data-placement='top' title='Ver/Editar'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                          </button>
                                        </form>
                                        <button type='submit' onclick='deleteProductConfirmation({$product['id']})' class='btn btn-danger btn-sm'
                                          data-toggle='tooltip' data-placement='top' title='Eliminar producto'>
                                          <i class='fa fa-trash'></i>
                                        </button>
                                        <form id='formDeleteProduct{$product['id']}' action='../controllers/delete_product_controller.php' method='post'>
                                          <input type='hidden' name='product_id' value='{$product['id']}'>
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
      function deleteProductConfirmation(product_id){
        let confirmation = confirm("¿Está seguro de eliminar este producto? Esta acción eliminará el registro del inventario, esta acción no se puede deshacer");
        if (confirmation) {
          formId = 'formDeleteProduct' + product_id.toString();
          form = document.getElementById(formId);
          console.log(formId);
          form.submit();
        }
      }
    </script>
</body>
</html>