<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers:content-type");
    header("Access-Control-Allow-Methods:POST, GET, DELETE, PATCH, OPTIONS");
    header("Content-Type:application/json");

    $conn=mysqli_connect("localhost","root","","urunler");

    $_POST=json_decode(file_get_contents('php://input'));
    $data=array();
    if(isset($_POST->val))
    {
         $val=$_POST->val;
         $query="SELECT * FROM urun ORDER BY `urun`.`$val` ASC";
         $result=mysqli_query($conn,$query);
        
        if($result){
        
            while($row=mysqli_fetch_array($result)){
                $data[]=$row;
            }
            echo json_encode($data);
        }else{
            echo "Error: " . $data . "<br>" . mysqli_error($conn);
        }
    }
    
$conn->close();
?>
