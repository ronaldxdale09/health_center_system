<?php
include('include/header.php');
include('include/navbar.php');

if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM immunization WHERE immunization_id = $id";
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
                    $('#gender').val('" . $patient_record['Gender'] . "');

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


            
                    // Populate vaccine schedule
                    $('input[name=\"fathersName\"]').val('" . ($record['father_name'] ?? '') . "');
                    $('input[name=\"mothersName\"]').val('" . ($record['mother_name'] ?? '') . "');
                    $('input[name=\"birthHeight\"]').val('" . ($record['height'] ?? '') . "');
                    $('input[name=\"birthWeight\"]').val('" . ($record['weight'] ?? '') . "');

                    $('input[name=\"placeOfBirth\"]').val('" . ($record['placeOfBirth'] ?? '') . "');


                });
            </script>
        ";
    }
}

?>
<style>
    .vaccine-schedule {
        width: 100%;
        margin-top: 20px;
    }

    .vaccine-schedule thead.thead-dark th {
        background-color: #343a40;
        /* Dark header */
        color: white;
    }

    .vaccine-schedule td {
        background-color: #f8f9fa;
        /* Light gray for cells */
    }

    .form-control date-input {
        width: 100%;
        padding: .375rem .75rem;
        /* Bootstrap padding */
    }

    .date-group {
        display: flex;
        gap: 4px;
    }

    .date-cell {
        white-space: nowrap;
        overflow: hidden;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<body>
    <form id="immunizationForm" action="" method="post">
        <div class='main-content' style='position:relative; height:100%;'>
            <div class="container home-section h-100" style="max-width:95%;">
                <div class="page-wrapper">
                    <br>
                    <h2 class="page-title">
                        <b>
                            <font color="#0C0070">IMMUNIZATION </font>
                            <font color="#046D56"> RECORD </font>
                        </b>
                    </h2>
                    <hr>
                    <div class="row mb-3">

                        <div class="col-9">


                            <a href="immunization_record.php" type="button" class="btn trans-btn btn-secondary "><span
                                    class="fas fa-arrow-left"></span> Return</a>
                            <button type="button" class="btn trans-btn btn-primary btnSaveForm" id="btnSaveForm"><span
                                    class="fas fa-check"></span> Save Record</button>
                            <button type="button" class="btn trans-btn btn-danger deleteRecord" data-toggle="modal"
                                data-target="#deleteRecord">
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

                    <div class="card">
                        <div class="card-body">
                            <div class="container">

                                <div id='print_content'>
                                    <!-- Personal Information -->
                                    <div id='validation_checker'>
                                        <section class="mb-4">
                                            <img src="assets/img/banner.png" alt="Q-cart Logo" class="img-fluid mb-3">

                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="record_id" class="form-label">Record ID</label>
                                                    <input type="text" class="form-control" name="record_id"
                                                        id="record_id" value="<?php echo $id ?>" readonly>
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="patient_name" class="form-label">Full Name</label>
                                                    <select class='form-control col-md-10 patient_name'
                                                        name='patient_id' id='patient_name'>
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
                                                                $gender = $row['Gender'];

                                                                $spouse_name = $row['spouse_name'];
                                                                $spouse_birthdate = $row['spouse_birthdate'];
                                                                $spouse_occupation = $row['spouse_occupation'];

                                                                echo "<option value='$patient_id' 
                                                                    data-name='$name' 
                                                                    data-birthdate='$birthDate' 
                                                                    data-address='$address' 
                                                                    data-gender='$gender' 

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
                                                    <label for="birth_date" class="form-label">Birth Date
                                                        (YYYY-MM-DD)</label>
                                                    <input type="text" class="form-control" name="birth_date"
                                                        id="birth_date" readonly>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="age" class="form-label">Age</label>
                                                    <input type="text" class="form-control" name="age" id="age"
                                                        readonly>
                                                </div>
                                                <div class="col mb-3">
                                                    <label for="age" class="form-label">Gender</label>
                                                    <input type="text" class="form-control" name="gender" id="gender"
                                                        readonly>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4 mb-3">
                                                    <label for="placeOfBirth" class="form-label">Place of Birth<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="placeOfBirth"
                                                        id="placeOfBirth">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="address" class="form-label">Address<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="address" id="address">
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="mothersName" class="form-label">Mother's Name <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="mothersName"
                                                        id="mothersName">
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-3 mb-3">
                                                    <label for="fathersName" class="form-label">Father's Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="fathersName"
                                                        id="fathersName">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="birthHeight" class="form-label">Birth Height<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="birthHeight"
                                                        id="birthHeight">
                                                </div>
                                                <div class="col-md-3 mb-3">
                                                    <label for="birthWeight" class="form-label">Birth Weight<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control" name="birthWeight"
                                                        id="birthWeight">
                                                </div>

                                            </div>
                                        </section>
                                    </div>
                                    <section class="mb-4">
                                        <h4>Immunization List</h4>
                                        <div id="prenatal_health_status"></div>

                                    </section>
                                </div>
                                <div class="alert alert-success alert-dismissible">
                                    <a href="#" class="btn close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <strong>Sa mga piling rehiyon lamang:</strong>
                                    Sa column ng Petsa ng Bakuna, isulat ang petsa ng pagbigay ng bakuna ayon sa kung
                                    pang-ilang dose ito. Sa column ng Remarks, isulat ang petsa ng pagbalik para sa
                                    susunod na dose, o anumang mahalagang impormasyon na maaring makaapekto sa
                                    pagbabakuna ng bata
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <br>


                <br><br>
            </div>
        </div>

    </form>
    <?php
    include "modal/immunization_modal.php";
    ?>

</body>

</html>

<style>
    .form-control date-input {
        border: 2px solid red;
        /* Default to red border */
    }

    .form-control date-input.date-selected {
        border: 2px solid green;
        /* Green border if a date is selected */
    }
</style>

<script>


    immunization_id = <?php echo $id ?>;

    function fetch_med() {

        $.ajax({
            url: "table/immunization.status.php",
            method: "POST",
            data: {
                immunization_id: immunization_id,

            },
            success: function (data) {
                $('#prenatal_health_status').html(data);
                makeReadOnly(); // Call this function here

            }
        });
    }
    fetch_med();




    document.addEventListener("DOMContentLoaded", function () {
        // Select all date input elements
        var dateInputs = document.querySelectorAll('.date-input');

        // Function to update the border color
        function updateBorderColor() {
            if (this.value) {
                this.style.borderColor = 'green'; // Change to green if there is a value
            } else {
                this.style.borderColor = ''; // Reset to default if there is no value
            }
        }

        // Add event listeners to each date input
        dateInputs.forEach(function (input) {
            input.addEventListener('change', updateBorderColor);
            input.addEventListener('input', updateBorderColor); // For real-time updates
        });
    });

    $(document).ready(function () {
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


            if ($(this).hasClass('btnDraft')) {
                $('#draftModal').modal('show');
            }
        });



        $(document).on('click', '#btnSaveForm', function (e) {
            // Prevent the default form submission
            e.preventDefault();


            var isValid = true;
            var errorMessage = "Please fill out all required fields.";

            // Loop through each input and select element inside the form
            $('#print_content').find('input, select').each(function () {
                var label = $(this).closest('.col').find('label');
                // Check if the label contains an asterisk, indicating a required field
                if (label.text().indexOf('*') !== -1 && !$(this).val()) {
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
            $('#immunizationForm').attr('action', 'function/immunization.save.php');

            // Submit the form asynchronously using AJAX
            $.ajax({
                type: "POST",
                url: $('#immunizationForm').attr('action'),
                data: $('#immunizationForm').serialize(),
                success: function (response) {
                    if (response.trim() === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Sale transaction completed!',
                        });

                        // Set all inputs to readonly
                        $('#immunizationForm input').prop('readonly', true);
                        $('#immunizationForm textarea').prop('readonly', true);
                        $('#immunizationForm select').prop('disabled', true); //use 'disabled' for select elements
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
            var selectedGender = $(this).find('option:selected').data('gender');

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

            $('#gender').val(selectedGender);

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
            if (!$('#address').prop('readonly')) {
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





        $('#btnEdit').click(function () {
            Swal.fire({
                position: 'top-end',
                icon: 'info',
                title: 'Form Editing Enabled',
                showConfirmButton: false,
                timer: 1000
            })
            revertReadOnly();
        });

        function revertReadOnly() {
            // Only revert the readonly state for specific inputs
            $('#print_content').find('input:not(#record_id, #birth_date, #age, #address, #contactNumber, #spouse_name, #spouse_date, #spouse_occupation), textarea').removeAttr('readonly');

            // Enable the 'patient_name' Chosen.js select and update it
            $('#patient_name').prop('disabled', false).trigger('chosen:updated');
            $('#print_content').find('select').prop('disabled', false);

            // Remove hidden inputs added for disabled selects except for 'patient_name'
            $('#print_content').find('select:not(#patient_name)').each(function () {
                $(this).next('input[type="hidden"]').remove();
            });

            // Revert all inputs inside the table with id 'phs_table' to be editable
            $('#immu_table').find('input').removeAttr('readonly');

            // Show the remove buttons in the phs_table
            $('#immu_table').find('.remove-item-line').show();
        }



        function makeReadOnly() {
            var immuStatus = '<?php echo $record['status']; ?>';
            if (immuStatus === 'Completed') {
                $('#print_content').find('input, textarea').attr('readonly', true);
                $('#print_content').find('select').prop('disabled', true);

                // Add hidden inputs for disabled selects
                $('#print_content').find('select').each(function () {
                    var name = $(this).attr('name');
                    var value = $(this).val();
                    $(this).after('<input type="hidden" name="' + name + '" value="' + value + '">');
                });

                // Make all inputs inside the table with id 'phs_table' readonly
                $('#immu_table').find('input').attr('readonly', true);
                $('#immu_table').find('select').prop('disabled', true);

                // Hide the remove buttons in the phs_table
                $('#immu_table').find('.remove-item-line').hide();
            }
        }

        makeReadOnly();


    });
</script>