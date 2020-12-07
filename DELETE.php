<?php    
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers:content-type");
    header("Access-Control-Allow-Methods:POST, GET, DELETE, PATCH, OPTIONS");
    $conn=mysqli_connect("localhost","root","","urunler");
 
    $data=json_decode(file_get_contents('php://input'));

    if(count($data)>0)
    {
         $value=$data->value;
         $query="DELETE FROM urun WHERE id='$value'";
        if(mysqli_query($conn,$query)){
            echo 'silindi';
        }else{
            echo 'hata';
        }
       
    }
$conn->close();
   
?>
