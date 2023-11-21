<?php
include('include/header.php');
include('include/navbar.php');

?>
<style>

</style>

<body>
    <div class='main-content' style='position:relative; height:100%;'>
        <div class="container home-section h-100" style="max-width:95%;">
            <div class="page-wrapper">

                <br>

                <h2 class="page-title">
                    <b>
                        <font color="#0C0070">PATIENT </font>
                        <font color="#046D56"> RECORD </font>
                    </b>
                </h2>
                <br>
                <div class="card">
                    <div class="card-body">
                        <button type="button" class="btn btn-dark text-white" data-toggle="modal"
                            data-target="#newPatient">
                            <i class="fa fa-add" aria-hidden="true"></i> NEW PATIENTS
                        </button>
                        <hr>


                        <?php
                        // SQL query to select relevant patient data
                        $sql = "SELECT * FROM patient_record";
                        $results = mysqli_query($con, $sql);

                        // Check for SQL errors
                        if (!$results) {
                            die("SQL error: " . mysqli_error($con));
                        }
                        ?>
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-striped" id='patient_record'>
                                <thead class="table-dark text-center">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Profile</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Contact #</th>
                                        <th scope="col">Gender</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">Blood Type</th>
                                        <th scope="col">Emergency Contact</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_array($results)) {

                                        $profileImagePath = "assets/img/avatar2.png"; // Default image path
                                        if ($row['ProfilePicture'] != '') {
                                            $profileImagePath = 'patient_img/' . $row['ProfilePicture']; // Adjust the path as needed
                                        }

                                        ?>
                                        <tr>
                                            <td><span class="badge bg-warning text-dark">
                                                    <?php echo $row['patient_id'] ?>
                                                </span>
                                            </td>
                                            <td style="text-align: center;">
                                                <img src="<?php echo $profileImagePath; ?>" class="rounded-circle"
                                                    width="40px">
                                            </td>
                                            <td>
                                                <?php echo $row['Name'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['ContactNumber'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Gender'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['DateOfBirth'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['BloodType'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['EmergencyContact'] ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Address'] ?>
                                            </td>
                                            <td>
                                                <a href="patient_record.php?id=<?php echo $row['patient_id'] ?>"
                                                    class='btn btn-dark btn-sm'> Record</button>
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
    </script>

    <?php
    include "modal/patient_modal.php";
    ?>




</body>

</html>