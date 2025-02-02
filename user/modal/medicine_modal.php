<!-- Confirm Modal for New Prenatal Record -->
<div class="modal fade" id="addMedicineModal" tabindex="-1" aria-labelledby="prenatalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicineLabel">Add New Medicine</h5>

                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/medicine_inv.php'>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="generic_name" class="form-label">Generic Name</label>
                            <input type="text" class="form-control" name="generic_name">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="brand_name" class="form-label">Brand Name</label>
                            <input type="text" class="form-control" name="brand_name">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" name="expiry_date">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" name="supplier">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="new" class="btn btn-primary" id="confirmPrenatalButton">Yes,
                        Create</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add/Update Medicine Modal -->
<div class="modal fade" id="updateMedicine" tabindex="-1" aria-labelledby="medicineModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="medicineModalLabel">Add/Update Medicine</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/medicine_inv.php'>
                <div class="modal-body">
                    <!-- Hidden input for medicine ID (used for updating) -->
                    <input type="hidden" id="medicine_id" name="medicine_id">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="generic_name" class="form-label">Generic Name</label>
                            <input type="text" class="form-control" id="generic_name" name="generic_name">
                        </div>
                    </div>

                    <div class="row">
                       
                        <div class="col-md-6 mb-3">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input type="date" class="form-control" id="expiry_date" name="expiry_date">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="supplier" class="form-label">Supplier</label>
                        <input type="text" class="form-control" id="supplier" name="supplier">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" class="btn btn-primary" id="confirmMedicineButton">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Add Stock Modal for Medicine -->
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockLabel">Add Stock for Medicine</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/medicine_inv.php'>

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="fullName" class="form-label">Full Name</label>
                        <select class='form-control col-md-10' name='medicine_id' id='medicine_id'>
                            <option disabled="disabled" selected="selected">Select Medicine</option>
                            <?php
                            // Retrieve customer names from the coffee_customer table
                            $sql = "SELECT * FROM medicine";
                            $result = mysqli_query($con, $sql);
                            if ($result) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    $medicine_id = $row['medicine_id'];
                                    $medicine = $row['name'];

                                    echo "<option value='$medicine_id' > $medicine</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" id="notes" name="notes"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" name="addStock" class="btn btn-primary" id="confirmAddStockButton">Add
                        Stock</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Add Stock Modal for Medicine -->
<div class="modal fade" id="usageLogs" tabindex="-1" aria-labelledby="addStockLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addStockLabel">Medicine Stockout Logs</h5>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method='POST' action='function/medicine_inv.php'>

                <div class="modal-body">
                    <div class="mb-3">
                        <?php
                        $sql = "SELECT medicine.name, medicine.description, medicine.expiry_date, 
               delivery_medicine.qty AS quantity_used, 
               delivery_record.dateRecording AS usage_date
        FROM medicine 
        LEFT JOIN delivery_medicine ON medicine.medicine_id = delivery_medicine.medicine_id
        LEFT JOIN delivery_record ON delivery_medicine.delivery_id = delivery_record.delivery_id
        ORDER BY medicine.name, delivery_record.dateRecording";
                        $results = mysqli_query($con, $sql);

                        // Check for SQL errors
                        if (!$results) {
                            die("SQL error: " . mysqli_error($con));
                        }
                        ?>


                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id='medicine_logs'>
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Quantity Used</th>
                                        <th scope="col">Usage Date</th>
                                        <th scope="col">Expiry Date</th>
                                        <th scope="col">Service</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['description'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['quantity_used'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['usage_date'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['expiry_date'] ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-dark">Delivery</span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>

                </div>
            </form>
        </div>
    </div>
</div>

<script>
    var table = $('#medicine_logs').DataTable({
        dom: 'Bfrtip',
        buttons: ['excelHtml5', 'pdfHtml5', 'print']
    });
</script>