<?php
include('../../function/db.php');

if (isset($_POST['new'])) {



    // Creating the SQL query
    $query = "INSERT INTO delivery_record (dateRecording) 
                            VALUES (NOW())";

    // Executing the query
    $results = mysqli_query($con, $query);

    if ($results) {
        $last_id = $con->insert_id;
        header("Location: ../delivery.php?id=$last_id"); // Change this to your desired location
        exit();
    } else {
        echo "ERROR: Could not be able to execute the query. " . mysqli_error($con);
    }
    exit();
}



// Delete Functionality
if (isset($_POST['delete'])) {
    $record_id = $_POST['record_id']; 

    // Prepare SQL statement to prevent SQL injection
    $query = "DELETE FROM delivery_record WHERE delivery_id  = ?";
    if ($stmt = $con->prepare($query)) {
        $stmt->bind_param("i", $record_id); 

        if ($stmt->execute()) {
            header("Location: ../deliveries_record.php"); 
            $_SESSION['delete_patient'] = "successful";
            exit();
        } else {
            echo "ERROR: Could not execute query: $query. " . mysqli_error($con);
        }

        $stmt->close();
    } else {
        echo "ERROR: Could not prepare query: $query. " . mysqli_error($con);
    }
}