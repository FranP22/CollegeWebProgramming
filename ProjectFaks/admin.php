<!DOCTYPE html>
<head>
    <?php require("components/head.php"); ?>

    <script type="text/JavaScript" src="scripts/login/login.js"></script>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <header>
        <?php require("components/navbar.php"); ?>
    </header>
    <div id="body" class="d-flex flex-column justify-content-center align-items-center">
        <div id="login" class="d-flex flex-column justify-content-center align-items-center">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="d-flex flex-column justify-content-center align-items-center">
                <label for="uname">Username:</label>
                <input type="text" id="uname" name="uname">
                <br>
                <label for="pword">Password</label>
                <input type="password" id="pword" name="pword">
                <br>
                <input type="submit" id="submit" value="Login" class="btn btn-custom">
            </form>
            <br>
            <div class="line"></div>
            <br>
            <a href="register.php"><button class="btn btn-custom">Sign up!</button></a>

            <?php
            require('scripts/database/user-database.php');
            session_start();
            if(isset($_SESSION['username']) && isset($_SESSION['password'])){
                $username=$_SESSION['username'];
                $password=$_SESSION['password'];
                if(userFind($username,$password)){
                    echo '<script type="text/JavaScript">login();</script>';
                }
            }

            if(!empty($_POST['pword']) && !empty($_POST['uname'])){
                $pw=hash('sha256', $_POST['pword']);
                $un=$_POST['uname'];
                if(userFind($un,$pw)){
                    $_SESSION['username']=$un;
                    $_SESSION['password']=$pw;
                    echo '<script type="text/JavaScript">login();</script>';
                }
            }
            ?>
        </div>
    </div>
    <footer style="color:grey">Made by Fran Prižmić</footer>
</body>