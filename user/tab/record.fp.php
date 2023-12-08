<?php
                        // SQL query to select relevant family planning data
                        $sql = "SELECT family_planning_rec.*, patient_record.Name FROM family_planning_rec
                        LEFT JOIN patient_record ON family_planning_rec.patient_id = patient_record.patient_id
                        WHERE (family_planning_rec.patient_id !='' || family_planning_rec.patient_id=NULL) AND family_planning_rec.patient_id=$id";
                        $results = mysqli_query($con, $sql);

                        // Check for SQL errors
                        if (!$results) {
                            die("SQL error: " . mysqli_error($con));
                        }
                        ?>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped" id='family_record'>
        <thead class="table-dark text-center">
            <tr>
                <th scope="col">FP ID</th>
                <th scope="col">Patient Name</th>
                <th scope="col">Date of Recording</th>
                <th scope="col">Height</th>
                <th scope="col">Weight</th>
                <th scope="col">Blood Pressure</th>
                <th scope="col">Number of Pregnancies</th>
                <th scope="col">Last Delivery Date</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <td>
                        <?php echo $row['fp_id'] ?>
                    </td>
                    <td>
                        <?php echo $row['Name'] ?>
                    </td>
                    <td>
                        <?php echo date('M j, Y', strtotime($row['dateRecording'])); ?>
                    </td>
                    <td>
                        <?php echo $row['height'] ?>
                    </td>
                    <td>
                        <?php echo $row['weight'] ?>
                    </td>
                    <td>
                        <?php echo $row['blood_pressure'] ?>
                    </td>
                    <td>
                        <?php echo $row['number_of_pregnancies'] ?>
                    </td>
                    <td>
                        <?php echo $row['date_of_last_delivery'] ? date('M j, Y', strtotime($row['date_of_last_delivery'])) : 'N/A'; ?>
                    </td>
                    <td>
                        <a href="family_planning.php?id=<?php echo $row['fp_id'] ?>" class='btn btn-dark btn-sm'>View</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>