<?php
    session_start ();
    session_destroy();
    header("location:/web-mascotas/admin/index.php")
?>