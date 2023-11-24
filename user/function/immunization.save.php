<?php
include('../../function/db.php');

$record_id = $_POST['record_id'];
$patient_id = $_POST['patient_id'];

// Define an array of input names, including the weight fields
$inputNames = array(
    'bcg_date_1', 'bcg_weight_1', 'bcg_remarks_1', 'bcg_date_2', 'bcg_weight_2', 'bcg_remarks_2',
    'pentavalent_date_1', 'pentavalent_weight_1', 'pentavalent_remarks_1', 'pentavalent_date_2', 'pentavalent_weight_2', 'pentavalent_remarks_2', 'pentavalent_date_3', 'pentavalent_weight_3', 'pentavalent_remarks_3',
    'opv_date_1', 'opv_weight_1', 'opv_remarks_1', 'opv_date_2', 'opv_weight_2', 'opv_remarks_2', 'opv_date_3', 'opv_weight_3', 'opv_remarks_3',
    'ipv_date_1', 'ipv_weight_1', 'ipv_remarks_1', 'ipv_date_2', 'ipv_weight_2', 'ipv_remarks_2',
    'pneumococcal_date_1', 'pneumococcal_weight_1', 'pneumococcal_remarks_1', 'pneumococcal_date_2', 'pneumococcal_weight_2', 'pneumococcal_remarks_2', 'pneumococcal_date_3', 'pneumococcal_weight_3', 'pneumococcal_remarks_3',
    'mmr_date_1', 'mmr_weight_1', 'mmr_remarks_1', 'mmr_date_2', 'mmr_weight_2', 'mmr_remarks_2'
);

// Initialize an empty array to store SQL update parts
$updateParts = array();

// Iterate through input names to build the update parts
foreach ($inputNames as $inputName) {
    if (isset($_POST[$inputName]) && $_POST[$inputName] != '') {
        $inputValue = mysqli_real_escape_string($con, $_POST[$inputName]);
        if (strpos($inputName, '_date_') !== false || strpos($inputName, '_weight_') !== false) {
            // Check if the field is a date or weight
            $updateParts[] = "$inputName = '$inputValue'";
        } else {
            // For text fields (remarks)
            $updateParts[] = "$inputName = '$inputValue'";
        }
    } else {
        // Set empty dates and weights to NULL, and skip empty remarks
        if (strpos($inputName, '_date_') !== false || strpos($inputName, '_weight_') !== false) {
            $updateParts[] = "$inputName = NULL";
        }
    }
}

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
}

exit();
?>
