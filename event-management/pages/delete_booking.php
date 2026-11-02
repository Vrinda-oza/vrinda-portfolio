<?php
// Include database connection
include('../includes/config.php');


if(isset($_GET['deleteid']))
{
	$id=$_GET['deleteid'];
	$query= mysqli_query($conn,"delete from booking where booking_id='$id'");
	if($query)
	{
		echo"<script>alert('data deleted');</script>";
		echo"<script>document.location='dashboard.php';</script>";
	}
	else
	{
		echo"<script>alert('error');</script>";
		
	}
	
	
}


?>