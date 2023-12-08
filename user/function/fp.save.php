<?php
include('../../function/db.php');

$record_id = $_POST['record_id']; // Ensure this matches the form field

// Collecting all fields from the form
$severe_headaches = isset($_POST['severe_headaches']) ? 1 : 0;
$history_stroke_heart_attack_hypertension = isset($_POST['history_stroke_heart_attack_hypertension']) ? 1 : 0;
$non_traumatic_hematoma = isset($_POST['non_traumatic_hematoma']) ? 1 : 0;
$breast_cancer_history = isset($_POST['breast_cancer_history']) ? 1 : 0;
$severe_chest_pain = isset($_POST['severe_chest_pain']) ? 1 : 0;
$prolonged_cough = isset($_POST['prolonged_cough']) ? 1 : 0;
$jaundice = isset($_POST['jaundice']) ? 1 : 0;
$unexplained_vaginal_bleeding = isset($_POST['unexplained_vaginal_bleeding']) ? 1 : 0;
$abnormal_vaginal_discharge = isset($_POST['abnormal_vaginal_discharge']) ? 1 : 0;
$is_smoker = isset($_POST['is_smoker']) ? 1 : 0;
$number_of_pregnancies = $_POST['number_of_pregnancies'];
$date_of_last_delivery = $_POST['date_of_last_delivery'];
$last_menstrual_period = $_POST['last_menstrual_period'];
$previous_menstrual_period = $_POST['previous_menstrual_period'];
$height = $_POST['height'];
$weight = $_POST['weight'];
$blood_pressure = $_POST['blood_pressure'];
$pulse_rate = $_POST['pulse_rate'];
$abnormal_discharge = isset($_POST['abnormal_discharge']) ? 1 : 0;
$sores_ulcers = isset($_POST['sores_ulcers']) ? 1 : 0;
$pain_burning = isset($_POST['pain_burning']) ? 1 : 0;
$history_sti_treatment = isset($_POST['history_sti_treatment']) ? 1 : 0;
$hiv_aids = isset($_POST['hiv_aids']) ? 1 : 0;
$unpleasant_relationship = isset($_POST['unpleasant_relationship']) ? 1 : 0;
$partner_disapproval = isset($_POST['partner_disapproval']) ? 1 : 0;
$domestic_violence_history = isset($_POST['domestic_violence_history']) ? 1 : 0;
$referred_to_dswd = isset($_POST['referred_to_dswd']) ? 1 : 0;
$referred_to_wcpu = isset($_POST['referred_to_wcpu']) ? 1 : 0;
$referred_to_ngo = isset($_POST['referred_to_ngo']) ? 1 : 0;
$referred_to_others_specify = $_POST['referred_to_others_specify'];
$skin_normal = isset($_POST['skin_normal']) ? 1 : 0;
$skin_pale = isset($_POST['skin_pale']) ? 1 : 0;
$skin_yellowish = isset($_POST['skin_yellowish']) ? 1 : 0;
$skin_hematoma = isset($_POST['skin_hematoma']) ? 1 : 0;
$conjunctiva_normal = isset($_POST['conjunctiva_normal']) ? 1 : 0;
$conjunctiva_pale = isset($_POST['conjunctiva_pale']) ? 1 : 0;
$conjunctiva_yellowish = isset($_POST['conjunctiva_yellowish']) ? 1 : 0;
$neck_normal = isset($_POST['neck_normal']) ? 1 : 0;
$neck_mass = isset($_POST['neck_mass']) ? 1 : 0;
$neck_lymph_nodes = isset($_POST['neck_lymph_nodes']) ? 1 : 0;
$breast_normal = isset($_POST['breast_normal']) ? 1 : 0;
$breast_mass = isset($_POST['breast_mass']) ? 1 : 0;
$breast_nipple_discharge = isset($_POST['breast_nipple_discharge']) ? 1 : 0;
$abdomen_normal = isset($_POST['abdomen_normal']) ? 1 : 0;
$abdomen_mass = isset($_POST['abdomen_mass']) ? 1 : 0;
$abdomen_varicosities = isset($_POST['abdomen_varicosities']) ? 1 : 0;
$extremities_normal = isset($_POST['extremities_normal']) ? 1 : 0;
$extremities_edema = isset($_POST['extremities_edema']) ? 1 : 0;
$extremities_varicosities = isset($_POST['extremities_varicosities']) ? 1 : 0;
$pelvic_normal = isset($_POST['pelvic_normal']) ? 1 : 0;
$pelvic_mass = isset($_POST['pelvic_mass']) ? 1 : 0;
$pelvic_abnormal = isset($_POST['pelvic_abnormal']) ? 1 : 0;
$cervical_none = isset($_POST['cervical_none']) ? 1 : 0;
$cervical_warts = isset($_POST['cervical_warts']) ? 1 : 0;
$cervical_polyp = isset($_POST['cervical_polyp']) ? 1 : 0;
$cervical_inflammation = isset($_POST['cervical_inflammation']) ? 1 : 0;
$cervical_bloddy = isset($_POST['cervical_bloddy']) ? 1 : 0;
$cervical_firm = isset($_POST['cervical_firm']) ? 1 : 0;
$cervical_soft = isset($_POST['cervical_soft']) ? 1 : 0;




