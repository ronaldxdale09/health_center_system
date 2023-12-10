<?php
// SQL query to select relevant immunization data
$sql = "SELECT immunization.*, patient_record.Name, patient_record.DateOfBirth, 
        GROUP_CONCAT(immunization_status.immunizationType) as ImmunizationTypes 
        FROM immunization
        LEFT JOIN patient_record ON immunization.patient_id = patient_record.patient_id
        LEFT JOIN immunization_status ON immunization.immunization_id = immunization_status.immunization_id
        WHERE (immunization.patient_id !='' || immunization.patient_id=NULL) and immunization.patient_id = $id
        GROUP BY immunization.immunization_id";

$results = mysqli_query($con, $sql);

// Check for SQL errors
if(!$results) {
    die("SQL error: ".mysqli_error($con));
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
            <?php while($row = mysqli_fetch_array($results)) { ?>
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
<script>
    var table = $('#immunization_record').DataTable({
        dom: 'Bfrtip',
        buttons: ['excelHtml5', 'pdfHtml5', 'print']
    });
</script>