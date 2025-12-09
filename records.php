<?php
include "includes/db.php"; 
include "includes/header.php";
include "includes/navbar.php";


$keyword = "";
if(isset($_GET['search'])){
    $keyword = trim($_GET['search']);
    $sql="SELECT * FROM users WHERE username LIKE ? OR fullname LIKE ?";
    $stmt=$conn->prepare($sql);
    $like="%$keyword%";
    $stmt->bind_param("ss",$like,$like);
} else {
    $sql="SELECT * FROM users";
    $stmt=$conn->prepare($sql);
}
$stmt->execute();
$result=$stmt->get_result();
?>

<div class="card">
<h2>User Records</h2>
<a href="index.php" class="back-btn"><i class="fa fa-arrow-left"></i> Back</a>

<div class="search-box">
<form method="GET">
<input type="text" name="search" placeholder="Search..." value="<?php echo htmlspecialchars($keyword); ?>">
<button type="submit">Search</button>
</form>
</div>

<table>
<tr>
<th>ID</th><th>Username</th><th>Full Name</th><th>Email</th><th>Actions</th>
</tr>
<?php while($row=$result->fetch_assoc()): ?>
<tr>
<td><?php echo $row['id'];?></td>
<td><?php echo $row['username'];?></td>
<td><?php echo $row['fullname'];?></td>
<td><?php echo $row['email'];?></td>
<td>
<a href="edit_user.php?id=<?php echo $row['id'];?>">Edit</a> |
<a href="delete_user.php?id=<?php echo $row['id'];?>" onclick="return confirm('Delete this user?')">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</div>
</body>
</html>
