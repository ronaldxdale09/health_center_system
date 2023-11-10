<?php
include('db.php');

$username = mysqli_real_escape_string($con, $_POST['username']);
$password = mysqli_real_escape_string($con, $_POST['password']);

// Use prepared statements to avoid SQL injection
$stmt = $con->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<script type='text/javascript'>
            alert('No Record of Given Username');
            window.location='../index.php';
          </script>";
} else {
    $user = $result->fetch_assoc();
    if ($password !== $user['password']) {
        echo "<script type='text/javascript'>
                alert('Invalid Password!');
                window.location='../index.php';
              </script>";
    } else {
        $userType = $user['userType'];
        $_SESSION["type"] = $userType;
        $_SESSION["full_name"] = $user['name'];
        $_SESSION["user"] = $username;

        if ($userType == 'Staff') {
            header('Location: ../user/dashboard.php');
        } 
    }
}

$stmt->close();
mysqli_close($con);

