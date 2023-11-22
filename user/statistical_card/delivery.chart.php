<script>


    <?php
    $currentYear = date('Y');
    $delivery_sql = "SELECT MONTH(dateRecording) as month, COUNT(*) as monthly_deliveries FROM delivery_record WHERE YEAR(dateRecording) = $currentYear GROUP BY MONTH(dateRecording) ORDER BY MONTH(dateRecording)";
    $delivery_query = mysqli_query($con, $delivery_sql);

    $monthlyDeliveries = array_fill(0, 12, 0);
    while ($row = mysqli_fetch_assoc($delivery_query)) {
        $monthlyDeliveries[$row['month'] - 1] = $row['monthly_deliveries'];
    }

    $months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    ?>




    document.addEventListener("DOMContentLoaded", function () {

        var ctx = document.getElementById('deliveryTrendChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($months); ?>,
                datasets: [{
                    label: 'Monthly Deliveries',
                    data: <?php echo json_encode($monthlyDeliveries); ?>,
                    borderColor: '#007bff',
                    fill: false
                }]
            },
            options: {
                // ... your chart options
            }
        });

        <?php
        $gender_sql = "SELECT baby_gender, COUNT(*) as count FROM delivery_record GROUP BY baby_gender";
        $gender_query = mysqli_query($con, $gender_sql);

        $genderData = [];
        while ($row = mysqli_fetch_assoc($gender_query)) {
            $genderData[$row['baby_gender']] = $row['count'];
        }
        ?>

        var ctx = document.getElementById('genderDistributionChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: Object.keys(<?php echo json_encode($genderData); ?>),
                datasets: [{
                    label: 'Gender Distribution',
                    data: Object.values(<?php echo json_encode($genderData); ?>),
                    backgroundColor: ['#4E79A7', '#F28E2B'],
                    borderColor: ['#4E79A7', '#F28E2B'],
                    borderWidth: 1
                }]
            },
            options: {
                // ... your chart options
            }
        });

    });
</script>