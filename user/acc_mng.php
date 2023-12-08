<?php
include('include/header.php');
include('include/navbar.php');

?>


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
                            <button type="button" class="btn btn-sm btn-dark text-white" data-toggle="modal"
                                data-target="#createUserModal">
                                <i class="fa fa-add" aria-hidden="true"></i> NEW RECORD
                            </button>
                            <hr>
                            <table class="table table-bordered table-hover table-striped" id='patient_record'>
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact #</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">Password</th>
                                        <th>User Type</th>
                                        <th  width="15%" scope="col">Access</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <?php
                                $results = mysqli_query($con, "SELECT * from users "); ?>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) { ?>
                                        <tr>
                                            <td>
                                                <?php echo $row['user_id']; ?>
                                            </td>
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
                                                <?php echo $row['userAccess']; ?>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-secondary btnEdit"
                                                    data-access='<?php echo json_encode($row['userAccess']); ?>'>
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger btnDelete"
                                                    data-bs-toggle="modal"><i class="fa fa-trash"></i></button>
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
        $(document).ready(function () {
            var table = $('#patient_record').DataTable({
                dom: 'Bfrtip',
                buttons: ['excelHtml5', 'pdfHtml5', 'print']
            });
        });

        $(document).ready(function () {
            // Handling click event for Update button
            $('.btnEdit').on('click', function () {
                var $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $.trim($(this).text()); // Trimming the text content of each 'td'
                }).get();




                $('#updateUserId').val(data[0]);
                $('#userNameUpdate').val(data[1]);
                $('#userContactUpdate').val(data[2]);
                $('#userUsernameUpdate').val(data[3]);
                $('#userPasswordUpdate').val(data[4]);
                $('#userTypeUpdate').val(data[5]);


                // Get the user access rights from the data attribute, trim it, and then parse it
                var userAccessJson = $(this).data('access').trim();
                var userAccess = JSON.parse(userAccessJson);
                console.log(userAccess); // Ensure this log
                // Reset selections
                $('#updateUserAccess option').prop('selected', false);

                // Iterate over the options and select as needed
                if (Array.isArray(userAccess)) {
                    userAccess.forEach(function (access) {
                        $('#updateUserAccess option[value="' + access + '"]').prop('selected', true);
                    });
                }
                // Show the Update User modal
                $('#updateUserModal').modal('show');
            });

            // Handling click event for Delete button
            $('.btnDelete').on('click', function () {

                var $tr = $(this).closest('tr');
                var data = $tr.children("td").map(function () {
                    return $.trim($(this).text()); // Trimming the text content of each 'td'
                }).get();


                $('#deleteUserId').val(data[0]);

                // Show the Delete User modal
                $('#deleteUserModal').modal('show');
            });
        });

    </script>

    <?php
    include "modal/user_management.php";


    ?>




</body>

</html>