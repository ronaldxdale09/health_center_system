<?php
include('include/header.php');
include('include/navbar.php');

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
                                    id="confirmSales"><span class="fas fa-check"></span> Save Record</button>
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
                                    <!-- Personal Information -->
                                    <section class="mb-4">
                                        <h4>Family Planning Client Assessment Record</h4>
                                        <hr>
                                        <div class="alert alert-secondary alert-dismissible">
                                            <a href="#" class="btn close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                                            <strong>Important Notice:</strong>
                                            Instruction for Physicians, Nurse and Midwives: Make sure that the clientt
                                            is not pregnent by using the questions listed in SIDE B. Completely fill out
                                            or check the required information. Refer accordingly for any abnormal
                                            history/findings for further medical evaluation
                                        </div>
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
                                            <div class="row">
                                                <div class="col">
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
                                        </div>
                                        <br>

                                    </section>


                                    <?php include('form/fp.form.php') ?>

                                </div>

                            </div>
                        </div>
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

            let today = new Date();
            let birthDate = new Date(selectedBirthDate);
            let age = today.getFullYear() - birthDate.getFullYear();

            // Adjust age if the birthdate has not been reached in the current year
            if (today.getMonth() < birthDate.getMonth() ||
                (today.getMonth() == birthDate.getMonth() && today.getDate() < birthDate.getDate())) {
                age--;
            }

            $('#age').val(age);
            $('#address').val(selectedAddress);
            $('#birth_date').val(selectedBirthDate);
            $('#contactNumber').val(selectedContact);
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




    });
</script>