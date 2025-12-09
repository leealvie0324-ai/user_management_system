<?php
include "includes/db.php";
include "includes/header.php";
include "includes/navbar.php";

$error=$success="";
if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=trim($_POST['username']);
    $password=trim($_POST['password']);
    $fullname=trim($_POST['fullname']);
    $email=trim($_POST['email']);
    if($username==""||$password==""||$fullname=="") $error="All required fields must be filled.";
    else{
        $hashed_password=password_hash($password,PASSWORD_DEFAULT);
        $sql="INSERT INTO users(username,password,fullname,email) VALUES(?,?,?,?)";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ssss",$username,$hashed_password,$fullname,$email);
        if($stmt->execute()) $success="User added successfully.";
        else $error="Username already exists.";
    }
}
?>

<div class="card">
<h2>Add User</h2>
<a href="records.php" class="back-btn"><i class="fa fa-arrow-left"></i> Back</a>
<?php if($error!="") echo "<p style='color:red;'>$error</p>"; ?>
<?php if($success!="") echo "<p style='color:green;'>$success</p>"; ?>
<form method="POST">
<input type="text" name="username" placeholder="Username">
<input type="password" name="password" placeholder="Password">
<input type="text" name="fullname" placeholder="Full Name">
<input type="email" name="email" placeholder="Email (optional)">
<button type="submit">Add</button>
</form>
</div>
</body>
</html>
