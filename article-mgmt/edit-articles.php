<?php
include("connection.php");
$id   = $_GET['id'];

if (isset($_POST['Edit'])) {
    $id   = $_GET['id'];
    $Title = $_POST['title'];
    $Content = $_POST['content'];
    $Image = file_get_contents($_FILES['image']['tmp_name']);


    $sql  = "UPDATE articles SET title='$Title', content='$Content',  image='0x" . bin2hex($Image) . "' WHERE id='$id'";
    //echo '<br>'.$sql;

    $res = mysqli_query($conn, $sql);
    // header('location:dashboard.php');
    mysqli_close($conn);
}
$sql = "SELECT * FROM articles WHERE id='$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article</title>
    <link rel="stylesheet" href="register.css" />

</head>

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
                <img src="data:image/jpeg;base64,<?php echo base64_encode($row['image']); ?>">
                <input type="file" name="image" id="image" placeholder="choose file" accept="image/*" /><br />
                <button type="Submit" name="Edit">Edit Article</button><br />
            </div>
        </form>

    </section>

</body>

</html>
