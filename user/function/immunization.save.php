<?php
include('../../function/db.php');

$record_id = $_POST['record_id'];
$patient_id = $_POST['patient_id'];

// Define an array of input names
$inputNames = array(
    'bcg_date_1', 'bcg_date_2', 'pentavalent_date_1', 'pentavalent_date_2', 'pentavalent_date_3',
    'opv_date_1', 'opv_date_2', 'opv_date_3', 'ipv_date_1', 'ipv_date_2',
    'pneumococcal_date_1', 'pneumococcal_date_2', 'pneumococcal_date_3', 'mmr_date_1', 'mmr_date_2',
    'bcg_remarks', 'pentavalent_remarks', 'opv_remarks', 'ipv_remarks', 'pneumococcal_remarks', 'mmr_remarks'
);

// Initialize an empty array to store SQL update parts
$updateParts = array();

// Iterate through input names to build the update parts
foreach ($inputNames as $inputName) {
    if (isset($_POST[$inputName]) && $_POST[$inputName] != '') {
        $inputValue = mysqli_real_escape_string($con, $_POST[$inputName]);
        if (strpos($inputName, '_date_') !== false) { // Check if the field is a date
            $updateParts[] = "$inputName = '$inputValue'";
        } else { // For text fields (remarks)
            $updateParts[] = "$inputName = '$inputValue'";
        }
    } else {
        // Set empty dates to NULL and skip empty remarks
        if (strpos($inputName, '_date_') !== false) {
            $updateParts[] = "$inputName = NULL";
        }
    }
}

// Construct the update query for the immunization table
$updateQuery = "UPDATE immunization SET
    patient_id = '$patient_id',
    " . implode(', ', $updateParts) . "
WHERE immunization_id = '$record_id'";

$results = mysqli_query($con, $updateQuery);
if (!$results) {
    echo "ERROR: Could not execute $updateQuery. " . mysqli_error($con);
    exit();
} else {
    echo 'success';
    // If needed, add a function to process immunization data here.
}

exit();
?>
