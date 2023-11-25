<?php
include('../../function/db.php');

$record_id = $_POST['record_id'];
$patient_id = $_POST['patient_name'];
$gravida = $_POST['gravida'];
$babyGender = $_POST['babyGender'];
$dateComing = $_POST['dateComing'];
$dateDelivery = $_POST['dateDelivery'];
$dateDischarge = $_POST['dateDischarge'];

// New fields from the form
$fundic_weight = $_POST['fundicWeight'];
$fetal_heart_tone = $_POST['fetalHeartTone'];
$vital_sign = $_POST['vitalSign'];
$temperature = $_POST['temperature'];
$respiration = $_POST['respiration'];
$birth_weight = $_POST['birthWeight'];
$birth_height = $_POST['birthHeight'];
$blood_pressure = $_POST['blood_pressure'];

// Update query for the delivery_record
$query = "UPDATE delivery_record SET 
    patient_id = '$patient_id',
    dateTimeComing = '$dateComing', 
    dateTimeDelivery = '$dateDelivery',
    dateTimeDischarge = '$dateDischarge',
    baby_gender = '$babyGender',
    gravida = '$gravida',
    fundic_weight = '$fundic_weight',
    fetal_heart_tone = '$fetal_heart_tone',
    vital_sign = '$vital_sign',
    temperature = '$temperature',
    respiration = '$respiration',
    birth_weight = '$birth_weight',
    birth_height = '$birth_height',
    blood_pressure = '$blood_pressure'
WHERE delivery_id = '$record_id'";

$results = mysqli_query($con, $query);
if (!$results) {
    echo "ERROR: Could not execute $query. " . mysqli_error($con);
    exit();
} else {
    echo 'success';
    processMedicine($con, $record_id);

    $patientUpdateSql = "UPDATE patient_record SET 
    blood_pressure = '$blood_pressure',  temperature = '$temperature',
    respiration = '$respiration'
    WHERE patient_id = '$patient_id' ";
    if (!mysqli_query($con, $patientUpdateSql)) {
        die('Error updating patient record: ' . mysqli_error($con));
    }

}

exit();




function processMedicine($con, $record_id)
{
    // Check if medicine data is provided
    if (!isset($_POST['med']) || empty($_POST['med']) || !isset($_POST['qty']) || empty($_POST['qty'])) {
        // No medicine data to process, return early
        return;
    }

    // Fetch existing medicine lines
    $fetchSql = "SELECT idNo, medicine_id, qty FROM delivery_medicine WHERE delivery_id = '$record_id'";
    $fetchResult = mysqli_query($con, $fetchSql);
    if (!$fetchResult) {
        die('Error fetching existing medicine lines: ' . mysqli_error($con));
    }

    $existingMedicineData = [];
    while ($row = mysqli_fetch_assoc($fetchResult)) {
        $existingMedicineData[$row['medicine_id']] = $row;
    }

    // Arrays from a form
    $medicine_ids = $_POST['med'];
    $quantities = $_POST['qty'];

    foreach ($medicine_ids as $index => $medicine_id) {
        $quantity = $quantities[$index];

        // Check if this medicine already exists in delivery_medicine
        if (array_key_exists($medicine_id, $existingMedicineData)) {
            // Fetch the current qty and calculate the difference
            $currentQty = $existingMedicineData[$medicine_id]['qty'];
            $difference = $quantity - $currentQty;

            // Update delivery_medicine with the new qty
            $sql = "UPDATE delivery_medicine SET qty = '$quantity' WHERE delivery_id = '$record_id' AND medicine_id = '$medicine_id'";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                die('Error updating delivery medicine data: ' . mysqli_error($con));
            }

            // Update the inventory with the difference
            updateMedicineInventory($con, $medicine_id, -$difference);
        } else {
            // Insert new record into delivery_medicine
            $sql = "INSERT INTO delivery_medicine (delivery_id, medicine_id, qty) VALUES ('$record_id', '$medicine_id', '$quantity')";
            $result = mysqli_query($con, $sql);
            if (!$result) {
                die('Error inserting delivery medicine data: ' . mysqli_error($con));
            }

            // Decrease the inventory
            updateMedicineInventory($con, $medicine_id, -$quantity);
        }

        // Remove the processed medicine_id from the existingMedicineData array
        unset($existingMedicineData[$medicine_id]);
    }

    // Remove any old delivery medicine records that weren't in the current submission
    foreach ($existingMedicineData as $medicine_id => $medData) {
        $idNo = $medData['idNo'];
        $deleteSql = "DELETE FROM delivery_medicine WHERE idNo = '$idNo'";
        if (!mysqli_query($con, $deleteSql)) {
            die('Error deleting old delivery medicine data: ' . mysqli_error($con));
        }

        // Return the old qty back to the inventory
        updateMedicineInventory($con, $medicine_id, $medData['qty']);
    }
}

function updateMedicineInventory($con, $medicine_id, $quantityChange)
{
    // Get the current inventory for the medicine
    $inventoryQuery = "SELECT quantity FROM med_inv WHERE medicine_id = '$medicine_id'";
    $result = mysqli_query($con, $inventoryQuery);

    if ($row = mysqli_fetch_assoc($result)) {
        $currentInventory = $row['quantity'];
        $newInventory = $currentInventory + $quantityChange; // Add the difference back to the inventory

        // Ensure new inventory is not negative
        $newInventory = max($newInventory, 0);

        $updateQuery = "UPDATE med_inv SET quantity = '$newInventory' WHERE medicine_id = '$medicine_id'";
        if (!mysqli_query($con, $updateQuery)) {
            die('Error updating medicine inventory: ' . mysqli_error($con));
        }
    } else {
        die('Error fetching medicine inventory: ' . mysqli_error($con));
    }
}