$patient_id = $_POST['patient_name'];

echo $patient_id;
// Update query for patient_medical_history
$updateQuery = "UPDATE family_planning_rec SET
    severe_headaches = '$severe_headaches',
    history_stroke_heart_attack_hypertension = '$history_stroke_heart_attack_hypertension',
    non_traumatic_hematoma = '$non_traumatic_hematoma',
    breast_cancer_history = '$breast_cancer_history',
    severe_chest_pain = '$severe_chest_pain',
    prolonged_cough = '$prolonged_cough',
    jaundice = '$jaundice',
    unexplained_vaginal_bleeding = '$unexplained_vaginal_bleeding',
    abnormal_vaginal_discharge = '$abnormal_vaginal_discharge',
    is_smoker = '$is_smoker',
    number_of_pregnancies = '$number_of_pregnancies',
    date_of_last_delivery = '$date_of_last_delivery',
    last_menstrual_period = '$last_menstrual_period',
    previous_menstrual_period = '$previous_menstrual_period',
    height = '$height',
    weight = '$weight',
    blood_pressure = '$blood_pressure',
    pulse_rate = '$pulse_rate',
    abnormal_discharge = '$abnormal_discharge',
    sores_ulcers = '$sores_ulcers',
    pain_burning = '$pain_burning',
    history_sti_treatment = '$history_sti_treatment',
    hiv_aids = '$hiv_aids',
    unpleasant_relationship = '$unpleasant_relationship',
    partner_disapproval = '$partner_disapproval',
    domestic_violence_history = '$domestic_violence_history',
    referred_to_dswd = '$referred_to_dswd',
    referred_to_wcpu = '$referred_to_wcpu',
    referred_to_ngo = '$referred_to_ngo',
    referred_to_others_specify = '$referred_to_others_specify',
    skin_normal = '$skin_normal',
    skin_pale = '$skin_pale',
    skin_yellowish = '$skin_yellowish',
    skin_hematoma = '$skin_hematoma',
    conjunctiva_normal = '$conjunctiva_normal',
    conjunctiva_pale = '$conjunctiva_pale',
    conjunctiva_yellowish = '$conjunctiva_yellowish',
    neck_normal = '$neck_normal',
    neck_mass = '$neck_mass',
    neck_lymph_nodes = '$neck_lymph_nodes',
    breast_normal = '$breast_normal',
    breast_mass = '$breast_mass',
    breast_nipple_discharge = '$breast_nipple_discharge',
    abdomen_normal = '$abdomen_normal',
    abdomen_mass = '$abdomen_mass',
    abdomen_varicosities = '$abdomen_varicosities',
    extremities_normal = '$extremities_normal',
    extremities_edema = '$extremities_edema',
    extremities_varicosities = '$extremities_varicosities',
    pelvic_normal = '$pelvic_normal',
    pelvic_mass = '$pelvic_mass',
    pelvic_abnormal = '$pelvic_abnormal',
    cervical_none = '$cervical_none',
    cervical_warts ='$cervical_warts',
    cervical_polyp = '$cervical_polyp',
    cervical_inflammation = '$cervical_inflammation',
    cervical_bloddy = '$cervical_bloddy',
    cervical_firm = '$cervical_firm',
    cervical_soft = '$cervical_soft',
    patient_id='$patient_id', 
    status = 'Completed'
    WHERE fp_id = '$record_id'"; +


// Execute the update query
$results = mysqli_query($con, $updateQuery);
if (!$results) {
    echo "ERROR: Could not execute $updateQuery. " . mysqli_error($con);
    exit();
} else {
    echo 'success';
}

// Close connection
mysqli_close($con);
?>