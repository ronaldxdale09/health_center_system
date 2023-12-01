<?php
$query = "SELECT 
DATE_FORMAT(dateRecording, '%Y-%m') as MonthYear, 
immunizationType, 
COUNT(*) as Count
FROM 
immunization_status
GROUP BY 
MonthYear, immunizationType
ORDER BY 
MonthYear";

$result = mysqli_query($con, $query);

// Prepare data for the chart
$immunizationData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $immunizationData[$row['MonthYear']][$row['immunizationType']] = $row['Count'];
}

// Generate labels (months) and datasets for each immunization type
$labels = array_keys($immunizationData);
$datasets = [];
foreach ($immunizationData as $month => $types) {
    foreach ($types as $type => $count) {
        $datasets[$type][] = $count;
    }
}

// Ensure each dataset has a value for each month
foreach ($datasets as $type => &$counts) {
    if (count($counts) < count($labels)) {
        $counts = array_pad($counts, -count($labels), 0);
    }
}
?>

<!-- PHP for Immunization Type Distribution: -->
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


<script>
    // Fetch PHP data into JavaScript
    var labels = <?php echo json_encode($labels); ?>;
    var datasetsData = <?php echo json_encode($datasets); ?>;

    // Prepare datasets for the chart
    var datasets = [];
    Object.keys(datasetsData).forEach(function (type) {
        datasets.push({
            label: type,
            data: datasetsData[type],
            // Add more customization here (like borderColor, backgroundColor, etc.)
        });
    });

    var ctx = document.getElementById('immunizationTrendChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
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