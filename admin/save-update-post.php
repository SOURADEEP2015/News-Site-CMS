<?php
include "config.php";
if (empty($_FILES['new-image']['name'])) {
    $file_name = $_POST['old-image'];
}
else{
    $errors = array();
    $file_name = $_FILES['new-image']['name'];
    $file_size = $_FILES['new-image']['size'];
    $file_tmp = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    $file_ext = end(explode('.', $file_name));
    $extensions = array("jpeg", "jpg", "png");
    if (in_array($file_ext, $extensions) === false) {
        $errors[] = "This extension file is not allowed, Please choose a JPG, JPEG or PNG FIle";
    }
    if ($file_size > 2097152) {
        $errors[] = "Please Choose a File of below 2mb";
    }
    if (empty($errors) == true) {
        move_uploaded_file($file_tmp, "upload/" . $file_name);
    } else {
        print_r($errors);
        die();
    }
}

session_start();
$title = mysqli_real_escape_string($conn, $_POST["post_title"]);
$description = mysqli_real_escape_string($conn, $_POST["postdesc"]);
$category = mysqli_real_escape_string($conn, $_POST["category"]);
$date = date("d M, Y");
$author = $_SESSION["user_id"];
$sql = "UPDATE post SET title='{$title}', description='{$description}', category='{$category}', post_img='{$file_name}' WHERE post_id='{$_POST["post_id"]}'";
if (mysqli_multi_query($conn, $sql)) {
    header("Location: {$hostname}/admin/post.php");
} else {
    echo "<div class='alert alert-danger'>Query Failed</div>";
}
