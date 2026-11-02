<?php
                        include('../includes/config.php');
						if(isset($_GET['user_id']))
						{
							$id=$_GET['user_id'];
							$query=mysqli_query($conn,"delete from user where user_id='$id'");
							if($query)
							{
								
								echo"<script>alert('record is deleted');</script>";
								echo"<script>document.location='#';</script>";
							}
							else
							{
								echo"<script>alert('error');</script>";
							}
							
							
						}

?>