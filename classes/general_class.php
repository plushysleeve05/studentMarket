<?php
//connect to database class
require("../settings/db_class.php");


/**
 *@author David Sampah
 *
 */

 class general_class extends db_connection{

 

  //public function add_brand($a,$b)
//{
		//$ndb = new db_connection();	
 		//$name =  mysqli_real_escape_string($ndb->db_conn(), $a);
		//$desc =  mysqli_real_escape_string($ndb->db_conn(), $b);
		//$sql="INSERT INTO `brands`(`brand_name`, `brand_description`) VALUES ('$name','$desc')";
		//return $this->db_query($sql);
	//}
//{
	//--INSERT--//
	public function add_brand($brandName){
		$ndb = new db_connection();
		$brandName=mysqli_real_escape_string($ndb->db_conn(), $brandName);
	    $sql="INSERT INTO `brands`(`brand_name`) VALUES ('$brandName')";
		return $this->db_query($sql);

	}
	

	//--SELECT--//



	//--UPDATE--//



	//--DELETE--//
	

}

?>