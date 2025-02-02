<?php
include('include/header.php');
include('include/navbar.php');

?>
<style>
    /* Applies to all table headers and data cells in every table */
    table th,
    table td {
        font-size: 12px;
        /* Adjust the font size to your preference */
        padding: 8px;
        /* Padding for better spacing */
        text-align: left;
        /* Text alignment */
    }

    /* Applies to all tables */
    table {
        width: 100%;
        /* Full width */
        border-collapse: collapse;
        /* No space between borders */
        margin: 15px 0;
        /* Margin above and below for separation */
        font-size: 18px;
        /* General font size */
        text-align: left;
        /* Text alignment */
    }

    /* Style for alternate rows for better readability */
    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Hover effect for rows */
    table tr:hover {
        background-color: #ddd;
    }

    /* Button style in all tables */
    .table .btn {
        padding: 5px 10px;
        /* Adjust padding */
        font-size: 10px;
        /* Adjust font size */
        margin: 0 3px;
        /* Margin for separation */
    }
</style>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">

                <br>
                <h2 class="page-title">
                    <b>
                        <font color="#0C0070">IMMUNIZATOIN </font>
                        <font color="#046D56"> RECORD </font>
                    </b>
                </h2>
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3">

                            <!-- Button for New Cheque -->
                            <div class="row mb-3">
                                <div class="col-12">
                                  

                                    <form method='POST' action='function/immunization_function.php'>

                                        <button type="submit" name='new' class="btn btn-sm btn-dark text-white">
                                            <i class="fa fa-plus" aria-hidden="true"></i> NEW RECORD
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Filters -->
                            <div class="row">




                                <!-- Month Filter -->
                                <div class="col-md-3 mb-3">
                                    <label for="filterMonth">Month:</label>
                                    <select id="filterMonth" class="form-control">
                                        <option value="">All</option>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="filterYear">Year:</label>
                                    <select id="filterYear" class="form-control">
                                        <option value="">All</option>
                                        <?php
                                        $currentYear = date("Y");
                                        $startYear = 2022;
                                        for ($i = $startYear; $i <= $currentYear; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <!-- Date Range Filter - Start Date -->
                                <div class="col-md-3 mb-3">
                                    <label for="startDate">Start Date:</label>
                                    <input type="date" id="startDate" class="form-control">
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="endDate">End Date:</label>
                                    <input type="date" id="endDate" class="form-control">
                                </div>
                            </div>

                            <!-- Date Range Filter - End Date -->



                        </div>


                        <hr>
                        <?php
                        // SQL query to select relevant immunization data
                        $sql = "SELECT immunization.*, patient_record.Name, patient_record.DateOfBirth, 
        GROUP_CONCAT(immunization_status.immunizationType) as ImmunizationTypes 
        FROM immunization
        LEFT JOIN patient_record ON immunization.patient_id = patient_record.patient_id
        LEFT JOIN immunization_status ON immunization.immunization_id = immunization_status.immunization_id
        WHERE immunization.patient_id !='' || immunization.patient_id=NULL
        GROUP BY immunization.immunization_id";

                        $results = mysqli_query($con, $sql);

                        // Check for SQL errors
                        if (!$results) {
                            die("SQL error: " . mysqli_error($con));
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id='immunization_record'>
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th scope="col">Immunization ID</th>
                                        <th scope="col">Patient Name</th>
                                        <th scope="col">Date of Birth</th>
                                        <th scope="col">Date Recorded</th>
                                        <th scope="col">Blood Pressure</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Height</th>
                                        <th scope="col">Immunization Types</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td><span class="badge bg-warning text-dark">
                                                    <?php echo $row['immunization_id'] ?>
                                                </span></td>
                                            <td>
                                                <?php echo $row['Name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['DateOfBirth'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['dateRecording'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['bloodPressure'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['weight'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['height'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ImmunizationTypes'] ?>
                                            </td>
                                            <td>
                                                <a href="immunization.php?id=<?php echo $row['immunization_id'] ?>"
                                                    class='btn btn-dark btn-sm'>Record</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#immunization_record').DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'pdfHtml5', 'print']
            });

            $('#filterMonth').on('change', function () {
                var month = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var dateIssued = new Date(data[1]); // Assuming Date Issued is the 3rd column
                        return isNaN(month) || month === dateIssued.getMonth() + 1;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });


            $('#startDate, #endDate').on('change', function () {
                var startDate = $('#startDate').val() ? new Date($('#startDate').val()) : null;
                var endDate = $('#endDate').val() ? new Date($('#endDate').val()) : null;

                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var dateIssued = new Date(data[1]); // Assuming Date Issued is the 3rd column
                        if (startDate && dateIssued < startDate) {
                            return false;
                        }
                        if (endDate && dateIssued > endDate) {
                            return false;
                        }
                        return true;
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });
            $('#filterYear').on('change', function () {
                var year = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var dateIssued = new Date(data[1]); // Assuming Date Issued is the 3rd column
                        return isNaN(year) || year === dateIssued.getFullYear();
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });


        });
    </script>

    <?php
    include "modal/immunization_modal.php";
    ?>




</body>

</html>