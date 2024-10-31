<?php
require "auth.php";
if (isset($failed)) {
    echo "<div class='error'>Invalid username/password</div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    

    <div class="container">
        <form action="" method="POST">
            <h1>Login Form</h1>
            <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">
            <div class="form-group">
                <input type="text" name="user" class="form-control" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Password" required>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
        </form>
    </div>
</body>
</html>
