<?php
include('../../function/db.php');

$record_id = $_POST['record_id'];
$patient_id = $_POST['patient_id'];
// Retrieve additional data from POST request
$fatherName = $_POST['fathersName'];

$mothersName = $_POST['mothersName'];
$birthHeight = $_POST['birthHeight']; 
$birthWeight = $_POST['birthWeight'];
$placeOfBirth = $_POST['placeOfBirth']; 


// Update query to include the new fields
$updateQuery = "UPDATE immunization SET
    patient_id = '$patient_id',
    father_name = '$fatherName', 
    mother_name = '$mothersName', 
    height = '$birthHeight', 
    weight = '$birthWeight',
    placeOfBirth = '$placeOfBirth',

    status = 'Completed'
WHERE immunization_id = '$record_id'";
$results = mysqli_query($con, $updateQuery);
if (!$results) {
    echo "ERROR: Could not execute $updateQuery. " . mysqli_error($con);
    exit();
} else {
     processImmunizationStatus($con, $record_id);
    echo 'success';
}

exit();


function processImmunizationStatus($con, $immunization_id) {
    // Fetch existing immunization status
    $fetchSql = "SELECT is_id FROM immunization_status WHERE immunization_id = '$immunization_id'";
    $fetchResult = mysqli_query($con, $fetchSql);
    if (!$fetchResult) {
        die('Error fetching existing immunization status: ' . mysqli_error($con));
    }

    $existingStatusData = [];
    while ($row = mysqli_fetch_assoc($fetchResult)) {
        $existingStatusData[$row['is_id']] = $row['is_id'];
    }

    // Arrays from the form
    $is_ids = $_POST['is_id'] ?? [];
    $types = $_POST['type'] ?? [];
    $doses = $_POST['dose'] ?? [];
    $dates = $_POST['date'] ?? [];
    $weights = $_POST['weight'] ?? [];
    $remarks = $_POST['remarks'] ?? [];

    foreach ($is_ids as $index => $is_id) {
        $immunizationType = $types[$index] ?? '-';
        $dose = $doses[$index] ?? '-';
        $dateRecording = $dates[$index] ?? null;
        $weight = $weights[$index] ?? '-';
        $remark = $remarks[$index] ?? '-';

        if ($is_id && isset($existingStatusData[$is_id])) {
            // Update existing record
            $updateSql = "UPDATE immunization_status SET 
                immunizationType = '$immunizationType',
                doses = '$dose',
                dateRecording = '$dateRecording',
                weight = '$weight',
                remarks = '$remark'
                WHERE is_id = '$is_id'";
            if (!mysqli_query($con, $updateSql)) {
                die('Error updating immunization status: ' . mysqli_error($con));
            }
        } else {
            // Insert new record
            $insertSql = "INSERT INTO immunization_status (immunization_id, immunizationType, doses, weight, remarks, dateRecording) 
                    VALUES ('$immunization_id', '$immunizationType', '$dose', '$weight', '$remark', '$dateRecording')";
            if (!mysqli_query($con, $insertSql)) {
                die('Error inserting new immunization status: ' . mysqli_error($con));
            }
        }
    }

    // Remove any old records that weren't in the current submission
    foreach ($existingStatusData as $existingIsId) {
        if (!in_array($existingIsId, $is_ids)) {
            $deleteSql = "DELETE FROM immunization_status WHERE is_id = '$existingIsId'";
            if (!mysqli_query($con, $deleteSql)) {
                die('Error deleting old immunization status data: ' . mysqli_error($con));
            }
        }
    }
}



?>


