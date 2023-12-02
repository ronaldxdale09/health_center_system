<?php
include('include/header.php');
include('include/navbar.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);
    $status = "";
    $sql = "SELECT * FROM prenatal_record WHERE prenatal_id = $id";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
        $status = $record["status"];





        // Get patient details from patient_record using the patient_id from the retrieved record
        $profileImagePath = "assets/img/avatar2.png"; // Default image path
        if (($record['patient_id'] != NULL)) {
            $patient_id = $record['patient_id'];



            $sql_patient = "SELECT * FROM patient_record WHERE patient_id = '$patient_id'";
            $result_patient = $con->query($sql_patient);
            $patient_record = $result_patient->fetch_assoc();


            $profileImagePath = "assets/img/avatar2.png"; // Default image path
            if ($patient_record['ProfilePicture'] != '') {
                $profileImagePath = 'patient_img/' . $patient_record['ProfilePicture']; // Adjust the path as needed
            } else {
                $profileImagePath = "assets/img/avatar2.png"; // Default image path
            }


            echo "
            <script>
                $(document).ready(function() {
                    $('#patient_name').val('" . $patient_record['patient_id'] . "').trigger('chosen:updated');
                    $('#birth_date').val('" . $patient_record['DateOfBirth'] . "');
                    $('#address').val('" . $patient_record['Address'] . "');
                    $('#contactNumber').val('" . $patient_record['ContactNumber'] . "');
                    $('#spouse_name').val('" . $patient_record['spouse_name'] . "');
                    $('#spouse_date').val('" . $patient_record['spouse_birthdate'] . "');
                    $('#spouse_occupation').val('" . $patient_record['spouse_occupation'] . "');

                    // Calculate the patient's age based on the DateOfBirth
                    let today = new Date();
                    let birthDate = new Date('" . $patient_record['DateOfBirth'] . "');
                    let age = today.getFullYear() - birthDate.getFullYear();
                    if (today.getMonth() < birthDate.getMonth() || (today.getMonth() == birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
                        age--;
                    }
                    $('#age').val(age);

                });
            </script>
        ";
        }

        echo "
            <script>
                $(document).ready(function() {




                    $('input[name=\"patient_id\"]').val('" . $record['patient_id'] . "');
                    $('input[name=\"philh_no\"]').val('" . $record['philh_no'] . "');
                    $('input[name=\"ave_income\"]').val('" . $record['ave_income'] . "');


                    $('input[name=\"abortion\"]').val('" . $record['abortion'] . "');
                    $('input[name=\"para_no\"]').val('" . $record['para_no'] . "');
                    $('input[name=\"lmp\"]').val('" . $record['lmp'] . "');
                    $('input[name=\"edc\"]').val('" . $record['edc'] . "');
                    $('input[name=\"children\"]').val('" . $record['children'] . "');
                    $('input[name=\"gravida\"]').val('" . $record['gravida'] . "');
                    $('input[name=\"height\"]').val('" . $record['height'] . "');
                    $('select[name=\"smoking\"]').val('" . $record['smoking'] . "');
                    $('select[name=\"alcohol\"]').val('" . $record['alcohol'] . "');
                    $('textarea[name=\"notes\"]').val('" . $record['notes'] . "');


                    // Tetanus fields
                    $('input[name=\"tetanus_1\"]').val('" . $record['tetanus_1'] . "');
                    $('input[name=\"tetanus_2\"]').val('" . $record['tetanus_2'] . "');
                    $('input[name=\"tetanus_3\"]').val('" . $record['tetanus_3'] . "');
                    $('input[name=\"tetanus_4\"]').val('" . $record['tetanus_4'] . "');
                    $('input[name=\"tetanus_5\"]').val('" . $record['tetanus_5'] . "');
                    
                    $('input[name=\"remarks_1\"]').val('" . $record['tetanusRemarks_1'] . "');
                    $('input[name=\"remarks_2\"]').val('" . $record['tetanusRemarks_2'] . "');
                    $('input[name=\"remarks_3\"]').val('" . $record['tetanusRemarks_3'] . "');
                    $('input[name=\"remarks_4\"]').val('" . $record['tetanusRemarks_4'] . "');
                    $('input[name=\"remarks_5\"]').val('" . $record['tetanusRemarks_5'] . "');



                });
            </script>
        ";

        echo "
            <script>
                $(document).ready(function() {
                    // ... Your existing code to populate data ...

                    // Now manually update the status badge for each row
                    for (let i = 1; i <= 5; i++) {
                        let dateInput = document.getElementById('tetanus_' + i);
                        let statusConfirmed = document.getElementById('status_confirmed_' + i);
                        let statusPending = document.getElementById('status_pending_' + i);
                        updateStatusBadge(dateInput, statusConfirmed, statusPending);
                    }
                });
            </script>
        ";
    }
}

