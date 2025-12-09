<?php
include "includes/db.php";
if(isset($_GET['id'])){
    $id=intval($_GET['id']);
    $sql="DELETE FROM users WHERE id=?";
    $stmt=$conn->prepare($sql);
    $stmt->bind_param("i",$id);
    $stmt->execute();
}
header("Location: records.php");
exit();
