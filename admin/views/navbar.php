<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="/web-mascotas/admin/index.php">WebMascotas</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item">
        <a class="nav-link" href="/web-mascotas/admin/index.php">Mascotas</a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/web-mascotas/admin/views/inventario.php">Inventario</a>
        </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="http://example.com"
            id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Productos</a>
        <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="/web-mascotas/admin/views/productos.php">Productos</a>
            <a class="dropdown-item" href="/web-mascotas/admin/views/tipos_de_producto.php">Tipo de Productos</a>
        </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/web-mascotas/admin/views/donaciones.php">Donaciones</a>
        </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <!-- <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search"> -->
        <!-- <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button> -->
        <a href="/web-mascotas/admin/controllers/logout_controller.php" class="btn btn-outline-danger my-2 my-sm-0" type="buton">Cerrar Sesión</a>
        <!-- <a href="logout.php"><h2><font color="red">Logout</font></h2></a> -->
    </form>
    </div>
</nav>