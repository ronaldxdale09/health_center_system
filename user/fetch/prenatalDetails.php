<?php 
// Include the database config file 
include('../../function/db.php');

  $patient_id = $_REQUEST['patient_id'];




  $sql_prenatal = "SELECT * FROM prenatal_record WHERE patient_id = $patient_id";
  $result_prenatal = $con->query($sql_prenatal);
  $prenatal = $result_prenatal->fetch_assoc();


  $abortion = $prenatal['abortion'] ?? '';
  $para_no = $prenatal['para_no'] ?? '';
  $lmp = $prenatal['lmp'] ;
  $edc = $prenatal['edc'];

  $children = $prenatal['children'] ?? '';
  $gravida = $prenatal['gravida'] ?? '';




   // Store it in a array
   $result = ["$abortion","$para_no","$lmp","$edc","$children","$gravida"];
  

   // Send in JSON encoded form
   $myJSON = json_encode($result);
   echo $myJSON;
   
 

?>
