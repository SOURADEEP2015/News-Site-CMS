<?php 
include "config.php";
if ($_SESSION['user_role'] == 0) {
    header("Location: {$hostname}/admin/post.php");
}

$postid = $_GET['id'];
$sql = "DELETE FROM post WHERE post_id = {$postid}";
if(mysqli_query($conn, $sql)){
header("Location: {$hostname}/admin/post.php");
}
else{
    echo "<P style='color:red; text-align: center; margin: 10px 0;'>SORRY CAN'T DELETE USER {$userid}</p>";
}
?>