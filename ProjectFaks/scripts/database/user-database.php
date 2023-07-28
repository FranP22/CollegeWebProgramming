<?php
function userDBConnect(){
    try{
        $dbc=mysqli_connect('localhost:3307','root','','webproject');
        return $dbc;
    }
    catch(mysqli_sql_exception $e){
        die("Connection failed: " . $e);
    }
}

function userFind($un,$pw){
    $dbc=userDBConnect();
    $query="SELECT * FROM users WHERE username=? AND password=? LIMIT 1";

    $stmt=mysqli_stmt_init($dbc);
    if(mysqli_stmt_prepare($stmt,$query)){

        mysqli_stmt_bind_param($stmt,'ss',$un, $pw);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    if(mysqli_stmt_num_rows($stmt)==1){
        mysqli_stmt_close($stmt);
        return true;
    }else{
        mysqli_stmt_close($stmt);
        return false;
    }
}

function userExists($un){
    $dbc=userDBConnect();
    $query="SELECT * FROM users WHERE username=? LIMIT 1";

    $stmt=mysqli_stmt_init($dbc);
    if(mysqli_stmt_prepare($stmt,$query)){

        mysqli_stmt_bind_param($stmt,'s',$un);

        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
    }

    if(mysqli_stmt_num_rows($stmt)==1){
        mysqli_stmt_close($stmt);
        return true;
    }else{
        mysqli_stmt_close($stmt);
        return false;
    }
}

function userAdd($uname,$pword,$fname,$lname){
    if(userExists($uname)){
        return false;
    }

    $dbc=userDBConnect();
    $query="INSERT INTO users (username, password, firstname, lastname) VALUES ('$uname','$pword','$fname','$lname')";

    mysqli_query($dbc,$query);
    return true;
}
?>