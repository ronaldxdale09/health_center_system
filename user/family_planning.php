<?php
include('include/header.php');
include('include/navbar.php');
ini_set('display_errors', 0);



if (isset($_GET['id'])) {

    $id = $_GET['id'];
    $id = preg_replace('~\D~', '', $id);

    $sql = "SELECT * FROM family_planning_rec WHERE fp_id = $id";
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

            $('#patient_id').val('" . $record['patient_id'] . "');


            // Checkboxes in Medical History Section
            $('input[name=\"severe_headaches\"]').prop('checked', " . $record['severe_headaches'] . " == 1);
            $('input[name=\"history_stroke_heart_attack_hypertension\"]').prop('checked', " . $record['history_stroke_heart_attack_hypertension'] . " == 1);
            $('input[name=\"non_traumatic_hematoma\"]').prop('checked', " . $record['non_traumatic_hematoma'] . " == 1);
            $('input[name=\"breast_cancer_history\"]').prop('checked', " . $record['breast_cancer_history'] . " == 1);
            $('input[name=\"severe_chest_pain\"]').prop('checked', " . $record['severe_chest_pain'] . " == 1);
            $('input[name=\"prolonged_cough\"]').prop('checked', " . $record['prolonged_cough'] . " == 1);
            $('input[name=\"jaundice\"]').prop('checked', " . $record['jaundice'] . " == 1);
            $('input[name=\"unexplained_vaginal_bleeding\"]').prop('checked', " . $record['unexplained_vaginal_bleeding'] . " == 1);
            $('input[name=\"abnormal_vaginal_discharge\"]').prop('checked', " . $record['abnormal_vaginal_discharge'] . " == 1);
            $('input[name=\"is_smoker\"]').prop('checked', " . $record['is_smoker'] . " == 1);
    
            // Text Inputs in Obstetrical History Section
            $('input[name=\"number_of_pregnancies\"]').val('" . $record['number_of_pregnancies'] . "');
            $('input[name=\"date_of_last_delivery\"]').val('" . $record['date_of_last_delivery'] . "');
            $('input[name=\"last_menstrual_period\"]').val('" . $record['last_menstrual_period'] . "');
            $('input[name=\"previous_menstrual_period\"]').val('" . $record['previous_menstrual_period'] . "');
    
            $('input[name=\"mens_scanty\"]').prop('checked', " . $record['mens_scanty'] . " == 1);
            $('input[name=\"mens_moderate\"]').prop('checked', " . $record['mens_moderate'] . " == 1);
            $('input[name=\"mens_heavy\"]').prop('checked', " . $record['mens_heavy'] . " == 1);
    

            $('input[name=\"dysnebirrhea\"]').prop('checked', " . $record['dysnebirrhea'] . " == 1);
            $('input[name=\"hydatiform\"]').prop('checked', " . $record['hydatiform'] . " == 1);
            $('input[name=\"ectopic\"]').prop('checked', " . $record['ectopic'] . " == 1);
    


            // Radio Buttons in STI Risks Section
            $('input[name=\"abnormal_discharge\"][value=\"" . ($record['abnormal_discharge'] ? 'yes' : 'no') . "\"]').prop('checked', true);
            $('input[name=\"sores_ulcers\"][value=\"" . ($record['sores_ulcers'] ? 'yes' : 'no') . "\"]').prop('checked', true);
            $('input[name=\"pain_burning\"][value=\"" . ($record['pain_burning'] ? 'yes' : 'no') . "\"]').prop('checked', true);
            $('input[name=\"history_sti_treatment\"][value=\"" . ($record['history_sti_treatment'] ? 'yes' : 'no') . "\"]').prop('checked', true);
            $('input[name=\"hiv_aids\"][value=\"" . ($record['hiv_aids'] ? 'yes' : 'no') . "\"]').prop('checked', true);
    
            // Radio Buttons in VAW Section
            $('input[name=\"unpleasant_relationship\"][value=\"" . ($record['unpleasant_relationship'] ? 'yes' : 'no') . "\"]').prop('checked', true);
            $('input[name=\"partner_disapproval\"][value=\"" . ($record['partner_disapproval'] ? 'yes' : 'no') . "\"]').prop('checked', true);
            $('input[name=\"domestic_violence_history\"][value=\"" . ($record['domestic_violence_history'] ? 'yes' : 'no') . "\"]').prop('checked', true);
    
            // Checkbox Group for 'referred_to'
            // Assuming these values are stored as a comma-separated string in the database
            var referredToValues = '" . $record['referred_to_dswd'] . "," . $record['referred_to_wcpu'] . "," . $record['referred_to_ngo'] . "," . ($record['referred_to_others_specify'] ? 'others' : '') . "'.split(',');
            referredToValues.forEach(function(value) {
                $('input[name=\"referred_to\"][value=\"' + value.trim() + '\"]').prop('checked', true);
            });
            $('input[name=\"referred_to_others_specify\"]').val('" . $record['referred_to_others_specify'] . "');
    
            // Text Inputs in Physical Examination Section
            $('input[name=\"height\"]').val('" . $record['height'] . "');
            $('input[name=\"weight\"]').val('" . $record['weight'] . "');
            $('input[name=\"blood_pressure\"]').val('" . $record['blood_pressure'] . "');
            $('input[name=\"pulse_rate\"]').val('" . $record['pulse_rate'] . "');
    
            // Checkboxes in Physical Examination Section
            $('input[name=\"skin_normal\"]').prop('checked', " . $record['skin_normal'] . " == 1);
            $('input[name=\"skin_pale\"]').prop('checked', " . $record['skin_pale'] . " == 1);
            $('input[name=\"skin_yellowish\"]').prop('checked', " . $record['skin_yellowish'] . " == 1);
            $('input[name=\"skin_hematoma\"]').prop('checked', " . $record['skin_hematoma'] . " == 1);
            $('input[name=\"conjunctiva_normal\"]').prop('checked', " . $record['conjunctiva_normal'] . " == 1);
            $('input[name=\"conjunctiva_pale\"]').prop('checked', " . $record['conjunctiva_pale'] . " == 1);
            $('input[name=\"conjunctiva_yellowish\"]').prop('checked', " . $record['conjunctiva_yellowish'] . " == 1);
            $('input[name=\"neck_normal\"]').prop('checked', " . $record['neck_normal'] . " == 1);
            $('input[name=\"neck_mass\"]').prop('checked', " . $record['neck_mass'] . " == 1);
            $('input[name=\"neck_lymph_nodes\"]').prop('checked', " . $record['neck_lymph_nodes'] . " == 1);
            $('input[name=\"breast_normal\"]').prop('checked', " . $record['breast_normal'] . " == 1);
            $('input[name=\"breast_mass\"]').prop('checked', " . $record['breast_mass'] . " == 1);
            $('input[name=\"breast_nipple_discharge\"]').prop('checked', " . $record['breast_nipple_discharge'] . " == 1);
            $('input[name=\"abdomen_normal\"]').prop('checked', " . $record['abdomen_normal'] . " == 1);
            $('input[name=\"abdomen_mass\"]').prop('checked', " . $record['abdomen_mass'] . " == 1);
            $('input[name=\"abdomen_varicosities\"]').prop('checked', " . $record['abdomen_varicosities'] . " == 1);
            $('input[name=\"extremities_normal\"]').prop('checked', " . $record['extremities_normal'] . " == 1);
            $('input[name=\"extremities_edema\"]').prop('checked', " . $record['extremities_edema'] . " == 1);
            $('input[name=\"extremities_varicosities\"]').prop('checked', " . $record['extremities_varicosities'] . " == 1);
            $('input[name=\"pelvic_normal\"]').prop('checked', " . $record['pelvic_normal'] . " == 1);
            $('input[name=\"pelvic_mass\"]').prop('checked', " . $record['pelvic_mass'] . " == 1);
            $('input[name=\"pelvic_abnormal\"]').prop('checked', " . $record['pelvic_abnormal'] . " == 1);
            $('input[name=\"cervical_none\"]').prop('checked', " . $record['cervical_none'] . " == 1);
            $('input[name=\"cervical_warts\"]').prop('checked', " . $record['cervical_warts'] . " == 1);
            $('input[name=\"cervical_polyp\"]').prop('checked', " . $record['cervical_polyp'] . " == 1);
            $('input[name=\"cervical_inflammation\"]').prop('checked', " . $record['cervical_inflammation'] . " == 1);
            $('input[name=\"cervical_bloddy\"]').prop('checked', " . $record['cervical_bloddy'] . " == 1);
            $('input[name=\"cervical_firm\"]').prop('checked', " . $record['cervical_firm'] . " == 1);
            $('input[name=\"cervical_soft\"]').prop('checked', " . $record['cervical_soft'] . " == 1);
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
                            <i class="fas fa-book"></i>
                            <b>
                                <font color="#0C0070">FAMILY</font>
                                <font color="#046D56">PLANNING</font>
                            </b>
                        </h2>

                        <hr>
                        <!-- <div class="row mb-3">

                            <div class="col-9">


                                <button type="button" class="btn trans-btn btn-primary confirmSales"
                                    id="confirmRecord"><span class="fas fa-check"></span> Save Record</button>
                                <button type="button" class="btn trans-btn btn-secondary" id="confirmSales"><span
                                        class="fas fa-eraser"></span> Clear Fields</button>
                            </div>

                            <div class="col">

                                <button type="button" class="btn btn-dark btnPrint"><span class="fas fa-print"></span>
                                    Print</button>

                            </div>
                        </div> -->

                            
                        <div class="row mb-3">
                            <div class="col-9">
                                <a href="fp_record.php" type="button" class="btn trans-btn btn-secondary ">
                                    <span class="fas fa-arrow-left"></span> Return
                                </a>
                                <button type="button" class="btn trans-btn btn-primary" id="confirmRecord">
                                    <span class="fas fa-check"></span> Save Record
                                </button>
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



                        <form id="familyplanning_form" action="" method="post">
                            <div class="alert alert-secondary alert-dismissible fade show">
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                                <strong>Important Notice:</strong> Instruction for Physicians, Nurse
                                and
                                Midwives: Make sure that the client is not pregnant by using the
                                questions
                                listed in SIDE B. Completely fill out or check the required
                                information.
                                Refer accordingly for any abnormal history/findings for further
                                medical
                                evaluation.
                            </div>
                            <div id="print_content">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="container">
                                            <!-- Personal Information -->
                                            <section class="mb-4">
                                                <h4>Family Planning Client Assessment Record</h4>
                                                <hr>


                                                <div class="row mb-3">
                                                    <div class="col-md-2 mb-3">
                                                        <label for="age" class="form-label">Record ID</label>
                                                        <input type="text" class="form-control" name="record_id"
                                                            value="<?php echo $id ?>" readonly>
                                                            <input type="text" hidden class="form-control" id="patient_id"  name="patient_id" readonly>
                                                    </div>
                                                    <div class="col-md-5 mb-3">
                                                            <label class="form-label">Full
                                                                Name</label>
                                                            <select class='form-select col-md-10 patient_name'
                                                                name='patient_name' id='patient_name'>
                                                                <option disabled="disabled" selected="selected">Select
                                                                    Patient</option>
                                                                <?php
                                                                // Retrieve customer names from the coffee_customer table
                                                                $sql = "SELECT * FROM patient_record";
                                                                $result = mysqli_query($con, $sql);
                                                                if ($result) {
                                                                    while ($row = mysqli_fetch_assoc($result)) {
                                                                        $pat_id = $row['patient_id'];
                                                                        $name = $row['Name'];
                                                                        $birthDate = $row['DateOfBirth'];
                                                                        $address = $row['Address'];
                                                                        $profilepic = $row['ProfilePicture'];
                                                                        $contact = $row['ContactNumber'];

                                                                        $ave_monthIncome = $row['ave_monthIncome'];
                                                                        $philhealth = $row['philhealth'];


                                                                        $spouse_name = $row['spouse_name'];
                                                                        $spouse_birthdate = $row['spouse_birthdate'];
                                                                        $spouse_occupation = $row['spouse_occupation'];

                                                                        echo "<option value='$pat_id' 
                                                                    data-name='$name' 
                                                                    data-id='$pat_id' 
                                                                    data-profilepic='$profilepic' 
                                                                    data-birthdate='$birthDate' 
                                                                    data-address='$address' 
                                                                    data-contact='$contact'
                                                                    data-ave_monthIncome='$ave_monthIncome' 
                                                                    data-philhealth='$philhealth'
                                                                    data-spouse_name='$spouse_name' 
                                                                    data-spouse_birthdate='$spouse_birthdate'
                                                                    data-spouse_occupation='$spouse_occupation'>
                                                                    $name </option>";
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
                                                    <div class="col-md-2 mb-3">
                                                        <label for="age" class="form-label">Age</label>
                                                        <input type="text" class="form-control" name="age" id="age"
                                                            readonly>
                                                    </div>
                                                </div>

                                                <div class="row mb-3">
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

                                                <div class="row mb-3">
                                                    <div class="col-md-4 mb-3">
                                                        <label for="spouse_name" class="form-label">Spouse Name:</label>
                                                        <input type="text" class="form-control" id="spouse_name"
                                                            name="spouse_name" placeholder="Spouse Name">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="spouse_date" class="form-label">Birthdate:</label>
                                                        <input type="date" class="form-control" id="spouse_date"
                                                            name="spouse_date">
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <label for="spouse_occupation"
                                                            class="form-label">Occupation:</label>
                                                        <input type="text" class="form-control" id="spouse_occupation"
                                                            name="spouse_occupation" placeholder="Enter Occupation">
                                                    </div>

                                                </div>

                                            </section>



                                            <?php include('form/fp.form.php') ?>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<?php include('modal/fp_modal.php') ?>
</html>
<script>
    $(document).ready(function () {
        $('#patient_name').on('change', function () {

            var id = $(this).find('option:selected').data('id');

            console.log(id);


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
            $('#patient_id').val(id);

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

        var table = $('#check_trans_table').DataTable({
            dom: '<"top"<"left-col"B><"center-col"f>>lrtip',
            order: [
                [1, 'desc']
            ],
            buttons: [
                'excelHtml5',
                'pdfHtml5',
                'print'
            ],
            columnDefs: [{
                orderable: false,
                targets: -1
            }],
            lengthChange: false,
            orderCellsTop: true,
            paging: false,
            info: false,
            initComplete: function () {
                this.api().columns([4]).every(function () {
                    var column = this;
                    $('#filterPayee').on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
                        column.search(val ? '^' + val + '$' : '', true, false).draw();
                    });
                });
            }
        });


        $(document).on('click', '#confirmRecord', function (e) {
            // Prevent the default form submission
            e.preventDefault();

            // Set the form action to the desired URL
            $('#familyplanning_form').attr('action', 'function/fp.save.php');

            // Submit the form asynchronously using AJAX
            $.ajax({
                type: "POST",
                url: $('#familyplanning_form').attr('action'),
                data: $('#familyplanning_form').serialize(),
                success: function (response) {
                    if (response.trim() === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Success',
                            text: 'Record completed!',
                        });

                        // Set all inputs to readonly
                        var selectElement = document.getElementById('patient_name');
                        $(selectElement).chosen('destroy');

                        $('#familyplanning_form input').prop('readonly', true); // This will set readonly for text inputs
                        $('#familyplanning_form textarea').prop('readonly', true); // This will set readonly for textarea
                        $('#familyplanning_form select').prop('disabled', true); // This will disable select elements

                        // Disable radio buttons and checkboxes
                        $('#familyplanning_form input[type="radio"]').prop('disabled', true);
                        $('#familyplanning_form input[type="checkbox"]').prop('disabled', true);

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


        $(document).on('click', '.btnPrint', function (e) {
            if (!$('#spouse_name').prop('readonly')) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Incomplete Form',
                    text: 'Please complete the form before printing.',
                });
                return;
            }

            console.log('Printing...');

            // Temporarily hide the buttons and adjust styles for printing
            $("#print_content button").hide();
            $("#print_content").css({ "margin": "0", "padding": "0" }); // Adjust as needed

            html2canvas(document.querySelector("#print_content"), {
                scale: 1, // Adjust scale as needed to fit content
                windowHeight: document.documentElement.offsetHeight, // Adjust window height
                windowWidth: document.documentElement.offsetWidth // Adjust window width
            }).then(canvas => {
                var myImage = canvas.toDataURL("image/png");
                var tWindow = window.open("");
                $(tWindow.document.body).css({ "margin": "0", "padding": "0" }); // Reset styles in new window
                $(tWindow.document.body)
                    .html("<img id='Image' src=" + myImage + " style='width:100%;'></img>")
                    .ready(function () {
                        tWindow.focus();
                        tWindow.print();
                    });

                // Revert styles and show the buttons again
                $("#print_content").css({ "margin": "", "padding": "" }); // Revert back to original styles
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

            // Enable checkboxes and radio buttons
            $('#print_content').find('input[type="checkbox"], input[type="radio"]').prop('disabled', false);

            // Enable the 'patient_name' Chosen.js select and update it
            $('#patient_name').prop('disabled', false).trigger('chosen:updated');
            $('#print_content').find('select').prop('disabled', false);

            // Remove hidden inputs added for disabled selects except for 'patient_name'
            $('#print_content').find('select:not(#patient_name)').each(function () {
                $(this).next('input[type="hidden"]').remove();
            });
        }

        function makeReadOnly() {
            var prenatalRecordStatus = '<?php echo $record['status']; ?>';
            if (prenatalRecordStatus === 'Completed') {
                $('#print_content').find('input, textarea').attr('readonly', true);
                $('#print_content').find('select').prop('disabled', true);

                // Disable checkboxes and radio buttons
                $('#print_content').find('input[type="checkbox"], input[type="radio"]').prop('disabled', true);

                // Add hidden inputs for disabled selects
                $('#print_content').find('select').each(function () {
                    var name = $(this).attr('name');
                    var value = $(this).val();
                    $(this).after('<input type="hidden" name="' + name + '" value="' + value + '">');
                });
            }
        }


        makeReadOnly();




    });
</script>