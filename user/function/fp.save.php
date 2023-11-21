<?php
include('../../function/db.php');

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
        mysqli_stmt_bind_param($stmt, "iiiiiiiiisiissssddsisiiiiiiiiiiiiiiiiiiiiiiiiiiiiii",
            isset($_POST['severe_headaches']) ? 1 : 0, // Convert checkboxes to boolean
            isset($_POST['history_stroke_heart_attack_hypertension']) ? 1 : 0,
            isset($_POST['non_traumatic_hematoma']) ? 1 : 0,
            isset($_POST['breast_cancer_history']) ? 1 : 0,
            isset($_POST['severe_chest_pain']) ? 1 : 0,
            isset($_POST['prolonged_cough']) ? 1 : 0,
            isset($_POST['jaundice']) ? 1 : 0,
            isset($_POST['unexplained_vaginal_bleeding']) ? 1 : 0,
            isset($_POST['abnormal_vaginal_discharge']) ? 1 : 0,
            isset($_POST['is_smoker']) ? 1 : 0,
            $_POST['number_of_pregnancies'],
            $_POST['date_of_last_delivery'],
            $_POST['last_delivery_type'],
            $_POST['last_menstrual_period'],
            $_POST['previous_menstrual_period'],
            $_POST['height'],
            $_POST['weight'],
            $_POST['blood_pressure'],
            $_POST['pulse_rate'],
            isset($_POST['abnormal_discharge']) ? 1 : 0,
            $_POST['discharge_from'],
            isset($_POST['sores_ulcers']) ? 1 : 0,
            isset($_POST['pain_burning']) ? 1 : 0,
            isset($_POST['history_sti_treatment']) ? 1 : 0,
            isset($_POST['hiv_aids']) ? 1 : 0,
            isset($_POST['unpleasant_relationship']) ? 1 : 0,
            isset($_POST['partner_disapproval']) ? 1 : 0,
            isset($_POST['domestic_violence_history']) ? 1 : 0,
            isset($_POST['referred_to_dswd']) ? 1 : 0,
            isset($_POST['referred_to_wcpu']) ? 1 : 0,
            isset($_POST['referred_to_ngo']) ? 1 : 0,
            $_POST['referred_to_others_specify'],
            isset($_POST['skin_normal']) ? 1 : 0,
            isset($_POST['skin_pale']) ? 1 : 0,
            isset($_POST['skin_yellowish']) ? 1 : 0,
            isset($_POST['skin_hematoma']) ? 1 : 0,
            isset($_POST['conjunctiva_normal']) ? 1 : 0,
            isset($_POST['conjunctiva_pale']) ? 1 : 0,
            isset($_POST['conjunctiva_yellowish']) ? 1 : 0,
            isset($_POST['neck_normal']) ? 1 : 0,
            isset($_POST['neck_mass']) ? 1 : 0,
            isset($_POST['neck_lymph_nodes']) ? 1 : 0,
            isset($_POST['breast_normal']) ? 1 : 0,
            isset($_POST['breast_mass']) ? 1 : 0,
            isset($_POST['breast_nipple_discharge']) ? 1 : 0,
            isset($_POST['abdomen_normal']) ? 1 : 0,
            isset($_POST['abdomen_mass']) ? 1 : 0,
            isset($_POST['abdomen_varicosities']) ? 1 : 0,
            isset($_POST['extremities_normal']) ? 1 : 0,
            isset($_POST['extremities_edema']) ? 1 : 0,
            isset($_POST['extremities_varicosities']) ? 1 : 0,
            isset($_POST['pelvic_normal']) ? 1 : 0,
            isset($_POST['pelvic_mass']) ? 1 : 0,
            isset($_POST['pelvic_abnormal']) ? 1 : 0,
            isset($_POST['cervical_none']) ? 1 : 0,
            isset($_POST['cervical_warts']) ? 1 : 0,
            isset($_POST['cervical_polyp']) ? 1 : 0,
            isset($_POST['cervical_inflammation']) ? 1 : 0,
            isset($_POST['cervical_bloddy']) ? 1 : 0,
            isset($_POST['cervical_firm']) ? 1 : 0,
            isset($_POST['cervical_soft']) ? 1 : 0,
            $_POST['patient_id'] // This should be an existing patient_id to update the correct record
        );

        // Execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo 'success';
        } else {
            echo "ERROR: Could not execute query: $updateQuery. " . mysqli_error($con);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "ERROR: Could not prepare query: $updateQuery. " . mysqli_error($con);
    }

// Close connection
mysqli_close($con);
?>
