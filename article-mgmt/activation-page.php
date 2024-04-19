<?php
include("connection.php");
$id = $_GET['id'];
// echo $id;
// echo "<br/>";
//$id = md5($id);
$sqlId = "UPDATE register SET status = 1 WHERE mdid ='$id'";
$results = mysqli_query($conn, $sqlId);
header("location:login.php");
//$num = mysqli_fetch_assoc($results);
// echo $num;
// $md_id = $num['mdid'];
// echo $md_id;
// if ($id == $md_id) {
// $updateId = "UPDATE register SET status = 1 WHERE mdid ='$id' ";
// $res = mysqli_query($conn, $updateId);
// } else {
// echo "Status failed to update";
// }
mysqli_close($conn);
