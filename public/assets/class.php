<?php

/**
* 
*/
class Util
{
	
	public function goSql($isi)
	{
		    $sql = mysqli_query($_SESSION['con'],$isi);
		    if(!$sql){
		    	echo '<script language="javascript"> alert("'.mysqli_error($_SESSION['con']).'");
		        history.go(-1);</script>';
		        die();
		    }
				$id1 = mysqli_insert_id($_SESSION['con']);
				return $id1;
	}

		public function getData1($isi)
	{
		$sql = mysqli_query($_SESSION['con'],$isi);
		if(!$sql){
		 	echo '<script language="javascript"> alert("'.mysqli_error($_SESSION['con']).'");
		    history.go(-1);</script>';
		    die();
		}
		$record = mysqli_fetch_array($sql);
		return $record;
	}
	
	public function getData2($isi)
	{
		$sql = mysqli_query($_SESSION['con'],$isi);
		if(!$sql){
		 	echo '<script language="javascript"> alert("'.mysqli_error($_SESSION['con']).'");
		    history.go(-1);</script>';
		    die();
		}
		while ($record=mysqli_fetch_array($sql)){
          $array[]=$record;
      	}
      return $array;
	}
}
?>