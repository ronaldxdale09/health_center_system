<?php
include('../../function/db.php');

$immunization_id = $_POST['immunization_id'];

// Query to get the data from the database
$query = "SELECT * FROM immunization_status WHERE immunization_id = '$immunization_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}



$immuTypes = [
    'BCG Vaccine',
    'Pentavalent',
    'Oral Polio',
    'Inactivated Polio',
    'Pneumococcal',
    'Measles, Mumps, Rubella'
];

$output = '
<table class="table table-hover table-bordered table-striped" id="phs_table">
    <thead class="table-success">
        <tr>
        <th hidden></th>

            <th class="text-center" style="font-weight:bold;">Type</th>
            <th class="text-center" style="font-weight:bold;">Doses</th>
            <th class="text-center" style="font-weight:bold;">Date</th>
            <th class="text-center" style="font-weight:bold;">Weight</th>
            <th class="text-center" style="font-weight:bold;">Remarks</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';
while ($row = mysqli_fetch_assoc($result)) {

    $selectType .= '<td><select class="form-control type" name="type[]" autocomplete="off" step="any">';
    foreach ($immuTypes as $type) {
        if ($type == $row['bales_type']) {
            $output .= '<option selected="selected" value="' . $type . '">' . $type . '</option>';
        } else {
            $output .= '<option value="' . $type . '">' . $type . '</option>';
        }
    }
    $selectType .= '</select></td>';



    $output .= '
            <tr>
            <td hidden><input type="text" class="form-control phs_id " name="phs_id[]" value="' . htmlspecialchars($row['phs_id']) . '"></td>
            <td>' . $selectType . '</td>
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
        <td>
            <select class="form-control type" name="type[]" autocomplete="off" step="any">
                <option selected="selected" disabled value="" style="font-weight:normal;">Choose Type </option>
                <option value="BCG Vaccine" style="font-weight:normal;">BCG Vaccine </option>
                <option value="Pentavalent" style="font-weight:normal;">Pentavalent </option>
                <option value="Oral Polio" style="font-weight:normal;">Oral Polio </option>
                <option value="Inactivated Polio" style="font-weight:normal;">Inactivated Polio </option>
                <option value="Pneumococcal" style="font-weight:normal;">Pneumococcal </option>
            </select>
        </td>
          
        <td>
            <select class="form-control type" name="type[]" autocomplete="off" step="any">
                <option selected="selected" disabled value="" style="font-weight:normal;">Choose Type </option>
                <option value="At Birth" style="font-weight:normal;">At Birth </option>
                <option value="1½" style="font-weight:normal;">1½ </option>
                <option value="Oral Polio" style="font-weight:normal;">Oral Polio </option>
                <option value="Inactivated Polio" style="font-weight:normal;">Inactivated Polio </option>
                <option value="Pneumococcal" style="font-weight:normal;">Pneumococcal </option>
            </select>
        </td>
            <td>
                <div class="input-group">
                    <input type="date" class="form-control" name="fundic_height[]">
                    
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" class="form-control" name="gestational_age[]">
                    <div class="input-group-append">
                        <span class="input-group-text">kg</span>
                    </div>
                </div>
            </td>
       
            <td>
                <div class="input-group">
                    <input type="text" class="form-control" name="remarks[]">
                   
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