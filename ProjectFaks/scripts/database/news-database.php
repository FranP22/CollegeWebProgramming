<?php
function newsDBConnect(){
    try{
        $dbc=mysqli_connect('localhost:3307','root','','webproject');
        return $dbc;
    }
    catch(mysqli_sql_exception $e){
        die("Connection failed: " . $e);
    }
}

function newsAdd($dateadded, $shown, $category, $imagepath, $title, $summary, $text){
    $dbc=newsDBConnect();
    $query="INSERT INTO news(dateadded, shown, category, imagepath, title, summary, articletext) VALUES ('$dateadded','$shown','$category','$imagepath','$title','$summary','$text')";

    mysqli_query($dbc,$query);
}

function newsLoad($cat){
    $dbc=newsDBConnect();
    $query="SELECT news.* FROM news LEFT JOIN categories ON categories.id=news.category WHERE categories.name=?";

    $result=null;
    $stmt=mysqli_stmt_init($dbc);
    if(mysqli_stmt_prepare($stmt,$query)){

        mysqli_stmt_bind_param($stmt,'s',$cat);

        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);
    }

    return $result;
}

function newsFind($id){
    $dbc=newsDBConnect();
    $query="SELECT * FROM news WHERE id=? LIMIT 1";

    $result=null;
    $stmt=mysqli_stmt_init($dbc);
    if(mysqli_stmt_prepare($stmt,$query)){

        mysqli_stmt_bind_param($stmt,'s',$id);

        mysqli_stmt_execute($stmt);
        $result=mysqli_stmt_get_result($stmt);

        mysqli_stmt_close($stmt);
    }

    return $result;
}
?>