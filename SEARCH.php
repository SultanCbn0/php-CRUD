<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers:content-type");
    header("Access-Control-Allow-Methods:POST, GET, DELETE, PATCH, OPTIONS");

    $conn=mysqli_connect("localhost","root","","urunler");

    $_POST = json_decode(file_get_contents("php://input"));
    $query='';
    $data=array();

    if(isset($_POST->search_query)){
        
        $search_query=$_POST->search_query;
        
        $query="
        SELECT * FROM urun 
        WHERE (`id` LIKE '%".$search_query."%' 
        OR `name` LIKE '%".$search_query."%' 
        OR `desc` LIKE '%".$search_query."%' 
        OR `stock` LIKE '%".$search_query."%' 
        OR `price` LIKE '%".$search_query."%')";
        
    }else{
        $query="SELECT * FROM urun ORDER BY id ASC";
    }
    $statement=mysqli_query($conn,$query);

    if($statement){
        
        while($row=mysqli_fetch_array($statement)){
            $data[]=$row;
        }
        echo json_encode($data);
    }

    $conn->close();
?>
