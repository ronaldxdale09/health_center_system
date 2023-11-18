<?php

include('include/header.php');
include('include/navbar.php');


?>


<body>
    <style>
        .card-header {
            font-family: 'Arial', sans-serif;
            /* Use a modern, clean font */
            font-size: 20px;
            /* Slightly larger font size */
            font-weight: 800;
            /* Semi-bold weight */
            color: #333333;
            /* Darker text color */
            text-align: center;
            /* Centered text */
            text-transform: uppercase;
            /* Uppercase letters */
            margin-bottom: 15px;
            /* Space below the header */
            border-bottom: 2px solid #f0f0f0;
            /* Underline with a light color */
            padding-bottom: 10px;
            /* Padding below the text */
        }

        .card-title1 span {
            color: #046D56;
        }

        .card-theme2 {
            background-color: #FAE5E7;
        }

        .card-title2,
        .card-title3 {
            color: #020a4f;
        }

        .card-title2 span,
        .card-title3 span {
            color: #47020e;
        }

        .chart-section-header {
            margin-top: 30px;
            /* Adjust the value as per your spacing preference */
        }
    </style>
    <div class='main-content' style='position:relative;'>
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
                    </div>

                    <h4 class="card-header card-title3 chart-section-header">PRENATAL RECORD <span>CHARTS</span></h4>
                    <!-- Canvas for Chart.js -->
                    <div class="row">
                        <!-- Monthly Patient Admissions Bar Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Prenatal Trends Over Time</h5>
                                    <canvas id="prenatalRecordChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Patients Recovery Trend Line Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Distribution of Abortions vs. Parity</h5>
                                    <canvas id="abortionParityChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h4 class="card-header card-title3 chart-section-header">DELIVERY RECORD <span>CHARTS</span></h4>
                    <!-- Canvas for Chart.js -->
                    <div class="row">
                        <!-- Monthly Patient Admissions Bar Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Delivery Trends Over Time</h5>
                                    <canvas id="deliveryTrendChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>

                        <!-- Patients Recovery Trend Line Chart -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Baby Gender Distribution</h5>
                                    <canvas id="genderDistributionChart" width="400" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#patientTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'pdfHtml5', 'print']
            });
        });
    </script>
    <?php include('statistical_card/prenatal.chart.php'); ?>

    <?php include('statistical_card/delivery.chart.php'); ?>




</body>

</html>