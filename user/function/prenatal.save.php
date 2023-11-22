<?php
include('../../function/db.php');



$record_id = $_POST['record_id'];

$patient_id = $_POST['patient_name'];



$philh_no = isset($_POST['philh_no']) ? $_POST['philh_no'] : '';

$ave_income = isset($_POST['ave_income']) ? $_POST['ave_income'] : '';
$abortion = isset($_POST['abortion']) ? $_POST['abortion'] : '';
$para_no = isset($_POST['para_no']) ? $_POST['para_no'] : '';

$lmp = isset($_POST['lmp']) ? $_POST['lmp'] : '';
$edc = isset($_POST['edc']) ? $_POST['edc'] : '';
$children = isset($_POST['children']) ? $_POST['children'] : '';
$gravida = isset($_POST['gravida']) ? $_POST['gravida'] : '';

$smoking = isset($_POST['smoking']) ? $_POST['smoking'] : '';
$alcohol = isset($_POST['alcohol']) ? $_POST['alcohol'] : '';
$notes = isset($_POST['notes']) ? $_POST['notes'] : '';



$query = "UPDATE prenatal_record SET patient_id='$patient_id',ave_income='$ave_income',
     philh_no='$philh_no', abortion='$abortion', 
    para_no='$para_no', lmp='$lmp', edc='$edc', children='$children', 
    gravida='$gravida',  smoking='$smoking', alcohol='$alcohol', notes='$notes'
    WHERE prenatal_id ='$record_id'";

$results = mysqli_query($con, $query);
if (!$results) {

    echo "ERROR: Could not execute $query. " . mysqli_error($con);
    exit();
} else {

    $query = "UPDATE patient_record SET ave_monthIncome='$ave_income',philhealth='$philh_no'
    WHERE patient_id ='$patient_id'";
    $results = mysqli_query($con, $query);


    processHealthStatus($con, $record_id);
    // processMedicine($con, $record_id);
    echo 'success';
}

exit();


// function processMedicine($con, $record_id)
// {
//     // Fetch existing medicine lines
//     $fetchSql = "SELECT idNo, medicine_id, qty FROM prenatal_medicine WHERE prenatal_id = '$record_id'";
//     $fetchResult = mysqli_query($con, $fetchSql);
//     if (!$fetchResult) {
//         die('Error fetching existing medicine lines: ' . mysqli_error($con));
//     }

//     $existingMedicineData = [];
//     while ($row = mysqli_fetch_assoc($fetchResult)) {
//         $existingMedicineData[$row['medicine_id']] = $row;
//     }

//     // Arrays from a form
//     $medicine_ids = $_POST['med'];
//     $quantities = $_POST['qty'];

//     foreach ($medicine_ids as $index => $medicine_id) {
//         $quantity = $quantities[$index];

//         // Check if this medicine already exists in prenatal_medicine
//         if (array_key_exists($medicine_id, $existingMedicineData)) {
//             // Fetch the current qty and calculate the difference
//             $currentQty = $existingMedicineData[$medicine_id]['qty'];
//             $difference = $quantity - $currentQty;

//             // Update prenatal_medicine with the new qty
//             $sql = "UPDATE prenatal_medicine SET qty = '$quantity' WHERE prenatal_id = '$record_id' AND medicine_id = '$medicine_id'";
//             $result = mysqli_query($con, $sql);
//             if (!$result) {
//                 die('Error updating prenatal medicine data: ' . mysqli_error($con));
//             }

//             // Update the inventory with the difference
//             updateMedicineInventory($con, $medicine_id, -$difference);
//         } else {
//             // Insert new record into prenatal_medicine
//             $sql = "INSERT INTO prenatal_medicine (prenatal_id, medicine_id, qty) VALUES ('$record_id', '$medicine_id', '$quantity')";
//             $result = mysqli_query($con, $sql);
//             if (!$result) {
//                 die('Error inserting prenatal medicine data: ' . mysqli_error($con));
//             }

//             // Decrease the inventory
//             updateMedicineInventory($con, $medicine_id, -$quantity);
//         }

//         // Remove the processed medicine_id from the existingMedicineData array
//         unset($existingMedicineData[$medicine_id]);
//     }

//     // Remove any old prenatal medicine records that weren't in the current submission
//     foreach ($existingMedicineData as $medicine_id => $medData) {
//         $idNo = $medData['idNo'];
//         $deleteSql = "DELETE FROM prenatal_medicine WHERE idNo = '$idNo'";
//         if (!mysqli_query($con, $deleteSql)) {
//             die('Error deleting old prenatal medicine data: ' . mysqli_error($con));
//         }