?>


<style>
    .box {
        border: 1px solid #ddd;
        border-radius: 5px;
        padding: 20px;
        /* Adding padding inside the box */
    }
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<body>
    <form id="prenatalForm" action="" method="post">
        <div class='main-content' style='position:relative; height:100%;'>
            <div class="container home-section h-100" style="max-width:95%;">
                <div class="page-wrapper">
                    <br>
                    <h2 class="page-title">
                        <b>
                            <font color="#0C0070">PRENATAL </font>
                            <font color="#046D56"> RECORD </font>
                        </b>
                    </h2>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-9">
                            <a href="prenatal.php" type="button" class="btn trans-btn btn-secondary ">
                                <span class="fas fa-arrow-left"></span> Return
                            </a>
                            <button type="button" class="btn trans-btn btn-primary" id="confirmPrenatalButton">
                                <span class="fas fa-check"></span> Save Record
                            </button>
                            <button type="button" class="btn trans-btn btn-danger btnVoid" id="btnVoid">
                                <span class="fas fa-trash"></span> Remove Record
                            </button>
                        </div>
                        <div class="col">
                            <button type="button" class="btn btn-warning btnEdit" id="btnEdit">
                                <span class="fas fa-pencil"></span> Edit Record
                            </button>
                            <button type="button" class="btn btn-dark btnPrint">
                                <span class="fas fa-print"></span> Print
                            </button>
                        </div>
                    </div>
                    <div id='input_form'>
                        <div id='print_content'>

                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <!-- Personal Information Section -->
                                        <section class="mb-4">
                                            <h4>Personal Information</h4>
                                            <hr>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <!-- Avatar Image -->
                                                            <img src="<?php echo $profileImagePath; ?>" alt="avatar"
                                                                class="rounded-circle profile-avatar"
                                                                name="profile_picture" id="profile_picture" width="150"
                                                                height="150">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="row">
                                                        <!-- Record ID -->
                                                        <div class="col-2">
                                                            <label for="record_id" class="form-label">Record ID</label>
                                                            <input type="text" class="form-control" name="record_id"
                                                                id="record_id" value="<?php echo $id ?>" readonly>
                                                        </div>
                                                        <!-- Full Name -->
                                                        <div class="col-md-5 mb-3">
                                                            <label for="patient_name" class="form-label">Full
                                                                Name</label>
                                                            <select class='form-control col-md-10 patient_name'
                                                                name='patient_name' id='patient_name'>
                                                                <option disabled="disabled" selected="selected">Select
                                                                    Patient</option>
                                                                <?php
                                                                // Retrieve customer names from the coffee_customer table
                                                                $sql = "SELECT * FROM patient_record";
                                                                $result = mysqli_query($con, $sql);
                                                                if ($result) {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $patient_id = $row['patient_id'];
                                                                        $name = $row['Name'];
                                                                        $birthDate = $row['DateOfBirth'];
                                                                        $address = $row['Address'];
                                                                        $contact = $row['ContactNumber'];

                                                                        $ave_monthIncome = $row['ave_monthIncome'];
                                                                        $philhealth = $row['philhealth'];


                                                                        $spouse_name = $row['spouse_name'];
                                                                        $spouse_birthdate = $row['spouse_birthdate'];
                                                                        $spouse_occupation = $row['spouse_occupation'];

                                                                        echo "<option value='$patient_id' 
                                                                    data-name='$name' 
                                                                    data-birthdate='$birthDate' 
                                                                    data-address='$address' 
                                                                    data-contact='$contact'
                                                                    data-ave_monthIncome='$ave_monthIncome' 
                                                                    data-philhealth='$philhealth'
                                                                    data-spouse_name='$spouse_name' 
                                                                    data-spouse_birthdate='$spouse_birthdate'
                                                                    data-spouse_occupation='$spouse_occupation'
                                                                    >
                                                                    $name
                                                                </option>";
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <!-- Birth Date and Age -->
                                                        <div class="col-md-2 mb-3">
                                                            <label for="birth_date" class="form-label">Birth
                                                                Date</label>
                                                            <input type="text" class="form-control" name="birth_date"
                                                                id="birth_date" readonly>
                                                        </div>
                                                        <div class="col-md-2 mb-3">
                                                            <label for="age" class="form-label">Age</label>
                                                            <input type="text" class="form-control" name="age" id="age"
                                                                readonly>
                                                        </div>
                                                        <!-- Address and Contact Number -->
                                                        <div class="col-md-8 mb-3">
                                                            <label for="address" class="form-label">Address</label>
                                                            <input type="text" class="form-control" name="address"
                                                                id="address" readonly>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <label for="contactNumber" class="form-label">Contact
                                                                Number</label>
                                                            <input type="tel" class="form-control" name="contactNumber"
                                                                id="contactNumber" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>

                                        <!-- Spouse Information Section -->
                                        <section class="mb-4">
                                            <h4>Spouse Information</h4>
                                            <div class="row">
                                                <!-- Spouse Name, Birthdate, Occupation -->
                                                <div class="col-md-4">
                                                    <label for="spouse_name" class="col-form-label">Spouse Name:</label>
                                                    <input type="text" class="form-control" id="spouse_name"
                                                        name="spouse_name" placeholder="Spouse Name">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="spouse_date" class="col-form-label">Birthdate:</label>
                                                    <input type="date" class="form-control" id="spouse_date"
                                                        name="spouse_date">
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="spouse_occupation"
                                                        class="col-form-label">Occupation:</label>
                                                    <input type="text" class="form-control" id="spouse_occupation"
                                                        name="spouse_occupation" placeholder="Enter Occupation">
                                                </div>
                                            </div>
                                        </section>

                                        <!-- Additional Information Section -->
                                        <section class="mb-4">
                                            <h4>Additional Information</h4>
                                            <div class="row">
                                                <!-- Ave. Monthly Family Income, Philhealth No. -->
                                                <div class="col-md-4">
                                                    <label for="ave_income" class="form-label">Ave. Monthly Family
                                                        Income</label>
                                                    <div class="input-group">
                                                        <span class="input-group-text">₱</span>
                                                        <input type="text" class="form-control" name="ave_income"
                                                            id="ave_income" placeholder="Ave. Income">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="philh_no" class="form-label">PHILHEALTH NO.</label>
                                                    <input type="text" class="form-control" name="philh_no"
                                                        id="philh_no" placeholder="Philhealth No.">
                                                </div>
                                            </div>
                                        </section>

                                        <!-- Pregnancy Information Section -->
                                        <section class="mb-4">
                                            <h4>Pregnancy Information</h4>
                                            <div class="row" id="preganancyInfo">
                                                <!-- LMP, EDC, No. Living Children, Gravida, Abortion, PARA -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="lmp" class="form-label">Last Menstrual Period
                                                        (LMP)<spanclass="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="lmp" id="lmp"
                                                        required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="edc" class="form-label">Estimated Date of Confinement
                                                        (EDC)<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control" name="edc" id="edc"
                                                        required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="children" class="form-label">No. Living Children<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="children"
                                                        id="children" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="gravida" class="form-label">Gravida<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" name="gravida"
                                                        id="gravida" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="abortion" class="form-label">Abortion<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="abortion"
                                                        id="abortion" placeholder="No. of Abortion" required>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="para_no" class="form-label">PARA (No. of
                                                        Pregnancy)<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="para_no" id="para_no"
                                                        required>
                                                </div>
                                            </div>
                                        </section>

                                        <!-- Lifestyle and Well-being Section -->
                                        <section class="mb-4">
                                            <h4>Lifestyle and Well-being</h4>
                                            <div class="row">
                                                <!-- Smoking, Alcohol, Notes -->
                                                <div class="col-md-6 mb-3">
                                                    <label for="smoking" class="form-label">Do you
                                                        smoke?</label>
                                                    <select class="form-select" id="smoking" name="smoking" required>
                                                        <option value="" disabled selected>Select an option
                                                        </option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="alcohol" class="form-label">Do you consume
                                                        alcohol?</label>
                                                    <select class="form-select" id="alcohol" name="alcohol" required>
                                                        <option value="" disabled selected>Select an option
                                                        </option>
                                                        <option value="yes">Yes</option>
                                                        <option value="no">No</option>
                                                    </select>
                                                </div>
                                                <div class="col">
                                                    <label for="notes" class="col-form-label">Notes:</label>
                                                    <textarea class="form-control" name="notes" id="notes"
                                                        placeholder="Enter additional notes"></textarea>
                                                </div>
                                            </div>
                                            <br>
                                            <h4>Tetanus Immunization History</h4>
                                            <hr>
                                            <table class="table table-bordered table-hover table-striped"
                                                id='immunization_record'>
                                                <thead class="table-dark text-center">
                                                    <tr>
                                                        <th scope="col">Tetanus</th>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Remarks</th>
                                                        <th scope="col">Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Row 1 -->
                                                    <tr>
                                                        <td> <input type="text" class="form-control" value="Tetanus 1"
                                                                disabled></td>
                                                        <td> <input type="date" class="form-control" name="tetanus_1"
                                                                id="tetanus_1" required></td>
                                                        <td> <input type="text" class="form-control" name="remarks_1"
                                                                id="remarks_1" required></td>
                                                        <td>
                                                            <span class="badge bg-success" id="status_confirmed_1"
                                                                style="display: none;">Confirmed</span>
                                                            <span class="badge bg-warning"
                                                                id="status_pending_1">Pending</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Row 2 -->
                                                    <tr>
                                                        <td> <input type="text" class="form-control" value="Tetanus 2"
                                                                disabled></td>
                                                        <td> <input type="date" class="form-control" name="tetanus_2"
                                                                id="tetanus_2" required></td>
                                                        <td> <input type="text" class="form-control" name="remarks_2"
                                                                id="remarks_2" required></td>
                                                        <td>
                                                            <span class="badge bg-success" id="status_confirmed_2"
                                                                style="display: none;">Confirmed</span>
                                                            <span class="badge bg-warning"
                                                                id="status_pending_2">Pending</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Row 3 -->
                                                    <tr>
                                                        <td> <input type="text" class="form-control" value="Tetanus 3"
                                                                disabled></td>
                                                        <td> <input type="date" class="form-control" name="tetanus_3"
                                                                id="tetanus_3" required></td>
                                                        <td> <input type="text" class="form-control" name="remarks_3"
                                                                id="remarks_3" required></td>
                                                        <td>
                                                            <span class="badge bg-success" id="status_confirmed_3"
                                                                style="display: none;">Confirmed</span>
                                                            <span class="badge bg-warning"
                                                                id="status_pending_3">Pending</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Row 4 -->
                                                    <tr>
                                                        <td> <input type="text" class="form-control" value="Tetanus 4"
                                                                disabled></td>
                                                        <td> <input type="date" class="form-control" name="tetanus_4"
                                                                id="tetanus_4" required></td>
                                                        <td> <input type="text" class="form-control" name="remarks_4"
                                                                id="remarks_4" required></td>
                                                        <td>
                                                            <span class="badge bg-success" id="status_confirmed_4"
                                                                style="display: none;">Confirmed</span>
                                                            <span class="badge bg-warning"
                                                                id="status_pending_4">Pending</span>
                                                        </td>
                                                    </tr>
                                                    <!-- Row 5 -->
                                                    <tr>
                                                        <td> <input type="text" class="form-control" value="Tetanus 5"
                                                                disabled></td>
                                                        <td> <input type="date" class="form-control" name="tetanus_5"
                                                                id="tetanus_5" required></td>
                                                        <td> <input type="text" class="form-control" name="remarks_5"
                                                                id="remarks_5" required></td>
                                                        <td>
                                                            <span class="badge bg-success" id="status_confirmed_5"
                                                                style="display: none;">Confirmed</span>
                                                            <span class="badge bg-warning"
                                                                id="status_pending_5">Pending</span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>

                                    </div>

                                    </section>

                                    <!-- Current Health Status Section -->
                                    <section class="mb-4">
                                        <h4>Current Health Status</h4>
                                        <div id="prenatal_health_status"></div>
                                    </section>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <!-- Additional sections or content can be added here -->
                <br>
            </div>
        </div>
        </div>
    </form>
    <?php include "modal/prenatal_modal.php"; ?>
</body>



</html>

<script>
    function updateStatusBadge(dateInput, statusConfirmed, statusPending) {
        if (dateInput.value) {
            statusConfirmed.style.display = 'block'; // Show 'Confirmed' badge if date is set
            statusPending.style.display = 'none'; // Hide 'Pending' badge
        } else {
            statusConfirmed.style.display = 'none'; // Hide 'Confirmed' badge
            statusPending.style.display = 'block'; // Show 'Pending' badge
        }
    }

    // It's safe to call this function on DOMContentLoaded as well
    document.addEventListener("DOMContentLoaded", function () {
        for (let i = 1; i <= 5; i++) {
            let dateInput = document.getElementById(`tetanus_${i}`);
            let statusConfirmed = document.getElementById(`status_confirmed_${i}`);
            let statusPending = document.getElementById(`status_pending_${i}`);

            updateStatusBadge(dateInput, statusConfirmed, statusPending);

            dateInput.addEventListener('change', function () {
                updateStatusBadge(dateInput, statusConfirmed, statusPending);
            });
        }
    });



    // document.getElementById('profile_picture').addEventListener('change', function (event) {
    //     const reader = new FileReader();
    //     reader.onload = function () {
    //         const img = document.getElementById('preview_image');
    //         img.src = reader.result;
    //     };
    //     reader.readAsDataURL(event.target.files[0]);
    // }, false);


    $(document).ready(function () {


        // prenatal_id = <?php echo $id ?>;

        // function fetch_med() {

        //     $.ajax({
        //         url: "table/prenatal_medicine.php",
        //         method: "POST",
        //         data: {
        //             prenatal_id: prenatal_id,

        //         },
        //         success: function (data) {
        //             $('#medicine_list_table').html(data);
        //         }
        //     });
        // }
        // fetch_med();

        prenatal_id = <?php echo $id ?>;
        function fetch_med() {

            $.ajax({
                url: "table/prenatal.health.php",
                method: "POST",
                data: {
                    prenatal_id: prenatal_id,

                },
                success: function (data) {
                    $('#prenatal_health_status').html(data);
                    makeReadOnly(); // Call this function here

                }
            });
        }
        fetch_med();

        $('#btnEdit').click(function () {
            revertReadOnly();
        });

        function revertReadOnly() {
            // Only revert the readonly state for specific inputs
            $('#input_form').find('input:not(#record_id, #birth_date, #age, #address, #contactNumber, #spouse_name, #spouse_date, #spouse_occupation), textarea').removeAttr('readonly');

            // Enable the 'patient_name' Chosen.js select and update it
            $('#patient_name').prop('disabled', false).trigger('chosen:updated');
            $('#input_form').find('select').prop('disabled', false);

            // Remove hidden inputs added for disabled selects except for 'patient_name'
            $('#input_form').find('select:not(#patient_name)').each(function () {
                $(this).next('input[type="hidden"]').remove();
            });

            // Revert all inputs inside the table with id 'phs_table' to be editable
            $('#phs_table').find('input').removeAttr('readonly');

            // Show the remove buttons in the phs_table
            $('#phs_table').find('.remove-item-line').show();
        }



        function makeReadOnly() {
            var prenatalRecordStatus = '<?php echo $record['status']; ?>';
            if (prenatalRecordStatus === 'Completed') {
                $('#input_form').find('input, textarea').attr('readonly', true);
                $('#input_form').find('select').prop('disabled', true);

                // Add hidden inputs for disabled selects
                $('#input_form').find('select').each(function () {
                    var name = $(this).attr('name');
                    var value = $(this).val();
                    $(this).after('<input type="hidden" name="' + name + '" value="' + value + '">');
                });

                // Make all inputs inside the table with id 'phs_table' readonly
                $('#phs_table').find('input').attr('readonly', true);

                // Hide the remove buttons in the phs_table
                $('#phs_table').find('.remove-item-line').hide();
            }
        }

        makeReadOnly();


        $(document).on('change', '#lmp', function () {
            var lastMenstruation = new Date($(this).val());
            if (lastMenstruation) {
                var estimatedDelivery = new Date(lastMenstruation);
                estimatedDelivery.setDate(lastMenstruation.getDate() + 280);

                var year = estimatedDelivery.getFullYear();
                var month = ('0' + (estimatedDelivery.getMonth() + 1)).slice(-2);
                var day = ('0' + estimatedDelivery.getDate()).slice(-2);
                var formattedDate = year + '-' + month + '-' + day;

                $('#edc').val(formattedDate);
            }
        });

        $(document).on('click', '.btnSaveForm, .btnVoid', function (e) {
            // Check if 'sale_buyer' input is readonly
            if ($('#patient_name').prop('readonly')) {
                // If readonly, show alert and return
                Swal.fire({
                    icon: 'warning',
                    title: 'Form Completed',
                    text: 'This action is not allowed after the form is completed.',
                });
                return;
            }



            if ($(this).hasClass('btnSaveForm')) {

            } else if ($(this).hasClass('btnDraft')) {
                $('#draftModal').modal('show');
            }
            // add similar if conditions for other buttons if needed
        });



        $(document).on('click', '#confirmPrenatalButton', function (e) {
            // Prevent the default form submission
            e.preventDefault();



            var isValid = true;
            var errorMessage = "Please fill out all required fields.";

            // Loop through each input and select element inside the form
            $('#preganancyInfo').find('input, select').each(function () {
                var label = $(this).closest('.col').find('label');
                // Check if the label contains an asterisk, indicating a required field
                if (label.text().indexOf('*') !== 1 && !$(this).val()) {
                    isValid = false;
                    // Highlight the input field or show an error message
                    $(this).css('border-color', 'red'); // Highlight field with red color
                } else {
                    $(this).css('border-color', ''); // Reset to default style if filled
                }
            });

            // Check if all required fields are filled
            if (!isValid) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: errorMessage,
                });
                return; // Stop the function if validation fails
            }




            // Set the form action to the desired URL
            $('#prenatalForm').attr('action', 'function/prenatal.save.php');

            // Submit the form asynchronously using AJAX
            $.ajax({
                type: "POST",
                url: $('#prenatalForm').attr('action'),
                data: $('#prenatalForm').serialize(),
                success: function (response) {
                    if (response.trim() === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Sale transaction completed!',
                        });

                        // Set all inputs to readonly
                        var selectElement = document.getElementById('patient_name');
                        $(selectElement).chosen('destroy');

                        $('#prenatalForm input').prop('readonly', true);
                        $('#prenatalForm textarea').prop('readonly', true);
                        $('#prenatalForm select').prop('disabled', true); //use 'disabled' for select elements
                        // Disable all buttons inside the form
                        // Temporarily hide the buttons
                        $("#print_content button").hide();
                        $('#confirmPrenatalModal').modal('hide');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: response,
                        });
                    }
                },
                error: function (xhr, status, error) {
                    // Handle the error response
                    // Display SweetAlert error popup
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Form submission failed!',
                    });
                }
            });
        });

        $('#patient_name').on('change', function () {
            var selectedName = $(this).find('option:selected').data('name');
            var selectedAddress = $(this).find('option:selected').data('address');
            var selectedContact = $(this).find('option:selected').data('contact');
            var selectedBirthDate = $(this).find('option:selected').data('birthdate');

            var selectedSpouse = $(this).find('option:selected').data('spouse_name');
            var selectedSpouseBirth = $(this).find('option:selected').data('spouse_birthdate');
            var selectedSpouseOccu = $(this).find('option:selected').data('spouse_occupation');
            var selectedAve_monthIncome = $(this).find('option:selected').data('ave_monthIncome');
            var selectedPhilhealth = $(this).find('option:selected').data('philhealth');



            let today = new Date();
            let birthDate = new Date(selectedBirthDate);
            let age = today.getFullYear() - birthDate.getFullYear();

            // Adjust age if the birthdate has not been reached in the current year
            if (today.getMonth() < birthDate.getMonth() || (today.getMonth() == birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
                age--;
            }
            $('#age').val(age);
            $('#address').val(selectedAddress);
            $('#birth_date').val(selectedBirthDate);
            $('#contactNumber').val(selectedContact);
            $('#spouse_name').val(selectedSpouse);
            $('#spouse_date').val(selectedSpouseBirth);
            $('#spouse_occupation').val(selectedSpouseOccu);

            $('#ave_income').val(selectedAve_monthIncome);
            $('#philh_no').val(selectedPhilhealth);

        });
        $(function () {
            $(".patient_name").chosen({
                search_threshold: 10
            });
        });


        $(document).on('click', '.btnPrint', function (e) {
            // Check if 'sale_buyer' input is readonly
            if (!$('#notes').prop('readonly')) {
                // If not readonly, show alert and return
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Form',
                    text: 'Please complete the form before printing.',
                });
                return;
            }

            console.log('hello');

            // Temporarily hide the buttons
            $("#print_content button").hide();

            html2canvas(document.querySelector("#print_content")).then(canvas => {
                var myImage = canvas.toDataURL("image/png");
                var tWindow = window.open("");
                $(tWindow.document.body)
                    .html("<img id='Image' src=" + myImage + " style='width:100%;'></img>")
                    .ready(function () {
                        tWindow.focus();
                        tWindow.print();
                    });

                // Show the buttons again
                $("#print_content button").show();
            });
        });



    });
</script>