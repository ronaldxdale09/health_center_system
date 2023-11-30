<?php
include('../../function/db.php');

// Check if the form has been submitted
if (isset($_POST['add'])) {
    // Retrieve form data
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

    // Initialize the profile picture name variable
    $profile_picture_name = '';

    // Check if a file is uploaded
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = $_FILES['profile_picture'];
        $uploadDir = '../patient_img/';

        // Validate file type and size here...

        $profile_picture_name = uniqid() . "-" . basename($profile_picture['name']);
        $uploadFilePath = $uploadDir . $profile_picture_name;

        // Attempt to move the uploaded file
        if (move_uploaded_file($profile_picture['tmp_name'], $uploadFilePath)) {
            // File moved successfully
        } else {
            echo "ERROR: Could not move the file " . $profile_picture['name'];
            exit();
        }
    }

    // Prepare the SQL query
    $query = "UPDATE patient_record SET 
              Name = '$name', 
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
              spouse_occupation = '$spouse_occupation'";

    // Update the ProfilePicture in the database if a new picture is uploaded
    if (!empty($profile_picture_name)) {
        $query .= ", ProfilePicture = '$profile_picture_name'";
    }

    // Complete the query
    $query .= " WHERE patient_id = $patient_id;";

    // Execute the query
    $results = mysqli_query($con, $query);
    if ($results) {
        echo 'success';
    } else {
        echo "ERROR: Could not execute $query. " . mysqli_error($con);
    }
}
exit();
?>