//         // Return the old qty back to the inventory
//         updateMedicineInventory($con, $medicine_id, $medData['qty']);
//     }
// }

// function updateMedicineInventory($con, $medicine_id, $quantityChange)
// {
//     // Get the current inventory for the medicine
//     $inventoryQuery = "SELECT quantity FROM med_inv WHERE medicine_id = '$medicine_id'";
//     $result = mysqli_query($con, $inventoryQuery);

//     if ($row = mysqli_fetch_assoc($result)) {
//         $currentInventory = $row['quantity'];
//         $newInventory = $currentInventory + $quantityChange; // Add the difference back to the inventory

//         // Ensure new inventory is not negative
//         $newInventory = max($newInventory, 0);

//         $updateQuery = "UPDATE med_inv SET quantity = '$newInventory' WHERE medicine_id = '$medicine_id'";
//         if (!mysqli_query($con, $updateQuery)) {
//             die('Error updating medicine inventory: ' . mysqli_error($con));
//         }
//     } else {
//         die('Error fetching medicine inventory: ' . mysqli_error($con));
//     }
// }


function processHealthStatus($con, $record_id) {
    // Fetch existing health status
    $fetchSql = "SELECT phs_id FROM prenatal_health_status WHERE prenatal_id = '$record_id'";
    $fetchResult = mysqli_query($con, $fetchSql);
    if (!$fetchResult) {
        die('Error fetching existing health status: ' . mysqli_error($con));
    }

    $existingStatusData = [];
    while ($row = mysqli_fetch_assoc($fetchResult)) {
        $existingStatusData[$row['phs_id']] = $row;
    }

    // Arrays from the form
    $phs_ids = $_POST['phs_id'] ?? [];
    $healthCheck_dates = $_POST['healthCheck_date'] ?? [];
    $blood_pressures = $_POST['blood_pressure'] ?? [];
    $weights = $_POST['weight'] ?? [];
    $fundic_heights = $_POST['fundic_height'] ?? []; // Example for additional field
    $gestational_ages = $_POST['gestational_age'] ?? []; // Example for additional field
    $petal_heart_tones = $_POST['petal_heart_tone'] ?? []; // Example for additional field

    foreach ($healthCheck_dates as $index => $healthCheck_date) {
        $phs_id = $phs_ids[$index] ?? null;
        $blood_pressure = $blood_pressures[$index] ?? '-';
        $weight = $weights[$index] ?? '-';
        $fundic_height = $fundic_heights[$index] ?? null; // Example for additional field
        $gestational_age = $gestational_ages[$index] ?? null; // Example for additional field
        $petal_heart_tone = $petal_heart_tones[$index] ?? null; // Example for additional field

        if ($phs_id && isset($existingStatusData[$phs_id])) {
            // Update existing record
            $updateSql = "UPDATE prenatal_health_status SET 
                healthCheck_date = '$healthCheck_date',
                blood_pressure = '$blood_pressure',
                weight = '$weight',
                fundic_height = '$fundic_height',
                gestational_age = '$gestational_age',
                petalHeartTone = '$petal_heart_tone'
                WHERE phs_id = '$phs_id'";
            if (!mysqli_query($con, $updateSql)) {
                die('Error updating health status: ' . mysqli_error($con));
            }
        } else {
            // Insert new record
            $insertSql = "INSERT INTO prenatal_health_status (prenatal_id, healthCheck_date, blood_pressure, weight, fundic_height, gestational_age, petalHeartTone) 
                    VALUES ('$record_id', '$healthCheck_date', '$blood_pressure', '$weight', '$fundic_height', '$gestational_age', '$petal_heart_tone')";
            if (!mysqli_query($con, $insertSql)) {
                die('Error inserting new health status: ' . mysqli_error($con));
            }
        }
    }

    // Remove any old records that weren't in the current submission
    foreach ($existingStatusData as $existingPhsId => $statusData) {
        if (!in_array($existingPhsId, $phs_ids)) {
            $deleteSql = "DELETE FROM prenatal_health_status WHERE phs_id = '$existingPhsId'";
            if (!mysqli_query($con, $deleteSql)) {
                die('Error deleting old health status data: ' . mysqli_error($con));
            }
        }
    }
}
