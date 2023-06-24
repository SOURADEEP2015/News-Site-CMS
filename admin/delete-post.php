<?php
include "config.php";

$postid = $_GET['id'];
$cat_id = $_GET['cat_id'];
$sql1 = "SELECT * FROM post WHERE post_id = {$postid}";
$result = mysqli_query($conn, $sql1);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        unlink("upload/" . $row['post_img']);
    }
}

$sql = "DELETE FROM post WHERE post_id = {$postid};";
$sql .= "UPDATE category SET post=post-1 WHERE category_id = '{$cat_id}' ";
if (mysqli_multi_query($conn, $sql)) {
    header("Location: {$hostname}/admin/post.php");
} else {
    echo "<P style='color:red; text-align: center; margin: 10px 0;'>SORRY CAN'T DELETE USER {$userid}</p>";
}
