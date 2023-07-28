<?php
if(isset($_POST["query"])){
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
        return $result;
    }


    $c=catLoad();
    $data=array();

    while($row = mysqli_fetch_array($c)){
        $data[] = array(
            'id' => $row["id"],
            'name' => $row["name"]
        );
    }

    echo json_encode($data);
}
?>