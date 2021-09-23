<?php
session_start();
include("../models/db_connection.php"); 

if(isset($_REQUEST['sub'])){
    $a = $_REQUEST['uname'];
    $b = $_REQUEST['upassword'];

    $dbconnect = start_connection();

    $res = mysqli_query($dbconnect, "select * from users where uname='$a' and upassword='$b'");

    $result=mysqli_fetch_array($res);

    if($result){
        $_SESSION["login"]="1";
        header("location:../index.php");
    }
    else {
        header("location:../login.php?err=1");
    }
}
?>