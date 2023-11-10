<?php
include('include/header.php');
include('include/navbar.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM prenatal_record WHERE prenatal_id = $id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();

        // Get patient details from patient_record using the patient_id from the retrieved record

        if (($record['patient_id'] != NULL)) {
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
           
                    $('input[name=\"blood_pressure\"]').val('" . $record['blood_pressure'] . "');
                    $('input[name=\"weight\"]').val('" . $record['weight'] . "');
                    $('input[name=\"height\"]').val('" . $record['height'] . "');

                    $('input[name=\"petal_tone\"]').val('" . $record['petal_tone'] . "');
                    $('input[name=\"fundic_height\"]').val('" . $record['fundic_height'] . "');
                    $('input[name=\"philh_no\"]').val('" . $record['philh_no'] . "');
                    $('input[name=\"abortion\"]').val('" . $record['abortion'] . "');
                    $('input[name=\"para_no\"]').val('" . $record['para_no'] . "');
                    $('input[name=\"lmp\"]').val('" . $record['lmp'] . "');
                    $('input[name=\"edc\"]').val('" . $record['edc'] . "');
                    $('input[name=\"children\"]').val('" . $record['children'] . "');
                    $('input[name=\"gestationalAge\"]').val('" . $record['gestationalAge'] . "');
                    $('input[name=\"gravida\"]').val('" . $record['gravida'] . "');
                    $('input[name=\"height\"]').val('" . $record['height'] . "');
                    $('select[name=\"smoking\"]').val('" . $record['smoking'] . "');
                    $('select[name=\"alcohol\"]').val('" . $record['alcohol'] . "');
                    $('textarea[name=\"notes\"]').val('" . $record['notes'] . "');
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

                        <div class="col-10">

                            <a href="prenatal.php" type="button" class="btn trans-btn btn-secondary "><span
                                    class="fas fa-arrow-left"></span> Return</a>

                            <button type="button" class="btn trans-btn btn-primary btnSaveForm" id="btnSaveForm"><span
                                    class="fas fa-check"></span> Save Record</button>
                            <button type="button" class="btn trans-btn btn-danger btnVoid" id="btnVoid"><span
                                    class="fas fa-trash"></span> Remove Record</button>

                            <button type="button" class="btn trans-btn btn-secondary" id="confirmSales"><span
                                    class="fas fa-eraser"></span> Clear Fields</button>
                        </div>

                        <div class="col">

                            <button type="button" class="btn btn-dark btnPrint"><span class="fas fa-print"></span>
                                Print</button>

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="container">

                                <div id='print_content'>
                                    <!-- Personal Information -->
                                    <section class="mb-4">
                                        <h4>Personal Information</h4>
                                        <hr>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <label for="age" class="form-label">Record ID</label>
                                                <input type="text" class="form-control" name="record_id"
                                                    value="<?php echo $id ?>" readonly>
                                            </div>
                                            <div class="col-md-5 mb-3">
                                                <label for="fullName" class="form-label">Full Name</label>
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

                                                            $spouse_name = $row['spouse_name'];
                                                            $spouse_birthdate = $row['spouse_birthdate'];
                                                            $spouse_occupation = $row['spouse_occupation'];

                                                            echo "<option value='$patient_id' 
                                                                    data-name='$name' 
                                                                    data-birthdate='$birthDate' 
                                                                    data-address='$address' 
                                                                    data-contact='$contact'
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
                                            <div class="col-md-3 mb-3">
                                                <label for="age" class="form-label">Birth Date
                                                    (YYYY-MM-DD)</label>
                                                <input type="text" class="form-control" name="birth_date"
                                                    id="birth_date" readonly>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <label for="age" class="form-label">Age</label>
                                                <input type="text" class="form-control" name="age" id="age" readonly>
                                            </div>
                                            <div class="row">
                                                <div class="col-8">
                                                    <label for="address" class="form-label">Address</label>
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        readonly>
                                                </div>
                                                <div class="col-4">
                                                    <label for="contactNumber" class="form-label">Contact
                                                        Number</label>
                                                    <input type="tel" class="form-control" name="contactNumber"
                                                        id="contactNumber" readonly>
                                                </div>
                                            </div>
                                            <br>

                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="col-form-label">Spouse Name:</label>
                                                <input type="text" class="form-control" id="spouse_name"
                                                    name="spouse_name" placeholder="Spouse Name">
                                            </div>
                                            <div class="col">
                                                <label class="col-form-label">Birthdate:</label>
                                                <input type="date" class="form-control" id="spouse_date"
                                                    name="spouse_date">
                                            </div>
                                            <div class="col">
                                                <label class="col-form-label">Occupation:</label>
                                                <input type="text" class="form-control" id="spouse_occupation"
                                                    name="spouse_occupation" placeholder="Enter Occupation">
                                            </div>
                                        </div>


                                        <br>
                                        <div class="row">
                                            <div class="col">
                                                <label for="address" class="form-label">Ave. Monthly Family
                                                    Income</label>
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">₱</span>
                                                    </div>
                                                    <input type="text" class="form-control" name="ave_income"
                                                        placeholder="Ave. Income" aria-label="Username">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <label for="contactNumber" class="form-label">Birth Plan</label>
                                                <select class="form-select" name="birth_plan" required>
                                                    <option value="" disabled selected>Select an option</option>
                                                    <option value="Hopital">Hopital</option>
                                                    <option value="RHU">RHU</option>
                                                    <option value="LIC">LIC</option>
                                                    <option value="Home">Home</option>

                                                </select>
                                            </div>
                                            <div class="col">
                                                <label for="contactNumber" class="form-label">Birth Attendant if
                                                    at home</label>
                                                <select class="form-select" name="birth_attendant">
                                                    <option value="" disabled selected>Select an option</option>
                                                    <option value="SBA">SBA</option>
                                                    <option value="Non-SBA">Non-SBA</option>

                                                </select>
                                            </div>

                                            <div class="col">
                                                <label for="address" class="form-label">PHILHEALTH NO.
                                                </label>
                                                <div class="input-group mb-3">
                                                    <input type="text" class="form-control" name="philh_no"
                                                        placeholder="Philhealth No." aria-label="Username">
                                                </div>
                                            </div>
                                        </div>




                                    </section>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <section class="mb-4">
                                    <h4>Pregnancy Information</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="lmp" class="form-label">Last Menstrual Period
                                                (LMP)</label>
                                            <input type="date" class="form-control" name="lmp" id="lmp" required>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="edc" class="form-label">Estimated Date of Confinement
                                                (EDC)</label>
                                            <input type="date" class="form-control" name="edc" id="edc" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="parity" class="form-label">No. Living Children</label>
                                            <input type="number" class="form-control" id="children" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="gestationalAge" class="form-label">Gestational
                                                Age</label>
                                            <span data-toggle="tooltip" data-placement="left"
                                                title="Term used during pregnancy to describe how far along the pregnancy is"
                                                style="cursor: pointer; font-size: 15px;">
                                                <i class="fas fa-info-circle"></i>
                                            </span>
                                            <input type="text" class="form-control" name="gestationalAge"
                                                id="gestationalAge" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="gravida" class="form-label">Gravida</label>
                                            <span data-toggle="tooltip" data-placement="left"
                                                title="Number to indicate the number of pregnancies a woman has had"
                                                style="cursor: pointer; font-size: 15px;">
                                                <i class="fas fa-info-circle"></i>
                                            </span>

                                            <input type="number" class="form-control" name="gravida" id="gravida"
                                                required>

                                        </div>

                                        <div class="row">

                                            <div class="col-md-12 mb-3">
                                                <div class="box p-2">

                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="address" class="form-label">Petal Heart
                                                                Tone</label>
                                                            <input type="text" class="form-control" name="petal_tone"
                                                                aria-label="Username">
                                                        </div>
                                                        <div class="col">
                                                            <label for="contactNumber" class="form-label">Fundic
                                                                Height</label>
                                                            <input type="text" class="form-control" name="fundic_height"
                                                                aria-label="Username">
                                                        </div>
                                                        <div class="col">
                                                            <label for="address" class="form-label">Abortion
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <input type="text" class="form-control" name="abortion"
                                                                    placeholder="No. of Abortion" aria-label="Username">
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <label for="contactNumber" class="form-label">PARA
                                                                (No. of Pregnancy)</label>
                                                            <input type="text" class="form-control" name="para_no"
                                                                placeholder="" aria-label="Username">
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                </section>

                                <!-- Current Health Status -->
                                <section class="mb-4">
                                    <h4>Current Health Status</h4>
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label for="weight" class="form-label">Weight (kg)</label>
                                            <input type="number" step="0.1" class="form-control" name="weight"
                                                id="weight" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="height" class="form-label">Height (cm)</label>
                                            <input type="number" step="0.1" class="form-control" name="height"
                                                id="height" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label for="bloodPressure" class="form-label">Blood Pressure</label>
                                            <input type="text" class="form-control" name="blood_pressure"
                                                id="blood_pressure" required>
                                        </div>
                                    </div>
                                </section>

                                <!-- Lifestyle and Well-being -->
                                <section class="mb-4">
                                    <h4>Lifestyle and Well-being</h4>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="smoking" class="form-label">Do you smoke?</label>
                                            <select class="form-select" id="smoking" name="smoking" required>
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="alcohol" class="form-label">Do you consume
                                                alcohol?</label>
                                            <select class="form-select" id="alcohol" name="alcohol" required>
                                                <option value="" disabled selected>Select an option</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">

                                        <div class="col">
                                            <label class="col-form-label">Notes:</label>
                                            <textarea class="form-control" name="notes" id="notes"
                                                placeholder="Enter additional notes"></textarea>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <br>

                    <div class="card">
                        <div class="card-body" style="background-color: #F5F8FB;">
                            <h4 class="header-design">Medicine </h4>
                            <div id="medicine_list_table"></div>


                        </div>
                    </div>
                    <br><br><br>
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


        prenatal_id = <?php echo $id ?>;

        function fetch_med() {

            $.ajax({
                url: "table/prenatal_medicine.php",
                method: "POST",
                data: {
                    prenatal_id: prenatal_id,

                },
                success: function (data) {
                    $('#medicine_list_table').html(data);
                }
            });
        }
        fetch_med();



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
                $('#confirmPrenatalModal').modal('show');
            } else if ($(this).hasClass('btnDraft')) {
                $('#draftModal').modal('show');
            }
            // add similar if conditions for other buttons if needed
        });



        $(document).on('click', '#confirmPrenatalButton', function (e) {
            // Prevent the default form submission
            e.preventDefault();

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