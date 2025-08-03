<?php
$servername = "sql200.infinityfree.com";
$username = "if0_38737699";
$password = "Bs9729024316";
$dbname = "if0_38737699_nexamart";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error){
    die("Connection failed: ".$conn->connect_error);
}
?>