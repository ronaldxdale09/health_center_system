<?php
include('../../function/db.php');

$prenatal_id = $_POST['prenatal_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM prenatal_health_status WHERE prenatal_id = '$prenatal_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}




$output = '

<table class="table table-hover table-bordered table-striped "  id="phs_table" >
    <thead class="table-success">
        <tr>
        <th scope="col" hidden></th>

            <th class="text-center" style="font-weight:bold;">Blood Pressure</th>
            <th class="text-center" style="font-weight:bold;">Weight</th>

            <th class="text-center" style="font-weight:bold;">Fundic Height</th>
            <th class="text-center" style="font-weight:bold;">Gestational Age</th>
            <th class="text-center" style="font-weight:bold;">Petal Heart Tone</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


// Output the table rows from the delivery_medicine query
while ($row = mysqli_fetch_assoc($result)) {
    // Create the product dropdown for each row


    // Append row data to output
    $output .= '
     <tr>
     <td hidden><input type="text" class="form-control payment_id" name="phs_id[]" value="' . htmlspecialchars($row['phs_id']) . '"></td>
    
         <td>
             <input type="text" class="form-control blood_pressure" name="blood_pressure[]" value="' . htmlspecialchars($blood_pressure) . '" readonly>
         </td>
         <td>
             <input type="text" class="form-control med-dosage" name="weight[]" value="' . htmlspecialchars($weight) . '" readonly>
         </td>
         <td>
            <input type="number" class="form-control qty-input" name="fundic_height[]" value="' . htmlspecialchars($row['fundic_height']) . '">

         </td>
         <td>
         <input type="number" class="form-control qty-input" name="gestational_age[]" value="' . htmlspecialchars($row['gestational_age']) . '">
      </td>
      <td>
      <input type="number" class="form-control qty-input" name="petal_heart_tone[]" value="' . htmlspecialchars($row['petal_heart_tone']) . '">
   </td>
         <td>
             <div class="input-group">
                 <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
             </div>
         </td>
     </tr>';


}


$output .= '
    </tbody>
</table>
<button type="button" class="btn btn-sm btn-dark" id="addStatus">+ New Status</button>

';

echo $output;
?>


<script>
    $(document).ready(function () {

        $("#addStatus").click(function () {
            // Append the row
            var newRow = `
            <tr>
                <td>
                <input type="text" class="form-control med-description" name="blood_pressure[]">

                </td>
                <td>
                <input type="text" class="form-control med-description" name="weight[]">

                </td>
                <td>
                    <input type="text" class="form-control med-dosage" name="fundic_height[]">
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control qty-input" name="gestation_age[]">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control qty-input" name="petal_heart_tone[]">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
                    </div>
                </td>
            </tr>
        `;

            $("#phs_table tbody").append(newRow);
        });

        // Event delegation for dynamically created select dropdowns
        $(document).on("click", ".remove-item-line, .removeList", function (event) {
            event.preventDefault();
            $(this).closest("tr").remove();
        });

    });
</script>