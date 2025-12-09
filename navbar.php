<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>
<nav class="navbar">
    <div class="nav-left">
        <span class="logo">User Management system</span>
    </div>
    <div class="nav-right">
        <a href="index.php">Home</a>
        <a href="records.php">Records</a>
        <a href="add_user.php">Add New</a>
        <a href="logout.php">Logout</a>
    </div>
</nav>
