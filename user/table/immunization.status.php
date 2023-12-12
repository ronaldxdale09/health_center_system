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
    'Tetanus Toxide',
    'Pentavalent',
    'Oral Polio',
    'Inactivated Polio',
    'Pneumococcal',
    'Measles, Mumps, Rubella'
];
$doses = ["At birth", "1½ months", "2½ months", "3½ months", "9 months", "1 year"]; // Array of dose options


$output = '
<table class="table table-hover table-bordered table-striped" id="immu_table">
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

    $selectType = '<td><select class="form-control type" name="type[]" autocomplete="off">';
    foreach ($immuTypes as $type) {
        $selected = (isset($row['immunizationType']) && $type == $row['immunizationType']) ? ' selected="selected"' : '';
        $selectType .= '<option value="' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . '"' . $selected . '>' . htmlspecialchars($type, ENT_QUOTES, 'UTF-8') . '</option>';
    }
    $selectType .= '</select></td>';

    $selectDoses = '<td><select class="form-control dose" name="dose[]" autocomplete="off">';
    foreach ($doses as $dose) {
        $selected = (isset($row['doses']) && $dose == $row['doses']) ? ' selected="selected"' : '';
        $selectDoses .= '<option value="' . htmlspecialchars($dose, ENT_QUOTES, 'UTF-8') . '"' . $selected . '>' . htmlspecialchars($dose, ENT_QUOTES, 'UTF-8') . '</option>';
    }
    $selectDoses .= '</select></td>';

    $output .= '
            <tr>
                <td hidden><input type="text" class="form-control is_id " name="is_id[]" value="' . htmlspecialchars($row['is_id'], ENT_QUOTES, 'UTF-8') . '"></td>
                ' . $selectType . '
                ' . $selectDoses . '
                <td>
                    <input type="date" class="form-control" name="date[]" value="' . (isset($row['dateRecording']) ? htmlspecialchars($row['dateRecording'], ENT_QUOTES, 'UTF-8') : '') . '">
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control" name="weight[]" value="' . htmlspecialchars($row['weight'], ENT_QUOTES, 'UTF-8') . '">
                        <div class="input-group-append">
                            <span class="input-group-text">kg</span>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="text" class="form-control" name="remarks[]" value="' . htmlspecialchars($row['remarks'], ENT_QUOTES, 'UTF-8') . '"> 
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
        <td hidden><input type="text" class="form-control is_id" name="is_id[]"></td>
        <td>
            <select class="form-control type" name="type[]" autocomplete="off" step="any">
                <option selected="selected" disabled value="" style="font-weight:normal;">Choose Type </option>
                <option value="BCG Vaccine" style="font-weight:normal;">BCG Vaccine </option>
                <option value="Tetanus Toxide" style="font-weight:normal;">Tetanus Toxide </option>

                <option value="Pentavalent" style="font-weight:normal;">Pentavalent </option>
                <option value="Oral Polio" style="font-weight:normal;">Oral Polio </option>
                <option value="Inactivated Polio" style="font-weight:normal;">Inactivated Polio </option>
                <option value="Pneumococcal" style="font-weight:normal;">Pneumococcal </option>
            </select>
        </td>
          
        <td>
        <select class="form-control type" name="type[]" autocomplete="off" step="any">
            <option selected="selected" disabled value="" style="font-weight:normal;">Choose Type</option>
            <option value="At birth" style="font-weight:normal;">At Birth</option>
            <option value="1½ months" style="font-weight:normal;">1½ months</option>
            <option value="2½ months" style="font-weight:normal;">2½ months</option>
            <option value="3½ months" style="font-weight:normal;">3½ months</option>
            <option value="9 months" style="font-weight:normal;">9 months</option>
            <option value="1 year" style="font-weight:normal;">1 year</option>
        </select>

        </td>
            <td>
                <div class="input-group">
                    <input type="date" class="form-control" name="date[]">
                    
                </div>
            </td>
            <td>
                <div class="input-group">
                    <input type="number" class="form-control" name="weight[]">
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
            $("#immu_table tbody").append(newRow);
        });

        // Event delegation for dynamically created select dropdowns
        $(document).on("click", ".remove-item-line, .removeList", function (event) {
            event.preventDefault();
            $(this).closest("tr").remove();
        });

    });
</script>