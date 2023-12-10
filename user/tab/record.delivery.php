<?php
// SQL query to select relevant delivery data
$sql = "SELECT delivery_record.*, patient_record.Name FROM delivery_record 
                        LEFT JOIN patient_record ON delivery_record.patient_id = patient_record.patient_id
                        WHERE (delivery_record.patient_id !='' || delivery_record.patient_id=NULL)
                        and delivery_record.patient_id=$id";
$results = mysqli_query($con, $sql);

// Check for SQL errors
if (!$results) {
    die("SQL error: " . mysqli_error($con));
}
?>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='delivery_record'>
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">Delivery ID</th>
                <th scope="col">Date Recording</th>

                <th scope="col">Patient Name</th>
                <th scope="col">Date Time Coming</th>
                <th scope="col">Date Time Delivery</th>
                <th scope="col">Baby Gender</th>
                <th scope="col">Gravida</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td>
                        <?php echo $row['delivery_id'] ?>
                    </td>
                    <td>
                        <?php echo !empty($row['dateRecording']) ? date('M j, Y', strtotime($row['dateRecording'])) : '-'; ?>
                    </td>
                    <td>
                        <?php echo $row['Name'] ?>
                    </td>
                    <td>
                        <?php echo date('M j, Y g:i A', strtotime($row['dateTimeComing'])); ?>
                    </td>
                    <td>
                        <?php echo date('M j, Y g:i A', strtotime($row['dateTimeDelivery'])); ?>
                    </td>
                    <td>
                        <?php echo $row['baby_gender'] ?>
                    </td>
                    <td>
                        <?php echo $row['gravida'] ?>
                    </td>
                    <td>
                        <a href="delivery.php?id=<?php echo $row['delivery_id'] ?>" class='btn btn-dark btn-sm'>Record</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    var table = $('#delivery_record').DataTable({
        dom: 'Bfrtip',
        buttons: ['excelHtml5', 'pdfHtml5', 'print']
    });
</script>