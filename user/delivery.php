<?php
include('include/header.php');
include('include/navbar.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM delivery_record WHERE delivery_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();

        // Get patient details from patient_record using the patient_id from the retrieved record

        if (($record['patient_id'] != NULL) || ($record['patient_id'] != 0)) {
            $patient_id = $record['patient_id'];


            $sql_patient = "SELECT * FROM patient_record WHERE patient_id = '$patient_id'";
            $result_patient = $con->query($sql_patient);

            $patient_record = $result_patient->fetch_assoc();
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
                    $('input[name=\"gravida\"]').val('" . $record['gravida'] . "');
                    $('input[name=\"blood_pressure\"]').val('" . $record['blood_pressure'] . "');
                    $('input[name=\"dateComing\"]').val('" . $record['dateTimeComing'] . "').trigger('change');
                    $('input[name=\"dateDelivery\"]').val('" . $record['dateTimeDelivery'] . "').trigger('change');
                    $('input[name=\"dateDischarge\"]').val('" . $record['dateTimeDischarge'] . "').trigger('change');
                    $('select[name=\"babyGender\"]').val('" . $record['baby_gender'] . "').trigger('change');
        
                    // New fields
                    $('input[name=\"fundicWeight\"]').val('" . $record['fundic_weight'] . "');
                    $('input[name=\"fetalHeartTone\"]').val('" . $record['fetal_heart_tone'] . "');
                    $('input[name=\"vitalSign\"]').val('" . $record['vital_sign'] . "');
                    $('input[name=\"temperature\"]').val('" . $record['temperature'] . "');
                    $('input[name=\"respiration\"]').val('" . $record['respiration'] . "');
                    $('input[name=\"birthWeight\"]').val('" . $record['birth_weight'] . "');
                    $('input[name=\"birthHeight\"]').val('" . $record['birth_height'] . "');


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
    <form id="deliveryForm" action="" method="post">
        <div class='main-content' style='position:relative; height:100%;'>
            <div class="container home-section h-100" style="max-width:95%;">
                <div class="page-wrapper">
                    <br>
                    <h2 class="page-title">
                        <b>
                            <font color="#0C0070">DELIVERY </font>
                            <font color="#046D56"> RECORD </font>
                        </b>
                    </h2>
                    <hr>
                    <div class="row mb-3">

                        <div class="col-10">

                            <a href="deliveries_record.php" type="button" class="btn trans-btn btn-dark "><span
                                    class="fas fa-arrow-left"></span> Return</a>
                            <button type="button" class="btn trans-btn btn-primary btnSaveForm" id="btnSaveForm"><span
                                    class="fas fa-check"></span> Save Record</button>
                            <button type="button" class="btn btn-secondary btnPrint"><span class="fas fa-print"></span>
                                Print Record</button>
                        </div>

                    </div>

                    <div id='print_content'>
                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <!-- Personal Information -->
                                    <section class="mb-4">
                                        <h4>Personal Information</h4>
                                        <hr>
                                        <div class="row">
                                            <!-- Record ID -->
                                            <div class="col-md-2 mb-3">
                                                <label for="record_id" class="form-label">Record ID</label>
                                                <input type="text" class="form-control" name="record_id" id="record_id"
                                                    value="<?php echo $id ?>" readonly>
                                            </div>

                                            <!-- Full Name -->
                                            <div class="col-md-5 mb-3">
                                                <label for="patient_name" class="form-label">Full Name</label>
                                                <select class='form-control col-md-10 patient_name' name='patient_name'
                                                    id='patient_name'>
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
                                            <div class="col-md-3 mb-3">
                                                <label for="birth_date" class="form-label">Birth Date
                                                    (YYYY-MM-DD)</label>
                                                <input type="text" class="form-control" name="birth_date"
                                                    id="birth_date" readonly>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="text" class="form-control" name="age" id="age" readonly>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Address and Contact Number -->
                                            <div class="col-md-8 mb-3">
                                                <label for="address" class="form-label">Address</label>
                                                <input type="text" class="form-control" name="address" id="address"
                                                    readonly>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="contactNumber" class="form-label">Contact Number</label>
                                                <input type="tel" class="form-control" name="contactNumber"
                                                    id="contactNumber" readonly>
                                            </div>
                                        </div>

                                        <!-- Spouse Information -->
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="spouse_name" class="form-label">Spouse Name</label>
                                                <input type="text" class="form-control" id="spouse_name"
                                                    name="spouse_name" placeholder="Spouse Name">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="spouse_date" class="form-label">Birthdate</label>
                                                <input type="date" class="form-control" id="spouse_date"
                                                    name="spouse_date">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="spouse_occupation" class="form-label">Occupation</label>
                                                <input type="text" class="form-control" id="spouse_occupation"
                                                    name="spouse_occupation" placeholder="Enter Occupation">
                                            </div>
                                        </div>

                                        <!-- Additional Information -->
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="philhealth" class="form-label">Philhealth ID</label>
                                                <input type="text" class="form-control" name="philhealth" id="philh_no"
                                                    placeholder="Philhealth ID">
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label for="gravida" class="form-label">Gravida</label>
                                                <input type="text" class="form-control" name="gravida" id="gravida"
                                                    placeholder="Gravida">
                                            </div>
                                        </div>
                                    </section>

                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="container">
                                    <section class="mb-4">
                                        <h4>Current Health Status</h4>
                                        <hr>
                                        <div class="row">
                                            <!-- Fundic Weight -->
                                            <div class="col-md-4 mb-3">
                                                <label for="fundicWeight" class="form-label">Fundic Weight <span
                                                        class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" step="0.1" class="form-control"
                                                        name="fundicWeight" id="fundicWeight" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Fetal Heart Tone -->
                                            <div class="col-md-4 mb-3">
                                                <label for="fetalHeartTone" class="form-label">Fetal Heart Tone<span
                                                        class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    <input type="number" step="0.1" class="form-control"
                                                        name="fetalHeartTone" id="fetalHeartTone" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">bpm</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Blood Pressure -->
                                            <div class="col-md-4 mb-3">
                                                <label for="bloodPressure" class="form-label">Blood Pressure<span
                                                        class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="blood_pressure"
                                                        id="bloodPressure" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">mmHg</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 2 -->
                                        <div class="row">
                                            <!-- Vital Sign -->
                                            <div class="col-md-4 mb-3">
                                                <label for="vitalSign" class="form-label">Vital Sign<span
                                                        class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="vitalSign"
                                                        id="vitalSign" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">unit</span>
                                                        <!-- Replace 'unit' with the correct unit -->
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Temperature -->
                                            <div class="col-md-4 mb-3">
                                                <label for="temperature" class="form-label">Temperature<span
                                                        class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="temperature"
                                                        id="temperature" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">°C</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Respiration -->
                                            <div class="col-md-4 mb-3">
                                                <label for="respiration" class="form-label">Respiration<span
                                                        class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    <input type="number" step="0.1" class="form-control"
                                                        name="respiration" id="respiration" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">bpm</span>
                                                        <!-- Assuming bpm, replace if different -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Row 3 -->
                                        <div class="row">
                                            <!-- Birth Weight -->
                                            <div class="col-md-4 mb-3">
                                                <label for="birthWeight" class="form-label">Birth Weight<span
                                                        class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    <input type="number" step="0.1" class="form-control"
                                                        name="birthWeight" id="birthWeight" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">kg</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Birth Height -->
                                            <div class="col-md-4 mb-3">
                                                <label for="birthHeight" class="form-label">Birth Height<span
                                                        class="text-danger"> *</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="birthHeight"
                                                        id="birthHeight" required>
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">cm</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Gravida -->

                                        </div>

                                        <!-- PARA -->

                                    </section>

                                    <!-- Delivery Information -->
                                    <section class="mb-4">
                                        <h4>Delivery Information</h4>
                                        <hr>
                                        <!-- Delivery Details -->
                                        <div class="row">
                                            <!-- Date-Time Coming -->
                                            <div class="col-md-4 mb-3">
                                                <label for="dateComing" class="form-label">Date-Time Coming<span
                                                        class="text-danger"> *</span></label>
                                                <input type="datetime-local" class="form-control" name="dateComing"
                                                    required>
                                            </div>

                                            <!-- Date-Time Delivery -->
                                            <div class="col-md-4 mb-3">
                                                <label for="dateDelivery" class="form-label">Date-Time Delivery<span
                                                        class="text-danger"> *</span></label>
                                                <input type="datetime-local" class="form-control" name="dateDelivery"
                                                    required>
                                            </div>

                                            <!-- Date-Time Discharge -->
                                            <div class="col-md-4 mb-3">
                                                <label for="dateDischarge" class="form-label">Date-Time Discharge<span
                                                        class="text-danger"> *</span></label>
                                                <input type="datetime-local" class="form-control" name="dateDischarge"
                                                    required>
                                            </div>
                                        </div>

                                        <!-- Baby Gender -->
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label for="babyGender" class="form-label">Gender of Baby<span
                                                        class="text-danger"> *</span></label>
                                                <select class="form-select" name="babyGender" required>
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="Male">Male</option>
                                                    <option value="Female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </section>

                                    <!-- Medicine Section -->
                                    <div class="card">
                                        <div class="card-body" style="background-color: #F5F8FB;">
                                            <h4 class="header-design">Medicine</h4>
                                            <div id="medicine_list_table"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <?php
    include "modal/prenatal_modal.php";
    ?>

</body>

</html>

<script>


    $(document).ready(function () {




        delivery_id = <?php echo $id ?>;

        function fetch_med() {

            $.ajax({
                url: "table/delivery_medicine.php",
                method: "POST",
                data: {
                    delivery_id: delivery_id,

                },
                success: function (data) {
                    $('#medicine_list_table').html(data);
                }
            });
        }
        fetch_med();


        $(document).on('change', '#lastMenstruation', function () {
            var lastMenstruation = new Date($(this).val());
            if (lastMenstruation) {
                var estimatedDelivery = new Date(lastMenstruation);
                estimatedDelivery.setDate(lastMenstruation.getDate() + 280);

                var year = estimatedDelivery.getFullYear();
                var month = ('0' + (estimatedDelivery.getMonth() + 1)).slice(-2);
                var day = ('0' + estimatedDelivery.getDate()).slice(-2);
                var formattedDate = year + '-' + month + '-' + day;

                $('#estimatedDelivery').val(formattedDate);
            }
        });



        $(document).on('click', '.btnVoid', function (e) {
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
                $('#confirmPrenatalModal').modal('show');
            } else if ($(this).hasClass('btnDraft')) {
                $('#draftModal').modal('show');
            }
            // add similar if conditions for other buttons if needed
        });



        $(document).on('click', '#btnSaveForm', function (e) {
            // Prevent the default form submission
            e.preventDefault();

            // Set the form action to the desired URL
            $('#deliveryForm').attr('action', 'function/delivery.save.php');

            // Submit the form asynchronously using AJAX
            $.ajax({
                type: "POST",
                url: $('#deliveryForm').attr('action'),
                data: $('#deliveryForm').serialize(),
                success: function (response) {
                    if (response.trim() === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Sale transaction completed!',
                        });
                        var selectElement = document.getElementById('patient_name');
                        $(selectElement).chosen('destroy');

                        // Set all inputs to readonly
                        $('#deliveryForm input').prop('readonly', true);
                        $('#deliveryForm textarea').prop('readonly', true);
                        $('#deliveryForm select').prop('disabled', true); //use 'disabled' for select elements
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

            $('#philh_no').val(selectedPhilhealth);

        });
        $(function () {
            $(".patient_name").chosen({
                search_threshold: 10
            });
        });


        $(document).on('click', '.btnPrint', function (e) {
            // Check if 'sale_buyer' input is readonly
            if (!$('#spouse_name').prop('readonly')) {
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