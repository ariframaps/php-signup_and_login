<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>signup and login</title>
    <link rel="stylesheet" href="css/reset.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/main.css?v=<?php echo time(); ?>">
</head>

<body>
    <h1>Authentication</h1>
    <div class="forms_container">
        <div class="login_form forms">
            <h2>Login</h2>
            <form action="includes/LoginFormHandler.inc.php" method="post">
                <input type="text" name="username" id="username" placeholder="username">
                <input type="password" name="password" id="password" placeholder="password">
                <input type="submit" value="Login">
            </form>
        </div>
        <div class="signup_form forms">
            <h2>Signup</h2>
            <form action="includes/SignupFormHandler.inc.php" method="post">
                <input type="text" name="username" id="username" placeholder="username">
                <input type="password" name="password" id="password" placeholder="password">
                <input type="text" name="email" id="email" placeholder="email">
                <input type="submit" value="Signup">
            </form>
        </div>
    </div>
</body>

</html>