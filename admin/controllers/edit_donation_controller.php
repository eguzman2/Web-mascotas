<?php
    require_once '../models/donation_model.php';

    $product_name = $status = $donor_name = "";
    $date = "";
    $quantity = 0;

    $donation_id = False; 
    $errors = [];

    function get_current_info(){
        GLOBAL $errors;

        GLOBAL $donation_id;
        GLOBAL $product_name;
        GLOBAL $quantity;
        GLOBAL $status;
        GLOBAL $donor_name;
        GLOBAL $date;

        if ($donation_id == False){
            if (empty($_GET['donation_id'])){
                array_push($errors, "ERROR: No podemos obtener los detalles de la donación, por favor intenta nuevamente.");
                return True;
            } 
            $donation_id = $_GET['donation_id'];
        }

        $donation_data = getDonationFromId($donation_id);

        foreach ($donation_data as $donation){
            $product_name = $donation['product_name'];
            $quantity = $donation['quantity'];
            $status = $donation['status'];
            $donor_name = $donation['donor_name'];
            $date = $donation['timestamp_date'];
        }

    }

    // read some error response message
    if (!empty($_GET['error'])){
        array_push($errors, $_GET['error']);
    } 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['inputDonationId'])){
            array_push($errors, "ERROR: No es posible editar la donación, identificador no encontrado.");
        } else {
            $donation_id = $_POST['inputDonationId'];
        } 

        if ($donation_id == False){
            array_push($errors, "ERROR: No es posible editar la donación, identificador no encontrado.");
        } 

        if (empty($_POST["inputQuantity"])) {
            array_push($errors, "ERROR: No se pudo obtener la cantidad del producto.");
        } else {
            $quantity = format_input($_POST["inputQuantity"]);
        }

        if (empty($_POST["inputStatus"])) {
            $status = "";
        } else {
            $status = format_input($_POST["inputStatus"]);
        }

        if (empty($_POST["inputDonorName"])) {
            $donor_name = "";
        } else {
            $donor_name = format_input($_POST["inputDonorName"]);
        }

        // IF THERE IS NO ERRORS EDITING THE RECORD

        if (!sizeof($errors)) {
            $success = editDonation($donation_id, $quantity, $status, $donor_name);
    
            if ($success) {
                get_current_info();
                print_success_message();
            } else {
                array_push($errors, "ERROR: No se pudo editar la donación, intenta nuevamente.");
            }
        }        
    } else {
        get_current_info();
    }

    function format_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    function print_success_message(){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>¡La información de la donación se ha actualizado!</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>';
    }

    // show errors
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger' role='alert'>
        {$error}
      </div>";
    }

?>
