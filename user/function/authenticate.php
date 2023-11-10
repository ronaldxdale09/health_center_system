<?php
    $username="";
    $password="";
    if(isset($_SESSION['user'])){
        $username = $_SESSION['user'];
    }
    $sql=mysqli_query($con,"SELECT * FROM users WHERE username='$username'");
    $count = mysqli_num_rows($sql);
    if($count == 0){
        echo "	<script type='text/javascript'>
                    alert('Session Expired');
                    window.location='../index.php';
                </script>";
    }
?>