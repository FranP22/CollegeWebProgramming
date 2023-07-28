<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Web Programiranje Projekt</title>
    <meta name="author" content="Fran Prižmić">
    <meta name="description" content="Projektni zadatak za predmet web programiranje">
</head>
<body>
    <div id="body">
        <?php
        require('database/news-database.php');
        require('database/categories-database.php');
        function failed(){
            echo '<h1 id="title">Adding item failed</h1>';
            echo '<a href="../index.php"><button>Home</button></a>';
        }

        $category=$_POST['select'];
        $categories=catLoad();
        $exists=false;
        while($row = mysqli_fetch_array($categories)){
            if($category==$row['id']){
                $exists=true;
                break;
            }
        }

        $title=$_POST['title'];
        $summary=$_POST['summary'];
        $text=$_POST['text'];
        $visible=false;
        if(isset($_POST['visible'])) $visible=true;

        if($exists){

            $date = date('Y-m-d H:i:s');

            require('images/images.php');
            $img = $_FILES['image']['tmp_name'];
            $imgstr = saveImage($img);

            newsAdd($date,$visible,$category,$imgstr,$title,$summary,$text);

            header('Location: ../index.php');
        }else{
            failed();
        }
        ?>
    </div>
    <footer style="color:grey">Made by Fran Prižmić</footer>
</body>