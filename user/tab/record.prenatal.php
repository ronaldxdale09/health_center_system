<?php


// SQL query to select relevant prenatal data
$sql = "SELECT * FROM prenatal_record 
  LEFT JOIN patient_record on prenatal_record.patient_id = patient_record.patient_id
WHERE patient_record.patient_id = $id";
$results = mysqli_query($con, $sql);

// Check for SQL errors
if (!$results) {
    die("SQL error: " . mysqli_error($con));
}
?><br> <br>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='prenatal_record'>
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">Prenatal ID</th>
                <th scope="col">Date</th>

                <th scope="col">Patient ID</th>
                <th scope="col">LMP</th>
                <th scope="col">EDC</th>
                <th scope="col">Gravida</th>
                <th scope="col">Para</th>

                <th scope="col">Blood Pressure</th>
                <th scope="col">Weight</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><span class="badge bg-warning text-dark">
                            <?php echo $row['prenatal_id'] ?>
                        </span></td>

                    <td>
                        <?php echo !empty($row['date_checkup']) ? date('M j, Y', strtotime($row['date_checkup'])) : '-'; ?>
                    </td>
                    <td>
                        <?php echo $row['Name'] ?>
                    </td>
                    <td>
                        <?php echo $row['lmp'] ?>
                    </td>
                    <td>
                        <?php echo $row['edc'] ?>
                    </td>
                    <td>
                        <?php echo $row['gravida'] ?>
                    </td>
                    <td>
                        <?php echo $row['para_no'] ?>
                    </td>
                    <td>
                        <?php echo $row['blood_pressure'] ?>
                    </td>
                    <td>
                        <?php echo $row['weight'] ?>
                    </td>
                    <td>
                        <a href="prenatal_record.php?id=<?php echo $row['prenatal_id'] ?>" class='btn btn-dark btn-sm'><i
                                class='fas fa-eye'></i> Record</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<script>
    var table = $('#prenatal_record').DataTable({
        dom: 'Bfrtip',
        buttons: ['excelHtml5', 'pdfHtml5', 'print']
    });
</script>