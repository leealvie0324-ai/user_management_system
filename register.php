<?php
session_start();
include "includes/db.php";

$error = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $fullname = trim($_POST['fullname']);
    $email = trim($_POST['email']);

    // Prevent blank submissions
    if ($username == "" || $password == "" || $fullname == "") {
        $error = "All fields except email are required.";
    } else {

        // CHECK IF USERNAME EXISTS
        $check = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $check->bind_param("s", $username);
        $check->execute();
        $result = $check->get_result();

        if ($result->num_rows > 0) {
            // Username already taken
            $error = "Username already exists. Please choose another.";
        } else {

            // HASH PASSWORD
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // INSERT USER
            $stmt = $conn->prepare("INSERT INTO users (username, password, fullname, email) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("ssss", $username, $hashed_password, $fullname, $email);

            if ($stmt->execute()) {
                $success = "Account created successfully!";
            } else {
                $error = "Something went wrong while creating the account.";
            }
        }
    }
}
?>

<?php include "includes/header.php"; ?>

<div class="card">
    <h2>Create Account</h2>

    <!-- Back Button -->
    <a href="login.php" class="back-btn"><i class="fa fa-arrow-left"></i> Back</a>

    <?php if ($error != ""): ?>
        <p style="color:red;"><?php echo $error; ?></p>
    <?php endif; ?>

    <?php if ($success != ""): ?>
        <p style="color:green;"><?php echo $success; ?></p>
    <?php endif; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="text" name="fullname" placeholder="Full Name">
        <input type="email" name="email" placeholder="Email (optional)">
        <button type="submit">Register</button>
    </form>
</div>

</body>
</html>
