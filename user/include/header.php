<!DOCTYPE html>

<?php  
  include "../function/db.php";
  include "include/bootstrap.php";
  include "include/jquery.php"; 
//   include "function/authenticate.php"; 

?>
<html>

<head>

    <script src="js/sweetalert2@11.js"></script>
    <link href="assets/libs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">

    <link rel="stylesheet" href="css/chosen.min.css">
    <link rel='stylesheet' href='css/main.css'>
    <link rel='stylesheet' href='css/navbar.css'>
    <link rel='stylesheet' href='css/statistic-card.css'>

    <script src="assets/js/numberFormat.js"></script>
    <title>HealthCare System</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
</head>
<?php 
 include "include/datatables_buttons_css.php";
 include "include/datatables_buttons_js.php";

?>
<style>

.location-badge {
    position: fixed;
    bottom: 10px;
    right: 10px;
    display: inline-block;
    padding: 10px 20px;
    background-color: rgb(8, 70, 115);
    /* Change to desired color */
    color: #fff;
    /* Change to desired color */
    border-radius: 5px;
    z-index: 9999;
}
</style>
