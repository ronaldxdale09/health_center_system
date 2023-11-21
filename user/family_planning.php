<?php
include('include/header.php');
include('include/navbar.php');

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



                    $('input[name=\"patient_id\"]').val('" . $record['patient_id'] . "');
            

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
                        <div class="row mb-3">

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
                        </div>


                        <form id="familyplanning_form" action="" method="post">
                            <div class="card">
                                <div class="card-body">
                                    <div class="container">
                                        <!-- Personal Information -->
                                        <section class="mb-4">
                                            <h4>Family Planning Client Assessment Record</h4>
                                            <hr>
                                            <div class="alert alert-secondary alert-dismissible fade show">
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                                <strong>Important Notice:</strong> Instruction for Physicians, Nurse and
                                                Midwives: Make sure that the client is not pregnant by using the
                                                questions
                                                listed in SIDE B. Completely fill out or check the required information.
                                                Refer accordingly for any abnormal history/findings for further medical
                                                evaluation.
                                            </div>

                                            <div class="row mb-3">
                                                <div class="col-md-2 mb-3">
                                                    <label for="age" class="form-label">Record ID</label>
                                                    <input type="text" class="form-control" name="record_id"
                                                        value="<?php echo $id ?>" readonly>
                                                </div>
                                                <div class="col-md-5 mb-3">
                                                    <label for="fullName" class="form-label">Full Name</label>
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
                                                    <input type="text" class="form-control" name="address" id="address"
                                                        readonly>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label for="contactNumber" class="form-label">Contact Number</label>
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

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>


<script>
    $(document).ready(function () {
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
                            text: 'Sale transaction completed!',
                        });

                        // Set all inputs to readonly
                        var selectElement = document.getElementById('patient_name');
                        $(selectElement).chosen('destroy');

                        $('#familyplanning_form input').prop('readonly', true);
                        $('#familyplanning_form textarea').prop('readonly', true);
                        $('#familyplanning_form select').prop('disabled', true); //use 'disabled' for select elements
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

    });
</script>