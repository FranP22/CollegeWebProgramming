<!DOCTYPE html>
<head>
    <?php require("components/head.php"); ?>

    <link rel="stylesheet" href="style/index.css">
</head>
<body>
    <header>
        <?php require("components/navbar.php"); ?>
    </header>
    <div class="body">
        <h1 class="maintitle">News</h1>

        <div class="container-fluid">
            <form action="article.php" method="get" id="f">
                <?php
                require('scripts/database/news-database.php');
                $result=catLoad();

                while($rows = mysqli_fetch_array($result)){
                    $name = $rows['name'];
                    $namelower = strtolower($rows['name']);

                    $str='';
                    $news=newsLoad($name);
                    if(mysqli_num_rows($news)==0){
                        $str='<div>No articles found</div>';
                    }else{
                        while($rows2 = mysqli_fetch_array($news)){
                            if($rows2['shown']){
                                $art='
                                <button type="submit" name="sub" class="btn btn-custom-article" value="' . $rows2['id'] . '">
                                <article class="' . $namelower . '-article article">
                                    <div class="img-container imagecont">
                                        <img class="img-fluid image" src="images/' . $rows2['imagepath'] . '"></img>
                                    </div>
                                    <p class="article-title">' . $rows2['title'] . '</p>
                                    <p class="article-summary">' . $rows2['summary'] . '</p>
                                </article></button>
                                ';

                                $str.=$art;
                            }
                        }
                    }

                    echo '
                    <section class="row ' . $namelower . '" id="' . $namelower . '">
                        <div class="col-md-1 ' . $namelower . '-title title"><div class="line"></div>' . $name . '</div>
                        <div class="col-md-11 ' . $namelower . '-articles articles">
                            ' . $str . '
                        </div>
                    </section>
                    ';
                }
                ?>
            </form>
        </div>

    </div>
    <footer style="color:grey">Made by Fran Prižmić</footer>
</body>