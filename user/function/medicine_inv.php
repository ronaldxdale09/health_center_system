<?php
include('../../function/db.php');

if (isset($_POST['new'])) { // Changed 'add' to 'new' to match the submit button name

    $name = $_POST['name'];
    $description = $_POST['description'];
    $generic_name = $_POST['generic_name'];
    $expiry_date = $_POST['expiry_date'];
    $supplier = $_POST['supplier'];

    // If there are more fields in your form related to medicine, fetch them here...
    
    // You can add more validation here if needed...

    $query = "INSERT INTO medicine 
              (name, description, generic_name, expiry_date, supplier) 
              VALUES 
              ('$name', '$description', '$generic_name', '$expiry_date', '$supplier')";

    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../medicine_list.php"); // Redirect to a medicine record page or any relevant page
        $_SESSION['add_medicine'] = "successful";  // This assumes you start a session at the beginning.
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
    }
}

// ADD UPDATE AND DELETE functionality as per your need.


if (isset($_POST['addStock'])) {

    $medicine_id = $_POST['medicine_id'];
    $quantity = $_POST['quantity'];
    $notes = $_POST['notes'];

    // If you want more validation or checking, do it here...
    
    $query = "INSERT INTO med_inv (medicine_id, quantity, notes) 
              VALUES ('$medicine_id', '$quantity', '$notes')";

    $results = mysqli_query($con, $query);
                               
    if ($results) {
        header("Location: ../medicine_list.php"); // Redirect to a hypothetical inventory page or any relevant page
        $_SESSION['add_stock'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. ".mysqli_error($con);
    }
}
