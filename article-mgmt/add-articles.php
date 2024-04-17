<?php
include("connection.php");
if (isset($_POST['Add'])) {
    $Title  = $_POST['title'];
    $Content = $_POST['content'];
    //to get the image and save it in the folder named images without replacing the image with same name.
    $filename =  explode(".", $_FILES["image"]["name"]);
    $tempname = $_FILES["image"]["tmp_name"];
    $newfilename = "img-" . time() . '.' . end($filename);
    $folder = "./images/" . $newfilename;
    $image = move_uploaded_file($tempname, $folder);


    $date = date('Y-m-d H:i:s');
    if (empty($_POST["title"]) && (empty($_POST["content"])) && (empty($_POST["image"]))) {
        echo "All fields are empty";
    }

    // Performing insert query execution

    $sql = "INSERT INTO `articles`(`time`, `title`, `content`, `image`) VALUES ( 
        '$date','$Title','$Content','$newfilename')";

    // echo $sql . '<br>';
    $res = mysqli_query($conn, $sql);
    header('location:dashboard.php');
    // Close connection
    mysqli_close($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Articles</title>
    <link rel="stylesheet" href="register.css" />

</head>

<body>

    <section class="outer-part">
        <h2>Add Article</h2>
        <form class="add-article" action="#" method="POST" enctype="multipart/form-data">
            <div class="fields">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="title" required /><br />
                <label for="content">Content</label>
                <input type="text" name="content" id="content" placeholder="content" required /><br />
                <label for="content">Image</label>
                <input type="file" name="image" id="image" placeholder="choose file" accept="image/*" /><br />
                <button type="Submit" name="Add">Add Article</button><br />
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
