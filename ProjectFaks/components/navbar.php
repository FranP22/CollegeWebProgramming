<?php
require('scripts/database/categories-database.php');
$c = catLoad();

echo "<nav class=\"navbar d-flex flex-column flex-md-row justify-content-between\"><a href=\"index.php\" class=\"btn btn-colour-1\">Home</a>";
while($row = mysqli_fetch_array($c)){
    $link = '#' . strtolower($row['name']);
    echo "<a href=\"index.php" . $link . "\" class=\"btn btn-colour-1\">" . $row['name'] . "</a>";
}

echo "<a href=\"admin.php\" class=\"btn btn-colour-1\">Administration</a></nav>";
echo "<link rel=\"stylesheet\" href=\"https://fonts.googleapis.com/css?family=Pacifico\">";
?>