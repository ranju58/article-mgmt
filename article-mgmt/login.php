<?php
session_start();

// var_dump($_SESSION);

//if session variable cha bhane redirect to dashboard
if (isset($_SESSION['username'])) {
    header('location:dashboard.php');
}
$login = false;
include("connection.php");
if (isset($_POST['Login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    if (empty($_POST["username"]) && (empty($_POST["password"]))) {
        echo "All fields are empty";
    }
    $password = md5($password); //hashing

    $sql = "SELECT * FROM register WHERE username ='$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($result);
    if ($num == 1) {

        $_SESSION['logged_in'] = true;
        $_SESSION['success'] = "You are now logged in";
        $_SESSION['username'] = $username;
        header("location:dashboard.php");
    } else {
        echo "Invalid Credentials";
    }

    mysqli_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Login form</title>
    <link rel="stylesheet" href="register.css" />
</head>

<body>
    <section class="outer-part">
        <form class="login-form" action="#" method="POST">
            <h3>LOGIN</h3>
            <div class="fields">
                <input type="text" name="username" id="username" placeholder="Username" required /><br />
                <input type="password" name="password" id="password" placeholder="Password" required /><br />
                <input type="text" name="forgot" id="forgot" placeholder="Forgot password?" /><br />
            </div>

            <button type="Submit" name="Login" id="Login">Login</button><br />

            <a>Not a member?</a>
            <a href="index.php">Signup </a>
        </form>
    </section>
</body>

</html>