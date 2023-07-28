<!DOCTYPE html>
<head>
    <?php require("components/head.php"); ?>

    <link rel="stylesheet" href="style/article.css">
</head>
<body>
    <header>
        <?php require("components/navbar.php"); ?>
    </header>
    <div class="body">
        <h1 class="maintitle">News</h1>

        <div class="article-detail d-flex justify-content-center align-items-center">
            <div class="article-inner">
                <?php
                require("scripts/database/news-database.php");

                $id = $_GET['sub'];

                $result=newsFind($id);
                $row=mysqli_fetch_array($result);

                $date=$row['dateadded'];
                $imgpath=$row['imagepath'];
                $title=$row['title'];
                $summary=$row['summary'];
                $text=$row['articletext'];

                echo '<p class="article-detail-title">' . $title . '</p>';
                echo '<p class="article-detail-date">' . $date . '</p>';
                echo '
                <div class="img-container">
                    <img class="img-fluid mx-auto d-block article-detail-image" src="images/' . $imgpath . '"></img>
                </div>';
                echo '<p class="article-detail-summary">' . $summary . '</p>';
                echo '<p class="article-detail-text">' . $text . '</p>';
                ?>
            </div>
        </div>
    </div>
    <footer style="color:grey">Made by Fran Prižmić</footer>
</body>