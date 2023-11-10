<?php
include('../../function/db.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare an update statement
    $updateQuery = "UPDATE patient_medical_history SET
        severe_headaches = ?,
        history_stroke_heart_attack_hypertension = ?,
        non_traumatic_hematoma = ?,
        breast_cancer_history = ?,
        severe_chest_pain = ?,
        prolonged_cough = ?,
        jaundice = ?,
        unexplained_vaginal_bleeding = ?,
        abnormal_vaginal_discharge = ?,
        is_smoker = ?,
        number_of_pregnancies = ?,
        date_of_last_delivery = ?,
        last_delivery_type = ?,
        last_menstrual_period = ?,
        previous_menstrual_period = ?,
        height = ?,
        weight = ?,
        blood_pressure = ?,
        pulse_rate = ?,
        abnormal_discharge = ?,
        discharge_from = ?,
        sores_ulcers = ?,
        pain_burning = ?,
        history_sti_treatment = ?,
        hiv_aids = ?,
        unpleasant_relationship = ?,
        partner_disapproval = ?,
        domestic_violence_history = ?,
        referred_to_dswd = ?,
        referred_to_wcpu = ?,
        referred_to_ngo = ?,
        referred_to_others_specify = ?,
        skin_normal = ?,
        skin_pale = ?,
        skin_yellowish = ?,
        skin_hematoma = ?,
        conjunctiva_normal = ?,
        conjunctiva_pale = ?,
        conjunctiva_yellowish = ?,
        neck_normal = ?,
        neck_mass = ?,
        neck_lymph_nodes = ?,
        breast_normal = ?,
        breast_mass = ?,
        breast_nipple_discharge = ?,
        abdomen_normal = ?,
        abdomen_mass = ?,
        abdomen_varicosities = ?,
        extremities_normal = ?,
        extremities_edema = ?,
        extremities_varicosities = ?,
        pelvic_normal = ?,
        pelvic_mass = ?,
        pelvic_abnormal = ?,
        cervical_none = ?,
        cervical_warts = ?,
        cervical_polyp = ?,
        cervical_inflammation = ?,
        cervical_bloddy = ?,
        cervical_firm = ?,
        cervical_soft = ?
    WHERE patient_id = ?";

    if ($stmt = mysqli_prepare($con, $updateQuery)) {
        // Bind variables to the prepared statement as parameters
        // Assuming all inputs are sent as strings from form, which will be converted to their respective types in the SQL statement
        // 'i' corresponds to an integer
        // 'd' corresponds to a double
        // 's' corresponds to a string
        // 'b' corresponds to a boolean
        mysqli_stmt_bind_param($stmt, "iiiiiiiiisiissssddsisiiiiiiiiiiiiiiiiiiiiiiiiiiiiii",
            $_POST['severe_headaches'] === 'on' ? 1 : 0, // Convert checkboxes to boolean
            // ... Repeat for all other checkbox fields
            $_POST['number_of_pregnancies'],
            $_POST['date_of_last_delivery'],
            // ... Repeat for all other text and date inputs
            $_POST['patient_id'] // This should be an existing patient_id to update the correct record
        );

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Record updated successfully.";
        } else {
            echo "ERROR: Could not execute query: $updateQuery. " . mysqli_error($con);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query: $updateQuery. " . mysqli_error($con);
    }
}

// Close connection
mysqli_close($con);
?>
