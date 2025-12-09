<?php
include "includes/header.php";
include "includes/navbar.php";
?>

<div class="card">
<h2>Welcome, <?php echo $_SESSION['username']; ?>!</h2>
<p>This is your dashboard.</p>
</div>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
  <style>
    body {
      /* Background image */
      background-image: url('mountain.jpg'); /* path to your image */
      background-size: cover; /* make it cover the screen */
      background-repeat: no-repeat; /* don’t repeat */
      background-position: center; /* center the image */
      
      /* Optional: fallback color */
      background-color: #f0f0f0;
    }
  </style>
</head>
<body>
</body>
</html>