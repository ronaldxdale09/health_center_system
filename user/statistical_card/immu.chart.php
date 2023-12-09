<?php
$query = "SELECT 
DATE_FORMAT(dateRecording, '%Y-%m') as MonthYear, 
immunizationType, 
COUNT(*) as Count
FROM 
immunization_status
GROUP BY 
DATE_FORMAT(dateRecording, '%Y-%m'), immunizationType
ORDER BY 
MonthYear";

$result = mysqli_query($con, $query);

$immunizationData = [];
$allTypes = [];
while ($row = mysqli_fetch_assoc($result)) {
    $monthYear = DateTime::createFromFormat('Y-m', $row['MonthYear'])->format('F Y'); // Convert to 'Month Year' format
    $immunizationData[$monthYear][$row['immunizationType']] = $row['Count'];
    $allTypes[$row['immunizationType']] = 0;
}

$labels = array_keys($immunizationData);
$datasets = array_fill_keys(array_keys($allTypes), []);

foreach ($immunizationData as $monthYear => $types) {
    foreach ($allTypes as $type => $value) {
        $datasets[$type][] = $types[$type] ?? 0;
    }
}
?>




<script>
    // Fetch PHP data into JavaScript
       // Fetch PHP data into JavaScript
       var labels = <?php echo json_encode($labels); ?>;
    var datasetsData = <?php echo json_encode($datasets); ?>;

    // Prepare datasets for the chart
    var datasets = [];
    var colors = [
    'rgba(255, 99, 132, 0.6)',  // Red
    'rgba(54, 162, 235, 0.6)',  // Blue
    'rgba(75, 192, 192, 0.6)',  // Green
    'rgba(255, 206, 86, 0.6)',  // Yellow
    'rgba(153, 102, 255, 0.6)', // Purple
    'rgba(255, 159, 64, 0.6)',  // Orange
    // ... Add more unique colors as needed
];    Object.keys(datasetsData).forEach(function (type, index) {
        datasets.push({
            label: type,
            data: datasetsData[type],
            backgroundColor: colors[index % colors.length] // Assign color to each dataset
        });
    });

    var ctx = document.getElementById('immunizationTrendChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: datasets
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    <?php
    $typeDistributionSQL = "SELECT 
                            immunizationType, 
                            COUNT(*) as Count
                        FROM 
                            immunization_status
                        GROUP BY 
                            immunizationType";

    $typeResults = mysqli_query($con, $typeDistributionSQL);
    $typeData = [];

    while ($row = mysqli_fetch_assoc($typeResults)) {
        $typeData[$row['immunizationType']] = $row['Count'];
    }
    ?>




    // Immunization Type Distribution Chart
    var typeData = <?php echo json_encode($typeData); ?>;
    var typeCtx = document.getElementById('typeDistributionChart').getContext('2d');
    new Chart(typeCtx, {
        type: 'pie',
        data: {
            labels: Object.keys(typeData),
            datasets: [{
                label: 'Immunization Count',
                data: Object.values(typeData),
                backgroundColor: [
                    'rgba(255, 179, 186, 0.8)', // pastel red
                    'rgba(179, 205, 224, 0.8)', // pastel blue
                    'rgba(182, 255, 187, 0.8)', // pastel green
                    'rgba(255, 223, 186, 0.8)', // pastel orange
                    'rgba(221, 179, 255, 0.8)', // pastel purple
                    'rgba(255, 255, 186, 0.8)'  // pastel yellow
                ]
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom',
                    display: true
                }
            },
            aspectRatio: 2,
        }
    });

</script>