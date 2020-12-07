<?php
/*    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers:content-type");
    header("Access-Control-Allow-Methods:POST, GET, DELETE, PATCH, OPTIONS");
    
    $id=$_POST['id'];
    $name=$_POST['name'];
    $desc=$_POST['desc'];
    $stock=$_POST['stock'];
    $price=$_POST['price'];

    $conn=mysqli_connect("localhost","root","","urunler");

    mysqli_set_charset($conn,"utf8");

    $query="INSERT INTO urun (id, urun_adi, urun_aciklama, urun_stok, urun_fiyat) VALUES ('$id', '$name', '$desc', '$stock', '$price')";
    
    $result=mysqli_query($conn,$query);

    if($result==0){
        echo "eklenemedi";
    }
    else{
        echo "Eklendi";
    };*/

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers:content-type");
    header("Access-Control-Allow-Methods:POST, GET, DELETE, PATCH, OPTIONS");

    $conn=mysqli_connect("localhost","root","","urunler");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $_POST=json_decode(file_get_contents('php://input'),true);

        $id=mysqli_real_escape_string($conn,$_POST['id']);
        $name=mysqli_real_escape_string($conn,$_POST['name']);
        $desc=mysqli_real_escape_string($conn,$_POST['desc']);
        $stock=mysqli_real_escape_string($conn,$_POST['stock']);
        $price=mysqli_real_escape_string($conn,$_POST['price']);

        $result=mysqli_query($conn,"INSERT INTO urun (`id`,`name`,`desc`,`stock`,`price`) VALUES ('$id','$name','$desc','$stock','$price')");
        
        if($result)
            {
                echo "eklendi";
            }else{
                echo "Error: " . $result . "<br>" . mysqli_error($conn);
            }

    $conn->close();
?>
