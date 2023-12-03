<?php
include('db.php');
session_start(); // Ensure session is started

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
        $userAccess = json_decode($user['userAccess'], true); // Decode the JSON string into an array
        $_SESSION["type"] = $user['userType'];
        $_SESSION["full_name"] = $user['name'];
        $_SESSION["user"] = $username;
        $_SESSION["userAccess"] = $userAccess; // Store user access rights in session

        // Define a mapping of access rights to pages
        $accessPages = [
            'dashboard' => '../user/dashboard.php',
            'patient' => 'patient_list.php',
            // Add more mappings as necessary
        ];

        // Redirect to the first page the user has access to
        foreach ($userAccess as $access) {
            if (isset($accessPages[$access])) {
                header('Location: ' . $accessPages[$access]);
                exit();
            }
        }

        // Default redirect if no specific access is found
        header('Location: ../index.php');
    }
}

$stmt->close();
mysqli_close($con);
?>
