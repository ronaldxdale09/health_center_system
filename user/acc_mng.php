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
                        <font color="#0C0070">ACCOUNT </font>
                        <font color="#046D56"> MANAGEMENT </font>
                    </b>
                </h2>
                <br>
                <div class="card">
                    <div class="card-body">
                        <div class="inventory-table">
                            <div class="container-fluid">
                                <button type="button" id="btn_create_account" class="btn text-white"
                                    data-bs-toggle="modal" data-bs-target="#createNew"><i class="bx bx-user"></i> Create
                                    User Account</button>
                                <br>
                                <br>
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Contact #</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Password</th>
                                            <th scope="col">User Type</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    $results = mysqli_query($con, "SELECT * from users "); ?>
                                    <tbody>
                                        <?php while ($row = mysqli_fetch_array($results)) { ?>
                                            <tr>
                                                <th scope="row">
                                                    <?php echo $row['user_id']; ?>
                                                </th>
                                                <td>
                                                    <?php echo $row['name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['contact_no']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['username']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['password']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['userType']; ?>
                                                </td>
                                                <td>
                                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#updateUser"><i class="fa fa-edit"></i></button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"><i
                                                        class="fa fa-trash"></i></button>
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
    </div>

    <script>
        $(document).ready(function () {
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