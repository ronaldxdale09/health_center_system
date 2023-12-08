<?php
include('include/header.php');
include('include/navbar.php');


if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM patient_record WHERE patient_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();

        $profileImagePath = "assets/img/avatar2.png"; // Default image path
        if ($record['ProfilePicture'] != '') {
            $profileImagePath = 'patient_img/' . $record['ProfilePicture']; // Adjust the path as needed
        }


        echo "
            <script>
                $(document).ready(function() {
                
                    $('input[name=\"name\"]').val('" . $record['Name'] . "');
                    $('select[name=\"religion\"]').val('" . $record['Religion'] . "');
                    $('input[name=\"contact_number\"]').val('" . $record['ContactNumber'] . "');
                    $('input[name=\"occupation\"]').val('" . $record['Occupation'] . "');
                    $('select[name=\"gender\"]').val('" . $record['Gender'] . "');
                    $('input[name=\"dob\"]').val('" . $record['DateOfBirth'] . "');
                    $('input[name=\"address\"]').val('" . $record['Address'] . "');
                    $('input[name=\"blood_type\"]').val('" . $record['BloodType'] . "');
                    $('input[name=\"emergency_contact\"]').val('" . $record['EmergencyContact'] . "');
                    $('input[name=\"allergies\"]').val('" . $record['Allergies'] . "');
                    $('input[name=\"existing_conditions\"]').val('" . $record['ExistingConditions'] . "');


                    $('input[name=\"spouse_name\"]').val('" . $record['spouse_name'] . "');
                    $('input[name=\"spouse_date\"]').val('" . $record['spouse_birthdate'] . "');
                    $('input[name=\"spouse_occupation\"]').val('" . $record['spouse_occupation'] . "');



                    $('input[name=\"blood_pressure\"]').val('" . $record['blood_pressure'] . "');
                    $('input[name=\"weight\"]').val('" . $record['weight'] . "');

                    $('input[name=\"respiration\"]').val('" . $record['respiration'] . "');
                    $('input[name=\"temperature\"]').val('" . $record['temperature'] . "');

                    $('textarea[name=\"notes\"]').val('" . $record['Notes'] . "');
                });
            </script>
        ";
    }
}
?>


