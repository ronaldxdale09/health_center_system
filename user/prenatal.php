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
                        <font color="#0C0070">PRENATAL </font>
                        <font color="#046D56"> RECORD </font>
                    </b>
                </h2>
                <br>
                <div class="card">
                    <div class="card-body">

                        <div class="mb-3">

                            <!-- Button for New Cheque -->
                            <div class="row mb-3">
                                <div class="col-12">
                                    <button type="button" class="btn btn-sm btn-dark text-white" data-toggle="modal"
                                        data-target="#newPrenatalRecord">
                                        <i class="fa fa-add" aria-hidden="true"></i> NEW RECORD
                                    </button>

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
                                    <label for="startDate">Estimated Date of Confinement:</label>
                                    <select id="edcFilter" class="form-control">
                                        <option value="">All</option>
                                        <?php
                                        for ($i = 1; $i <= 12; $i++) {
                                            echo '<option value="' . $i . '">' . date("F", mktime(0, 0, 0, $i, 10)) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-3 mb-3">
                                    <label for="confinmentFilterYear">Year of Confinement:</label>
                                    <select id="confinmentFilterYear" class="form-control">
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

                        // SQL query to select the latest prenatal health status data
                        $sql = "SELECT pr2.Name,pr.*, phs.blood_pressure, phs.weight, phs.gestational_age
                            FROM prenatal_record pr
                            LEFT JOIN patient_record pr2 on pr.patient_id = pr2.patient_id
                            LEFT JOIN (
                                SELECT phs.*
                                FROM prenatal_health_status phs
                                INNER JOIN (
                                    SELECT prenatal_id, MAX(healthCheck_date) as latestDate
                                    FROM prenatal_health_status
                                    GROUP BY prenatal_id
                                ) latestPHS ON phs.prenatal_id = latestPHS.prenatal_id AND phs.healthCheck_date = latestPHS.latestDate
                            ) phs ON pr.prenatal_id = phs.prenatal_id
                            
                            WHERE pr.patient_id !='' || pr.patient_id=NULL";

                        $results = mysqli_query($con, $sql);

                        // Check for SQL errors
                        if (!$results) {
                            die("SQL error: " . mysqli_error($con));
                        }
                        ?>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id='prenatal_record'>
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th scope="col">Prenatal ID</th>
                                        <th scope="col">Date Checkup</th>
                                        <th scope="col">Patient ID</th>
                                        <th scope="col">LMP</th>
                                        <th scope="col">EDC</th>
                                        <th scope="col">Blood Pressure</th>
                                        <th scope="col">Weight</th>
                                        <th scope="col">Gestational Age</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo !empty($row['prenatal_id']) ? $row['prenatal_id'] : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo !empty($row['date_checkup']) ? date('M j, Y', strtotime($row['date_checkup'])) : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo !empty($row['Name']) ? $row['Name'] : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo !empty($row['lmp']) ? date('M j, Y', strtotime($row['lmp'])) : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo !empty($row['edc']) ? date('M j, Y', strtotime($row['edc'])) : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo !empty($row['blood_pressure']) ? $row['blood_pressure'] : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo !empty($row['weight']) ? $row['weight'] : '-'; ?>
                                            </td>
                                            <td>
                                                <?php echo !empty($row['gestational_age']) ? $row['gestational_age'] : '-'; ?>
                                            </td>
                                            <td>
                                                <a href="prenatal_record.php?id=<?php echo $row['prenatal_id'] ?>"
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
            var table = $('#prenatal_record').DataTable({
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

            $('#edcFilter').on('change', function () {
                var month = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var dateIssued = new Date(data[4]); // Assuming Date Issued is the 3rd column
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

            $('#confinmentFilterYear').on('change', function () {
                var year = parseInt(this.value, 10);
                $.fn.dataTable.ext.search.push(
                    function (settings, data, dataIndex) {
                        var dateIssued = new Date(data[4]); // Assuming Date Issued is the 3rd column
                        return isNaN(year) || year === dateIssued.getFullYear();
                    }
                );
                table.draw();
                $.fn.dataTable.ext.search.pop(); // Clear this specific filter
            });

            

        });
    </script>

    <?php
    include "modal/prenatal_modal.php";
    ?>




</body>

</html>