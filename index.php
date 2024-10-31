<?php

session_start();
    if(!isset($_SESSION['username'])){
        header("Location: login.php");
        exit();
    }

    if ($_SESSION['ip'] !== $_SERVER['REMOTE_ADDR'] || ($_SESSION['agent'] !== $_SERVER['HTTP_USER_AGENT'])) {
        session_destroy();
        header("Location: login.php");
        die();
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-group{
            font-size: 28px;
            text-align: center;
        }
    </style>
</head>
<body>


<div class="container">
    <form action="logout.php" method="POST"> 
        <h1>Profile</h1>
        <div class="form-group">
            <?php echo $_SESSION['username']; ?> 
        </div>
       
        <button type="submit">Logout</button> 
    </form>
    </div>
</body>
</html>