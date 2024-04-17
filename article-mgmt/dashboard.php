<?php

session_start();
include("connection.php");
// $showAlert = false;

if (isset($_SESSION['username'])) {
    // header("location:dashboard.php");
    echo "Welcome" .  $_SESSION['username'] . "<br/>";
    // $showAlert = true;
    // echo $_SESSION['success'];
} else {
    header("location:login.php");
}

$query = "SELECT * from articles ";
$result = mysqli_query($conn, $query);

mysqli_close($conn);

include("header.php");

//var_dump($_SESSION);
?>


<body>
    <nav class="navbar-custom">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">Articles</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="active"><a href="dashboard.php">Home</a></li>
                </li>
                <li><a href="add-articles.php">Add</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
        </div>
    </nav>
    <div class="container">
        <h2>List of articles</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Posted on</th>
                    <th>Image</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php

                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $Title = $row['title'];
                    $date = $row['time'];
                    $Image = $row['image'];
                ?>
                    <tr>
                        <td><?php echo $Title ?></td>
                        <td><?php echo $date ?></td>

                        <td><img src="images/<?php echo ($row['image']);
                                                ?>">
                        </td>
                        <td><a href="edit-articles.php?id=<?php echo $id; ?>">Edit</a></td>
                        <td><a href="delete-articles.php?id=<?php echo $id; ?>" onclick="return confirm('Are You Sure you want to delete?')">Delete</a></td>
                    </tr>
                <?php } ?>

            </tbody>
        </table>
    </div>

</body>

</html>
