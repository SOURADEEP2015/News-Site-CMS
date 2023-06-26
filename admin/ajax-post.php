<?php
include "config.php";
$limit = 3;
$offset = ($_GET["page"] - 1) * $limit;
session_start();
if ($_SESSION['user_role'] == 1) {
    $sql =  "SELECT * from post
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id
                    ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
} else {
    $sql =  "SELECT * from post
                    LEFT JOIN category ON post.category = category.category_id
                    LEFT JOIN user ON post.author = user.user_id WHERE user.user_id={$_SESSION["user_id"]}
                    ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
}
$result = mysqli_query($conn, $sql) or die("Fetch Query Unsucessfull");
$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr>
                                    <td class='id'>{$row["post_id"]}</td>
                                    <td>{$row['title']}</td>
                                    <td>{$row['category_name']}</td>
                                    <td>{$row['post_date']}</td>
                                    <td>{$row['username']}</td>
                                    <td class='edit'><a href='update-post.php?id={$row['post_id']}'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-post.php?id={$row['post_id']}&cat_id={$row['category_id']}'><i class='fa fa-trash-o'></i></a></td>
                                </tr>";
    }
    echo $output;
}
