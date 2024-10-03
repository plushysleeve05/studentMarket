<?php

include("../controllers/general_controller.php");

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $brandName=$_POST["brand"];

    $addBrand=add_brand_ctr($brandName);
    if($addBrand !==false){
        header("Location:../view/brand.php");
    }

    else{
        echo "Lab not successful";
    }
}

?>