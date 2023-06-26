<?php include "header.php"; ?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Posts</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-post.php">add post</a>
            </div>
            <div class="col-md-12">
                <?php
                include "config.php";
                $limit = 3;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }
                $offset = ($page - 1) * $limit;
                // if ($_SESSION['user_role'] == 1) {
                //     $sql =  "SELECT * from post
                //     LEFT JOIN category ON post.category = category.category_id
                //     LEFT JOIN user ON post.author = user.user_id
                //     ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                // } else {
                //     $sql =  "SELECT * from post
                //     LEFT JOIN category ON post.category = category.category_id
                //     LEFT JOIN user ON post.author = user.user_id WHERE user.user_id={$_SESSION["user_id"]}
                //     ORDER BY post.post_id DESC LIMIT {$offset},{$limit}";
                // }
                // $result = mysqli_query($conn, $sql) or die("Fetch Query Unsucessfull");
                // if (mysqli_num_rows($result) > 0) {
                ?>
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Date</th>
                        <th>Author</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody id="post_table_data">
                        
                    </tbody>
                </table>
                <?php
                // }

                $sql1 = "SELECT * from post";
                $result1 = mysqli_query($conn, $sql1) or die("Fetch Querry Failed!");
                if (mysqli_num_rows($result1)) {
                    $total_records = mysqli_num_rows($result1);

                    $total_page = ceil($total_records / $limit);
                    echo  '<ul class="pagination admin-pagination">';
                    if ($page > 1) {
                        echo '<li><a href="post.php?page=' . ($page - 1) . '">Prev</a></li>';
                    }
                    for ($i = 1; $i <= $total_page; $i++) {
                        if ($i == $page) {
                            $active = "active";
                            echo '<li class = "' . $active . '"><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
                        } else {
                            $active = "";
                            echo '<li class = "' . $active . '"><a href="post.php?page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($total_page > $page) {
                        echo '<li><a href="post.php?page=' . ($page + 1) . '">Next</a></li>';
                    }
                    echo '</ul>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="js/jquery.js">
</script>\
<script type="text/javascript">
    $(document).ready(function() {
        function getData() {
            $.ajax({
                url: "ajax-post.php?page=<?php echo $page;?>",
                type: "GET",
                success: function(data) {
                    console.log(data);
                    $("#post_table_data").html(data)
                }
            })
        };
        getData();
    })
</script>
<?php include "footer.php"; ?>