<?php
include('include/header.php');
include('include/navbar.php');

?>
<style>
    /* Applies to all table headers and data cells in every table */
    table th,
    table td {
        font-size: 12px;
        /* Adjust the font size to your preference */
        padding: 8px;
        /* Padding for better spacing */
        text-align: left;
        /* Text alignment */
    }

    /* Applies to all tables */
    table {
        width: 100%;
        /* Full width */
        border-collapse: collapse;
        /* No space between borders */
        margin: 15px 0;
        /* Margin above and below for separation */
        font-size: 18px;
        /* General font size */
        text-align: left;
        /* Text alignment */
    }

    /* Style for alternate rows for better readability */
    table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    /* Hover effect for rows */
    table tr:hover {
        background-color: #ddd;
    }

    /* Button style in all tables */
    .table .btn {
        padding: 5px 10px;
        /* Adjust padding */
        font-size: 10px;
        /* Adjust font size */
        margin: 0 3px;
        /* Margin for separation */
    }
</style>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">

                <br>
                <h2 class="page-title">
                    <b>
                        <font color="#0C0070">MEDICINE </font>
                        <font color="#046D56"> INVENTORY </font>
                    </b>
                </h2>
                <br>
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-sm btn-dark text-white" data-toggle="modal" data-target="#addMedicineModal">
                            <i class="fa fa-add" aria-hidden="true"></i> NEW PRODUCT
                        </button>
                        <button type="button" class="btn btn-sm btn-primary text-white" data-toggle="modal" data-target="#addStockModal">
                            <i class="fas fa-arrow-down"></i>
                            STOCK IN
                        </button>
                        <button type="button" class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#usageLogs">
                            <i class="fas fa-arrow-down"></i>
                           Medicine Usage Logs 
                        </button>
                        <hr>
                        <?php
                        // SQL query to select relevant medicine data along with stock details
                        $sql = "SELECT medicine.medicine_id, medicine.name, medicine.description, medicine.generic_name, medicine.expiry_date, medicine.supplier, COALESCE(SUM(med_inv.quantity), 0) AS total_stock 
                                FROM medicine 
                                LEFT JOIN med_inv ON medicine.medicine_id = med_inv.medicine_id 
                                GROUP BY medicine.medicine_id";
                        $results = mysqli_query($con, $sql);

                        // Check for SQL errors
                        if (!$results) {
                            die("SQL error: " . mysqli_error($con));
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id='medicine_inventory'>
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th scope="col">Medicine ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Generic Name</th>
                                        <th scope="col">Expiry Date</th>
                                        <th scope="col">Supplier</th>
                                        <th scope="col">Stock</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td><span class="badge bg-warning text-dark"><?php echo $row['medicine_id'] ?></span></td>
                                            <td><?php echo $row['name'] ?></td>
                                            <td><?php echo $row['description'] ?></td>
                                            <td><?php echo $row['generic_name'] ?></td>
                                            <td><?php echo $row['expiry_date'] ?></td>
                                            <td><?php echo $row['supplier'] ?></td>
                                            <td><?php echo $row['total_stock'] ?></td>
                                            <td>
                                                <!-- You can add actions like Edit, Delete or any other action you need for each medicine record -->
                                                <a href="medicine_detail.php?id=<?php echo $row['medicine_id'] ?>" class='btn btn-dark btn-sm'><i class='fas fa-eye'></i> View</a>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            var table = $('#patient_record').DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'pdfHtml5', 'print']
            });
        });
    </script>

    <?php
    include "modal/medicine_modal.php";
    ?>




</body>

</html>