<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">
                <div class="row">
                    <div class="col-12">
                        <br>

                        <h2 class="page-title">
                            <b>
                                <font color="#0C0070">PATIENT </font>
                                <font color="#046D56"> RECORD </font>
                            </b>
                        </h2>
                        <hr>

                        <div class="row mb-3">

                            <div class="col-10">

                                <a href="patient_list.php" type="button" class="btn trans-btn btn-secondary "><span
                                        class="fas fa-arrow-left"></span> Return</a>

                                <button type="button" class="btn trans-btn btn-primary confirmUpdate"
                                    id="confirmUpdate"><span class="fas fa-check"></span> Save Record</button>
                                <button type="button" class="btn btn-dark btnPrint"><span class="fas fa-print"></span>
                                    Print</button>
                                <!-- <button type="button" class="btn btn-danger btnPrint"><span class="fas fa-trash"></span>
                                    Delete Record</button> -->

                            </div>

                        </div>

                        <form id="patientForm" method="post" enctype="multipart/form-data">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card">

                                                <div class="card-body text-center">
                                                    <!-- Avatar Image -->
                                                    <img src="<?php echo $profileImagePath; ?>" alt="avatar"
                                                        class="rounded-circle profile-avatar" id="preview_image"
                                                        width="150" height="150"> <!-- Upload Button -->
                                                    <div class="mt-3">
                                                        <label for="profile_picture" class="form-label">Upload Profile
                                                            Picture</label>
                                                        <input type="file" class="btn btn-success form-control"
                                                            id="profile_picture" name="profile_picture">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <input hidden type="text" class="form-control" name="patient_id"
                                            value="<?php echo $id ?>">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Name:</label>
                                                    <input type="text" class="form-control" name="name"
                                                        placeholder="Enter name">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Religion:</label>
                                                    <select class="form-select" name="religion">
                                                        <option selected>Select Religion</option>
                                                        <option value="Roman Catholic">Roman Catholic</option>
                                                        <option value="Islam">Islam</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Contact #:</label>
                                                    <input type="text" class="form-control" name="contact_number"
                                                        placeholder="Enter contact number"  oninput="maxLengthCheck(this)" maxlength="11">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Occupation:</label>
                                                    <input type="text" class="form-control" name="occupation"
                                                        placeholder="Enter occupation">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Gender:</label>
                                                    <select class="form-select" name="gender">
                                                        <option selected>Select Gender</option>
                                                        <option value="Male">Male</option>
                                                        <option value="Female">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Date of Birth:</label>
                                                    <input type="date" class="form-control" name="dob"
                                                        placeholder="Select date of birth">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="col-form-label">Complete Address:</label>
                                                    <input type="text" class="form-control" name="address"
                                                        placeholder="Enter complete address">
                                                </div>
                                            </div>
                                        </div> <br>
                                        <div class="row  mb-3">
                                            <div class="col-md-4">
                                                <label class="col-form-label">Spouse Name:</label>
                                                <input type="text" class="form-control" name="spouse_name"
                                                    placeholder="Spouse Name">
                                            </div>
                                            <div class="col">
                                                <label class="col-form-label">Birthdate:</label>
                                                <input type="date" class="form-control" name="spouse_date">
                                            </div>
                                            <div class="col">
                                                <label class="col-form-label">Occupation:</label>
                                                <input type="text" class="form-control" name="spouse_occupation"
                                                    placeholder="Enter Occupation">
                                            </div>
                                        </div>



                                        <div class="row  mb-3">
                                            <div class="col">
                                                <label class="col-form-label">Blood Pressure:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="blood_pressure"
                                                        readonly>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">mmHg</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label class="col-form-label">Weight:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="weight" readonly>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col">
                                                <label class="col-form-label">Temperature:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="temperature" readonly>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">°C</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label class="col-form-label">Respiration:</label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="respiration" readonly>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">bpm</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                            <br>
                            <div class="card">
                                <div class="card-body ">
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Blood Type:</label>
                                                    <input type="text" class="form-control" name="blood_type"
                                                        placeholder="Enter blood type">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Emergency Contact:</label>
                                                    <input type="text" class="form-control" name="emergency_contact"
                                                        placeholder="Enter emergency contact number">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Allergies:</label>
                                                    <input type="text" class="form-control" name="allergies"
                                                        placeholder="Enter allergies">
                                                </div>
                                                <div class="col-md-6">
                                                    <label class="col-form-label">Existing Conditions:</label>
                                                    <input type="text" class="form-control" name="existing_conditions"
                                                        placeholder="Enter existing conditions">
                                                </div>
                                            </div>
                                            <div class="row">

                                                <div class="col">
                                                    <label class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="notes"
                                                        placeholder="Enter additional notes"></textarea>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>




                        <script>

                            document.getElementById('profile_picture').addEventListener('change', function (event) {
                                const reader = new FileReader();
                                reader.onload = function () {
                                    const img = document.getElementById('preview_image');
                                    img.src = reader.result;
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }, false);

                            function maxLengthCheck(object) {
                                if (object.value.length > object.maxLength)
                                    object.value = object.value.slice(0, object.maxLength)
                            }

                            $(document).ready(function () {
                                $('#confirmUpdate').on('click', function (e) {
                                    e.preventDefault();

                                    // Create FormData object from the form
                                    var formData = new FormData($('#patientForm')[0]);
                                    formData.append('add', true); // Add the 'add' parameter to match your PHP condition

                                    $.ajax({
                                        type: "POST",
                                        url: 'function/patient.update.php',
                                        data: formData,
                                        processData: false,  // Necessary to prevent jQuery from automatically transforming the data
                                        contentType: false,  // Necessary to prevent jQuery from setting a content type header
                                        success: function (response) {
                                            if (response.trim() === 'success') {
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Success',
                                                    text: 'Patient Record has been updated!',
                                                });
                                            } else {
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Error',
                                                    text: response, // Displays the error returned from the server
                                                });
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            // More detailed error handling
                                            var errorMessage = xhr.status + ': ' + xhr.statusText;
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'AJAX Error',
                                                text: 'Error - ' + errorMessage,
                                            });
                                        }
                                    });
                                });


                                // $(document).on('click', '#confirmUpdate', function (e) {
                                //     Prevent the default form submission
                                //     e.preventDefault();

                                //     // Set the form action to the desired URL
                                //     $('#patientForm').attr('action', 'function/patient.update.php');

                                //     // Submit the form asynchronously using AJAX
                                //     $.ajax({
                                //         type: "POST",
                                //         url: $('#patientForm').attr('action'),
                                //         data: $('#patientForm').serialize(),
                                //         success: function (response) {
                                //             if (response.trim() === 'success') {
                                //                 Swal.fire({
                                //                     icon: 'success',
                                //                     title: 'Success',
                                //                     text: 'Sale transaction completed!',
                                //                 });


                                //             } else {
                                //                 Swal.fire({
                                //                     icon: 'error',
                                //                     title: 'Error',
                                //                     text: response,
                                //                 });
                                //             }
                                //         },
                                //         error: function (xhr, status, error) {
                                //             // Handle the error response
                                //             // Display SweetAlert error popup
                                //             Swal.fire({
                                //                 icon: 'error',
                                //                 title: 'Error',
                                //                 text: 'Form submission failed!',
                                //             });
                                //         }
                                //     });
                                //     console.log('hello');

                                // });


                            });


                        </script>



                        <br>
                        <?php
                        include "tab/patient_record.php";
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
<?php
include "modal/patient_modal.php";
?>