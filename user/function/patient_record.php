<?php
include('../../function/db.php');

if (isset($_POST['add'])) {

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




    // Upload profile picture
    $profile_picture_name = '';

    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = $_FILES['profile_picture'];
        $uploadDir = '../patient_img/';

        // Validate file type and size here...

        $profile_picture_name = uniqid() . "-" . basename($profile_picture['name']);
        $uploadFilePath = $uploadDir . $profile_picture_name;

        if (!move_uploaded_file($profile_picture['tmp_name'], $uploadFilePath)) {
            echo "ERROR: Could not move the file " . $profile_picture['name'];
            exit();
        }
    }

    $query = "INSERT INTO patient_record 
              (Name, Religion, ContactNumber, Occupation, Gender, DateOfBirth, Address, 
              BloodType, EmergencyContact, Allergies, ExistingConditions, Notes, ProfilePicture,
              spouse_name,spouse_birthdate,spouse_occupation) 
              VALUES 
              ('$name', '$religion', '$contact_number', '$occupation', '$gender', '$dob', 
              '$address', '$blood_type', '$emergency_contact', '$allergies', '$existing_conditions', '$notes', 
              '$profile_picture_name','$spouse_name','$spouse_birth','$spouse_occupation')";

    $results = mysqli_query($con, $query);
    $last_id = $con->insert_id;
    if ($results) {
        header("Location: ../patient_record.php?id=$last_id");
        $_SESSION['add_patient'] = "successful";
        exit();
    } else {
        echo "ERROR: Could not be able to execute $query. " . mysqli_error($con);
    }
}

// ADD UPDATE AND DELETE functionality as per your need.

?>