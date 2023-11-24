<?php
include('../../function/db.php');



$patient_id = $_POST['patient_id'];

$name = $_POST['name'];
$religion = $_POST['religion'];
$contact_number = $_POST['contact_number'];
$occupation = $_POST['occupation'];
$gender = $_POST['gender'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$blood_type = $_POST['blood_type'];
$emergency_contact = $_POST['emergency_contact'];
$allergies = $_POST['allergies'];
$existing_conditions = $_POST['existing_conditions'];
$notes = $_POST['notes'];


$spouse_name = $_POST['spouse_name'];
$spouse_birth = $_POST['spouse_date'];
$spouse_occupation = $_POST['spouse_occupation'];




// // Upload profile picture
// $profile_picture_name = '';

// if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
//     $profile_picture = $_FILES['profile_picture'];
//     $uploadDir = '../patient_img/';

//     // Validate file type and size here...

//     $profile_picture_name = uniqid() . "-" . basename($profile_picture['name']);
//     $uploadFilePath = $uploadDir . $profile_picture_name;

//     if (!move_uploaded_file($profile_picture['tmp_name'], $uploadFilePath)) {
//         echo "ERROR: Could not move the file " . $profile_picture['name'];
//         exit();
//     }
// }



$query = "UPDATE patient_record
SET Name = '$name', 
    Religion = '$religion', 
    ContactNumber = '$contact_number', 
    Occupation = '$occupation', 
    Gender = '$gender', 
    DateOfBirth = '$dob', 
    Address = '$address', 
    BloodType = '$blood_type', 
    EmergencyContact = '$emergency_contact', 
    Allergies = '$allergies', 
    ExistingConditions = '$existing_conditions', 
    Notes = '$notes', 
    spouse_name = '$spouse_name',
    spouse_birthdate = '$spouse_birth',
    spouse_occupation = '$spouse_occupation'
WHERE patient_id = $patient_id;";

$results = mysqli_query($con, $query);
if (!$results) {

    echo "ERROR: Could not execute $query. " . mysqli_error($con);
    exit();
} else {

    echo 'success';
}

exit();
