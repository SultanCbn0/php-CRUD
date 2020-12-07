<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers:content-type");
    header("Access-Control-Allow-Methods:POST, GET, DELETE, PATCH, OPTIONS");
    header("Content-Type:application/json");

    $conn=mysqli_connect("localhost","root","","urunler");

    $result=$conn->query("SELECT * FROM urun"); 
    $sonuc="";
    while($takethis=$result->fetch_array(MYSQLI_ASSOC)){
        if($sonuc !=""){
            $sonuc .=",";
        }
        $sonuc .='{"id":"'.$takethis["id"].'",';
        $sonuc .='"name":"'.$takethis["name"].'",';
        $sonuc .='"desc":"'.$takethis["desc"].'",';
        $sonuc .='"stock":"'.$takethis["stock"].'",';
        $sonuc .='"price":"'.$takethis["price"].'"}';
    }
    $sonuc='{"records":['.$sonuc.']}';

    echo $sonuc;
    return $sonuc;
$conn->close();
?>
