<?php 
include "config.php";

$userid = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id = {$userid}";
if(mysqli_query($conn, $sql)){
header("Location: {$hostname}/admin/users.php");
}
else{
    echo "<P style='color:red; text-align: center; margin: 10px 0;'>SORRY CAN'T DELETE USER {$userid}</p>";
}
?>