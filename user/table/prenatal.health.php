<?php
include('../../function/db.php');

$prenatal_id = $_POST['prenatal_id'];

// Query to get the data from the database
$query = "SELECT * FROM prenatal_health_status WHERE prenatal_id = '$prenatal_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}

$output = '
<table class="table table-hover table-bordered table-striped" id="phs_table">
    <thead class="table-success">
        <tr>
        <th class="text-center" style="font-weight:bold;">Date</th>
        <th hidden></th>

            <th class="text-center" style="font-weight:bold;">Blood Pressure</th>
            <th class="text-center" style="font-weight:bold;">Weight</th>
            <th class="text-center" style="font-weight:bold;">Fundic Height</th>
            <th class="text-center" style="font-weight:bold;">Gestational Age</th>
            <th class="text-center" style="font-weight:bold;">Petal Heart Tone</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';
while ($row = mysqli_fetch_assoc($result)) {
    $output .= '
            <tr>
            <td hidden><input type="text" class="form-control phs_id " name="phs_id[]" value="' . htmlspecialchars($row['phs_id']) . '"></td>
            <td><input type="date" class="form-control healthCheck_date " name="healthCheck_date[]" value="' . htmlspecialchars($row['healthCheck_date']) . '"></td>

            <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="blood_pressure[]" value="' . htmlspecialchars($row['blood_pressure']) . '">
                        <div class="input-group-append">
                            <span class="input-group-text">mmHg</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="text" class="form-control" name="weight[]" value="' . htmlspecialchars($row['weight']) . '">
                        <div class="input-group-append">
                            <span class="input-group-text">kg</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control" name="fundic_height[]" value="' . htmlspecialchars($row['fundic_height']) . '">
                        <div class="input-group-append">
                            <span class="input-group-text">cm</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control" name="gestational_age[]" value="' . htmlspecialchars($row['gestational_age']) . '">
                        <div class="input-group-append">
                            <span class="input-group-text">weeks</span>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control" name="petal_heart_tone[]" value="' . htmlspecialchars($row['petalHeartTone']) . '">
                        <div class="input-group-append">
                            <span class="input-group-text">bpm</span>
                        </div>
                    </div>
                </td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
                </td>
            </tr>';
}
$output .= '
    </tbody>
</table>
<button type="button" class="btn btn-sm btn-dark" id="addStatus">+ New Status</button>';

echo $output;
?>



<script>
    $(document).ready(function () {

        $("#addStatus").click(function () {
            var newRow = `
        <tr>
        <td hidden><input type="text" class="form-control phs_id" name="phs_id[]"></td>
        <td><input type="date" class="form-control healthCheck_date" name="healthCheck_date[]"></td>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" name="blood_pressure[]">
                    <div class="input-group-append">
                        <span class="input-group-text">mmHg</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" name="weight[]">
                    <div class="input-group-append">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" class="form-control" name="fundic_height[]">
                    <div class="input-group-append">
                        <span class="input-group-text">cm</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" class="form-control" name="gestational_age[]">
                    <div class="input-group-append">
                        <span class="input-group-text">weeks</span>
                    </div>
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" class="form-control" name="petal_heart_tone[]">
                    <div class="input-group-append">
                        <span class="input-group-text">bpm</span>
                    </div>
                </div>
            </td>
            <td>
                <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
            </td>
        </tr>`;
            $("#phs_table tbody").append(newRow);
        });

        // Event delegation for dynamically created select dropdowns
        $(document).on("click", ".remove-item-line, .removeList", function (event) {
            event.preventDefault();
            $(this).closest("tr").remove();
        });

    });
</script>