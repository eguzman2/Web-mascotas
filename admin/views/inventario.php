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
          <h1 class="display-4">Inventario</h1>
          <p>Aquí sabrás la cantidad de productos en existencia.</p>
          <p>
            <a class="btn btn-primary btn-lg" href="agregar_existencias.php" role="button">
              Agregar existencias para un producto »
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
                    <th scope="col">Cantidad</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        require_once '../models/stock_model.php';
                        $stock_data = getStock();
                        foreach ($stock_data as $stock) {
                            echo "<tr>
                                    <td>{$stock['id']}</td>
                                    <td>{$stock['product_name']}</td>
                                    <td>{$stock['quantity']}</td>
                                    <td>{$stock['status']}</td>
                                    <td>
                                      <div class='d-inline-flex'>
                                        <form action='detalle_inventario.php' method='get'>
                                          <input type='hidden' name='stock_id' value='{$stock['id']}'>
                                          <button type='submit' class='btn btn-info btn-sm mr-2' data-toggle='tooltip' data-placement='top' title='Ver/Editar'>
                                            <i class='fa fa-eye' aria-hidden='true'></i>
                                          </button>
                                        </form>
                                        <button type='submit' onclick='deleteStockConfirmation({$stock['id']})' class='btn btn-danger btn-sm'
                                          data-toggle='tooltip' data-placement='top' title='Eliminar registros del producto'>
                                          <i class='fa fa-trash'></i>
                                        </button>
                                        <form id='formDeleteStock{$stock['id']}' action='../controllers/delete_stock_controller.php' method='post'>
                                          <input type='hidden' name='stock_id' value='{$stock['id']}'>
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
      function deleteStockConfirmation(stock_id){
        let confirmation = confirm("¿Está seguro de eliminar este registro del producto? Esta acción no se puede deshacer");
        if (confirmation) {
          formId = 'formDeleteStock' + stock_id.toString();
          form = document.getElementById(formId);
          console.log(formId);
          form.submit();
        }
      }
    </script>
</body>
</html>