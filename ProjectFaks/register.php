<!DOCTYPE html>
<head>
    <?php require("components/head.php"); ?>
    <link rel="stylesheet" href="style/admin.css">
</head>
<body>
    <header>
        <?php require("components/navbar.php"); ?>
    </header>
    <div id="body" class="d-flex flex-column justify-content-center align-items-center">
        <div id="register" class="d-flex flex-column justify-content-center align-items-center">
            <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" class="d-flex flex-column justify-content-center align-items-center">
                <label for="fname">Firstname: </label><span id="fname-text"></span>
                <input type="text" id="fname" name="fname"><br>
                <label for="lname">Lastname: </label><span id="lname-text"></span>
                <input type="text" id="lname" name="lname"><br>
                <label for="uname">Username: </label><span id="uname-text"></span>
                <input type="text" id="uname" name="uname"><br>
                <label for="pword">Password: </label><span id="pword-text"></span>
                <input type="password" id="pword" name="pword"><br>
                <input type="submit" id="submit" value="Sign Up" class="btn btn-custom">
            </form>
            <br>

            <?php
            require('scripts/database/user-database.php');
            if(!empty($_POST['fname'])&&!empty($_POST['lname'])&&!empty($_POST['uname'])&&!empty($_POST['uname'])){
                $fn=$_POST['fname'];
                $ln=$_POST['lname'];
                $un=$_POST['uname'];;
                $pw=hash('sha256',$_POST['pword']);
    
                if(!userAdd($un,$pw,$fn,$ln)){
                    echo '<p style="color:red">That username already exists</p>';
                }else{
                    header('Location: admin.php');
                }
            }
            ?>
        </div>
    </div>
    <footer style="color:grey">
        Made by Fran Prižmić
        <script type="text/JavaScript" src="scripts/login/register.js"></script>
    </footer>
</body>