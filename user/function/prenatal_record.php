<?php
include('../../function/db.php');

if (isset($_POST['new'])) {

 
    
    // Creating the SQL query
    $query = "INSERT INTO prenatal_record (date_checkup) 
                            VALUES (NOW())";

    // Executing the query
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../prenatal_record.php?id=$last_id");  // Change this to your desired location
        exit();
    } else {
        echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
    }
    exit();
}

