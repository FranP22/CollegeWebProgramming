<?php
function catDBConnect(){
    try{
        $dbc=mysqli_connect('localhost:3307','root','','webproject');
        return $dbc;
    }
    catch(mysqli_sql_exception $e){
        die("Connection failed: " . $e);
    }
}

function catLoad(){
    $dbc=catDBConnect();
    $query="SELECT * FROM categories";

    $result=mysqli_query($dbc,$query);
    mysqli_close($dbc);
    return $result;
}
?>