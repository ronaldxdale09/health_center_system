<?php
// SQL query to select relevant immunization data
$sql = "SELECT immunization.immunization_id, 
                        immunization.patient_id, 
                        immunization.bcg_date_1, 
                        immunization.pentavalent_date_1, 
                        immunization.opv_date_1, 
                        immunization.ipv_date_1,
                        immunization.pneumococcal_date_1, 
                        immunization.mmr_date_1, 
                        patient_record.Name, 
                        patient_record.DateOfBirth
                                FROM immunization
            LEFT JOIN patient_record ON immunization.patient_id = patient_record.patient_id WHERE patient_record.patient_id = $id";

$results = mysqli_query($con, $sql);

// Check for SQL errors
if (!$results) {
    die("SQL error: " . mysqli_error($con));
}
?> <br>
<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='immunization_record'>
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">Immunization ID</th>
                <th scope="col">Patient ID</th>
                <th scope="col">BCG Date</th>
                <th scope="col">Pentavalent Date</th>
                <th scope="col">OPV Date</th>
                <th scope="col">IPV Date</th>
                <th scope="col">Pneumococcal Date</th>
                <th scope="col">MMR Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td><span class="badge bg-warning text-dark">
                            <?php echo $row['immunization_id'] ?>
                        </span></td>
                    <td>
                        <?php echo $row['Name'] ?>
                    </td>
                    <td>
                        <?php echo ($row['bcg_date_1'] == '0000-00-00' || $row['bcg_date_1'] == null) ? '-' : $row['bcg_date_1'] ?>
                    </td>
                    <td>
                        <?php echo ($row['pentavalent_date_1'] == '0000-00-00' || $row['pentavalent_date_1'] == null) ? '-' : $row['pentavalent_date_1'] ?>
                    </td>
                    <td>
                        <?php echo ($row['opv_date_1'] == '0000-00-00' || $row['opv_date_1'] == null) ? '-' : $row['opv_date_1'] ?>
                    </td>
                    <td>
                        <?php echo ($row['ipv_date_1'] == '0000-00-00' || $row['ipv_date_1'] == null) ? '-' : $row['ipv_date_1'] ?>
                    </td>
                    <td>
                        <?php echo ($row['pneumococcal_date_1'] == '0000-00-00' || $row['pneumococcal_date_1'] == null) ? '-' : $row['pneumococcal_date_1'] ?>
                    </td>
                    <td>
                        <?php echo ($row['mmr_date_1'] == '0000-00-00' || $row['mmr_date_1'] == null) ? '-' : $row['mmr_date_1'] ?>
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