<?php
include "includes/db.php"; 
include "includes/header.php";
include "includes/navbar.php";

$error=$success="";
$id=intval($_GET['id']);
$sql="SELECT * FROM users WHERE id=?";
$stmt=$conn->prepare($sql);
$stmt->bind_param("i",$id);
$stmt->execute();
$result=$stmt->get_result();
$user=$result->fetch_assoc();

if($_SERVER['REQUEST_METHOD']=="POST"){
    $username=trim($_POST['username']);
    $fullname=trim($_POST['fullname']);
    $email=trim($_POST['email']);
    if($username==""||$fullname=="") $error="All required fields must be filled.";
    else{
        $sql="UPDATE users SET username=?, fullname=?, email=? WHERE id=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("sssi",$username,$fullname,$email,$id);
        if($stmt->execute()) $success="User updated successfully.";
        else $error="Username already exists.";
    }
}
?>

<div class="card">
<h2>Edit User</h2>
<a href="records.php" class="back-btn"><i class="fa fa-arrow-left"></i> Back</a>
<?php if($error!="") echo "<p style='color:red;'>$error</p>"; ?>
<?php if($success!="") echo "<p style='color:green;'>$success</p>"; ?>
<form method="POST">
<input type="text" name="username" value="<?php echo $user['username'];?>" placeholder="Username">
<input type="text" name="fullname" value="<?php echo $user['fullname'];?>" placeholder="Full Name">
<input type="email" name="email" value="<?php echo $user['email'];?>" placeholder="Email (optional)">
<button type="submit">Update</button>
</form>
</div>
</body>
</html>
