<script>

    <?php
    $currentYear = date('Y');
    $recordCountSql = "SELECT MONTH(date_checkup) as month, COUNT(*) as record_count FROM prenatal_record WHERE YEAR(date_checkup) = $currentYear GROUP BY MONTH(date_checkup) ORDER BY MONTH(date_checkup)";
    $recordCountQuery = mysqli_query($con, $recordCountSql);

    $monthlyRecordCounts = array_fill(0, 12, 0); // Initialize array for all months
    while ($row = mysqli_fetch_assoc($recordCountQuery)) {
        $monthlyRecordCounts[$row['month'] - 1] = $row['record_count'];
    }

    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    ?>




        var ctx = document.getElementById('prenatalRecordChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Prenatal Records per Month',
                    data: <?php echo json_encode($monthlyRecordCounts); ?>,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1 // Assumes integer values
                        }
                    }
                }
            }
        });
        <?php
        // Fetching total abortions
        $abortion_sql = "SELECT SUM(abortion) as total_abortion FROM prenatal_record";
        $abortion_result = mysqli_query($con, $abortion_sql);
        $abortion_row = mysqli_fetch_assoc($abortion_result);
        $total_abortion = $abortion_row['total_abortion'];

        // Fetching total parities
        $parity_sql = "SELECT SUM(para_no) as total_parity FROM prenatal_record";
        $parity_result = mysqli_query($con, $parity_sql);
        $parity_row = mysqli_fetch_assoc($parity_result);
        $total_parity = $parity_row['total_parity'];
        ?>

        var abortion_ctx = document.getElementById('abortionParityChart').getContext('2d');
        new Chart(abortion_ctx, {
            type: 'pie',
            data: {
                labels: ['Total Abortions', 'Total Parities'],
                datasets: [{
                    label: 'Distribution of Abortions vs. Parity',
                    data: [<?php echo $total_abortion; ?>, <?php echo $total_parity; ?>],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.6)',
                        'rgba(54, 162, 235, 0.6)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                plugins: {
                    title: {
                        display: true,
                        text: 'This chart compares the total number of abortions to the total number of pregnancies (parity).',
                        font: {
                            size: 18,
                            weight: 'bold'
                        }
                    },
                    legend: {
                        position: 'bottom',
                        display: true
                    }
                },
                aspectRatio: 2,
            }
        });

</script>