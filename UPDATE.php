<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers:content-type");
    header("Access-Control-Allow-Methods:POST, GET, DELETE, PATCH, OPTIONS");

    $conn=mysqli_connect("localhost","root","","urunler");

    $_POST=json_decode(file_get_contents('php://input'),true);

        $id=mysqli_real_escape_string($conn,$_POST['id']);
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $desc=mysqli_real_escape_string($conn,$_POST['desc']);
        $stock=mysqli_real_escape_string($conn,$_POST['stock']);
        $price=mysqli_real_escape_string($conn,$_POST['price']);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
            }

        $result=$conn->query("UPDATE urun SET `name`='$name',`desc`='$desc',`stock`='$stock',`price`='$price' WHERE `id`='$id'");
        
        if($result)
            {
                echo "Guncellendi";
            }else{
                echo "hata";
            }

    $conn->close();
?>
