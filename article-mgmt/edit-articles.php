<?php
include("connection.php");
if ($id   = $_GET['id']) {

    if (isset($_POST['Edit'])) {
        $id   = $_GET['id'];
        $Title = $_POST['title'];
        $Content = $_POST['content'];

        //to get the image and save it in the folder named images without replacing the image with same name.
        $filename =  explode(".", $_FILES["image"]["name"]);
        $tempname = $_FILES["image"]["tmp_name"];
        $newfilename = "img-" . time() . '.' . end($filename);
        $folder = "./images/" . $newfilename;
        $image = move_uploaded_file($tempname, $folder);
        if (($_FILES["image"]["name"])) {
            $sql  = "UPDATE articles SET title='$Title', content='$Content',  image='$newfilename' WHERE id='$id'";
            //echo '<br>'.$sql;
        } else {
            $sql  = "UPDATE articles SET title='$Title', content='$Content' WHERE id='$id'";
        }
        $re = mysqli_query($conn, $sql);
        header('location:dashboard.php');
    }

    $sql = "SELECT * FROM articles WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    include("header.php");
} else {
    header("Location:$_SERVER[HTTP_HOST]");
    exit;
}

?>

<body>

    <section class="outer-part">
        <h2>Edit Article</h2>
        <form class="add-article" action="#" method="POST" enctype="multipart/form-data">
            <div class="fields">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="title" value="<?= $row['title'] ?>" /><br />
                <label for="content">Content</label>
                <input type="text" name="content" id="content" placeholder="content" value="<?= $row['content'] ?>" /><br />
                <label for="content">Image</label>
                <input type="file" name="image" id="image" placeholder="choose file" accept="image/*" value="<?= $row['image'] ?>" /><br />
                <button type="Submit" name="Edit">Edit Article</button><br />
            </div>
        </form>


        <div class="viewArticle">
            <a href="dashboard.php">
                <button>View Articles</button>
            </a>
        </div>
    </section>
</body>

</html>
