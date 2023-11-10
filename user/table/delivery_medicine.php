<?php
include('../../function/db.php');

$delivery_id = $_POST['delivery_id'];

// Query to get the bale info from the database
$query = "SELECT * FROM delivery_medicine WHERE delivery_id = '$delivery_id'";
$result = mysqli_query($con, $query);

// Check if the query was successful
if (!$result) {
    die('Query Failed: ' . mysqli_error($con));
}



// Fetch all medicines once outside the loop
$medicines = [];
$medQuery = "SELECT * FROM medicine";
$medResult = mysqli_query($con, $medQuery);
while ($medRow = mysqli_fetch_assoc($medResult)) {
    $medicines[] = $medRow;
}



$output = '

<table class="table table-hover table-bordered table-striped "  id="delivery_medicine_list" >
    <thead class="table-primary">
        <tr>
        <th scope="col" hidden></th>

            <th class="text-center" style="font-weight:bold;">Medicine</th>
            <th class="text-center" style="font-weight:bold;">Description</th>
            <th class="text-center" style="font-weight:bold;">Dosage</th>
            <th class="text-center" style="font-weight:bold;">Quantity</th>
            <th></th>
        </tr>
    </thead>
    <tbody>';


// Output the table rows from the delivery_medicine query
while ($row = mysqli_fetch_assoc($result)) {
    // Create the product dropdown for each row
    $medDropdown = '<select class="form-select product-dropdown" name="med[]">';
    $medDropdown .= '<option selected disabled>Select...</option>';
    foreach ($medicines as $medicine) {
        $medName = $medicine['name'] . '-' . $medicine['description'] . ' ' . $medicine['dosage'];
        $selected = $row['medicine_id'] == $medicine['medicine_id'] ? 'selected' : '';

        $description = $medicine['description'];
        $dosage = $medicine['dosage'];


        $medDropdown .= "<option value='" . $medicine['medicine_id'] . "' $selected>" . $medName . "</option>";
    }
    $medDropdown .= '</select>';

     // Append row data to output
     $output .= '
     <tr>
     <td hidden><input type="text" class="form-control payment_id" name="med_id[]" value="' . htmlspecialchars($row['idNo']) . '"></td>
         <td>
             <div class="input-group">
                 ' . $medDropdown . '
             </div>
         </td>
         <td>
             <input type="text" class="form-control med-description" name="description[]" value="' . htmlspecialchars($description) . '" readonly>
         </td>
         <td>
             <input type="text" class="form-control med-dosage" name="dosage[]" value="' . htmlspecialchars($dosage) . '" readonly>
         </td>
         <td>
             <div class="input-group">
                 <input type="number" class="form-control qty-input" name="qty[]" value="' . htmlspecialchars($row['qty']) . '">
             </div>
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
<button type="button" class="btn btn-sm btn-dark" id="addMedicine">+ Add Medicine</button>

';

echo $output;
?>


<script>
    $(document).ready(function () {

        $("#addMedicine").click(function () {
            // Append the row
            var newRow = `
            <tr>
                <td>
                    <div class="input-group">
                        <select class="form-select med-dropdown" name="med[]" style="width: 200px;">
                            <option value="">Select...</option>
                            <?php
                            $sql = "SELECT * FROM medicine";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $medName = $row['name'] . '-' . $row['description'] . ' ' . $row['dosage'];
                                    $medicine_id = $row['medicine_id'];

                                    echo "<option value='$medicine_id'>$medName</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                </td>
                <td>
                    <input type="text" class="form-control med-description" name="description[]" readonly>
                </td>
                <td>
                    <input type="text" class="form-control med-dosage" name="dosage[]" readonly>
                </td>
                <td>
                    <div class="input-group">
                        <input type="number" class="form-control qty-input" name="qty[]">
                    </div>
                </td>
                <td>
                    <div class="input-group">
                        <button type="button" class="btn btn-danger btn-sm remove-item-line">Remove</button>
                    </div>
                </td>
            </tr>
        `;

            $("#delivery_medicine_list tbody").append(newRow);
        });

        // Event delegation for dynamically created select dropdowns
        $("#delivery_medicine_list tbody").on('change', '.med-dropdown', function () {
            // Get the selected option text
            var selectedMed = $(this).find("option:selected").text();
            // Split the text to extract the description and dosage
            var parts = selectedMed.split('-');
            var nameDesc = parts.length > 1 ? parts[1].trim() : '';
            var dosage = nameDesc.split(' ').pop();
            var description = nameDesc.substring(0, nameDesc.lastIndexOf(' '));

            // Set the description and dosage to the respective inputs
            $(this).closest('tr').find('.med-description').val(description);
            $(this).closest('tr').find('.med-dosage').val(dosage);
        });



    });
</script>