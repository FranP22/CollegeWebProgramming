<?php
function generateString($l){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    $newRandomString = '';
    for ($i = 0; $i < $l; $i++) {
        $newRandomString = $randomString . $characters[random_int(0, $charactersLength - 1)];
        $randomString = $newRandomString;
    }
    return $randomString;
}
function saveImage($img){
    $str = null;
    $cont=true;

    $filepath=__FILE__ . '/../../../images/';
    while($cont){
        $str = 'img-' . generateString(24) . '.jpg';
        $f = $filepath . $str;
        if(!file_exists($f)) $cont=false;
    }

    $f = $filepath . $str;
    if (move_uploaded_file($img, $f)) {
        return $str;
    } else {
        return null;
    }
}
?>