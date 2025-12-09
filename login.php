<?php
session_start();
include "includes/db.php";

$error = "";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if ($username == "" || $password == "") $error = "All fields are required.";
    else {
        $sql = "SELECT * FROM users WHERE username=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            $user = $result->fetch_assoc();
            if(password_verify($password, $user['password'])){
                $_SESSION['username'] = $user['username'];
                header("Location: index.php");
                exit();
            } else $error = "Incorrect password.";
        } else $error = "User not found.";
    }
}

include "includes/header.php";
?>

<div class="card">
    <h2>Login</h2>
    <?php if($error != "") echo "<p style='color:red;'>$error</p>"; ?>
    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Create Account</a></p>
    </form>
</div>
</body>
</html>
