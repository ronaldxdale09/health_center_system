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
                        <?php include('statistical_card/dashboard_card.php'); ?>
                        <h2 class="page-title">
                            <b>
                                <font color="#046D56"> DASHBOARD </font>
                            </b>
                        </h2>
                        <br>
                        <div class="card">
                            <div class="card-body">
                                <?php
                                // SQL query to select relevant patient data
                                $sql = "SELECT * FROM patient_record";
                                $results = mysqli_query($con, $sql);

                                // Check for SQL errors
                                if (!$results) {
                                    die("SQL error: " . mysqli_error($con));
                                }
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover table-striped" id='patient_record'>
                                        <thead class="table-dark text-center">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Contact #</th>
                                                <th scope="col">Gender</th>
                                                <th scope="col">DOB</th>
                                                <th scope="col">Blood Type</th>
                                                <th scope="col">Emergency Contact</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php while ($row = mysqli_fetch_array($results)) { ?>
                                                <tr>
                                                    <td><span class="badge bg-warning text-dark"><?php echo $row['patient_id'] ?></span></td>
                                                    <td><?php echo $row['Name'] ?></td>
                                                    <td><?php echo $row['ContactNumber'] ?></td>
                                                    <td><?php echo $row['Gender'] ?></td>
                                                    <td><?php echo $row['DateOfBirth'] ?></td>
                                                    <td><?php echo $row['BloodType'] ?></td>
                                                    <td><?php echo $row['EmergencyContact'] ?></td>
                                                    <td><?php echo $row['Address'] ?></td>
                                                    <td>
                                                        <a href="patient_record.php?id=<?php echo $row['patient_id'] ?>" class='btn btn-dark btn-sm'> Record</button>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <br> 
                    </div>
                 

                    <!-- Canvas for Chart.js -->
                    <div class="row">
                        <!-- Monthly Patient Admissions Bar Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Monthly Patient Admissions</h5>
                                    <canvas id="patientsChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Patients Recovery Trend Line Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Monthly Prenatal Trend</h5>
                                    <canvas id="recoveryChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Types of Treatments Administered Doughnut Chart -->
                        
                    </div>


                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        $(document).ready(function() {
            var table = $('#patientTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'pdfHtml5', 'print']
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {




            // Bar Chart
            var ctxBar = document.getElementById('patientsChart').getContext('2d');
            new Chart(ctxBar, {
                // Configuration for Bar Chart...
            });

            // Line Chart
            var ctxLine = document.getElementById('recoveryChart').getContext('2d');
            new Chart(ctxLine, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May'],
                    datasets: [{
                        label: 'Recovery Trend',
                        data: [5, 15, 8, 18, 25],
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            // Doughnut Chart
            var ctxDoughnut = document.getElementById('treatmentChart').getContext('2d');
            new Chart(ctxDoughnut, {
                type: 'doughnut',
                data: {
                    labels: ['Surgery', 'Medication', 'Therapy'],
                    datasets: [{
                        data: [30, 45, 25],
                        backgroundColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(153, 102, 255, 1)'
                        ]
                    }]
                },
            })
        });
    </script>


    <script>
        $('.btnUpdate').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#customer_id').val(data[0]);
            $('#name').val(data[1]);
            $('#address').val(data[2]);
            $('#contact').val(data[3].replace(/[^0-9.]/g, ''));

            $('#updateCustomer').modal('show');


        });

        $('.confirmDelete').on('click', function() {
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();

            $('#d_customer_id').val(data[0]);

            $('#deleteCustomer').modal('show'); // Close the modal
        });


        $(document).ready(function() {
            var table = $('#customerTable').DataTable({
                dom: '<"top"<"left-col"B><"center-col"f>>rti<"bottom"p><"clear">',
                order: [
                    [0, 'desc']
                ],
                buttons: [{
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7]
                        }
                    }
                ],
                lengthMenu: [
                    [-1],
                    ["All"]
                ],
                orderCellsTop: true,
                paging: false, // Disable pagination
                infoCallback: function(settings, start, end, max, total, pre) {
                    return total + ' entries';
                }
            });
        });
    </script>

</body>

</html>