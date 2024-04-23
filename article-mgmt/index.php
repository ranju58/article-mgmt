<?php
session_start();
include("connection.php");
// $id   = $_GET['id'];
$login = false;

if (isset($_POST['Register'])) {
    $username = $_POST['username'];
    $password = ($_POST['password']);
    $regex = preg_match('[@_!#$%^&*()<>?/|}{~:]', $password);
    $password1 = ($_POST['password1']);
    $hash = md5($password);
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $number = strlen($phone);

    $user = "SELECT * FROM register WHERE username='$username'";
    $res_user = mysqli_query($conn, $user);
    if (empty($_POST["username"]) && (empty($_POST["password"])) && (empty($_POST["email"])) && (empty($_POST["phone"]))) {
        echo "All fields are empty";
    } else if (!(strlen($password) >= 8)) {
        echo "Password must be 8 characters long";
        if (!($regex)) {
            echo "Password must have atleast one special character";
        }
    } else if (($password != $password1)) {
        echo "Password doesnot match";
    } else if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
        echo "Invalid email";
    }
    // include("mail-verify.php");

    else if (!($number == 10)) {
        echo "Invalid phone";
    } else if (mysqli_num_rows($res_user) > 0) {
        echo "Username already exists";
    } else {
        $sql = "INSERT INTO `register`(`username`, `password` , `email` , `phone`) VALUES ('$username','$hash','$email','$phone')";
        $result = mysqli_query($conn, $sql);
        //to get the id
        $last_id = mysqli_insert_id($conn);
        // echo '<br>====' . $last_id . '<br>====';
        $last_id = md5($last_id);
        $update = "UPDATE register SET mdid='$last_id' WHERE username='$username'";
        $updateResult = mysqli_query($conn, $update);
        $activation_link = '<a href="/article-mgmt/activation-page.php?id=' . $last_id . '">Click here</a> to activate your account<br/>
        ';
        echo $activation_link;
        $_SESSION['logged_in'] = true;
        // $_SESSION['username'] = $username;
        $_SESSION['success'] = "You are now registered";
        echo $_SESSION['success'];

        // header("location:login.php");

        mysqli_close($conn);
    }
}



include("header.php");
?>

<body>
    <section class="outer-part">
        <form class="register-form" action="" method="POST">
            <h3>Registration</h3>
            <div class="fields">
                <input type="text" name="username" id="username" placeholder="username" required /><br />
                <input type="password" name="password" id="password" placeholder="password" required /><br />
                <input type="password" name="password1" id="password1" placeholder="confirm password" required /><br />
                <input type="email" name="email" id="email" placeholder="email" required /><br />
                <input type="number" name="phone" id="phone" placeholder="phone" required /><br />
                <button type="Submit" name="Register" id="Register" />Register</button><br />
            </div>
            <a>Already a member?</a>
            <a href="login.php">Login </a>
        </form>
    </section>
</body>

</html>
