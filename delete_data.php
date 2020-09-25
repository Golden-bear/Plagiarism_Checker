<?php 
	session_start();
	include 'koneksi.php';
	if(!isset($_SESSION['login']))
	{
		header("location:login.php");
	}
	else
	{
		$id=$_REQUEST['id'];
		$esqiel="SELECT * FROM tabel_data WHERE id_file='$id'";
		$ress=mysqli_query($connect, $esqiel);
		$data=mysqli_fetch_array($ress);
		$file=glob('input/terupload/'.$data['data_pdf']);
		foreach ($file as $files) 
		{
			if (is_file($files)) 
			{
				unlink($files);
			}
		}
		$sql="DELETE FROM tabel_data WHERE id_file='$id'";
		$res=mysqli_query($connect, $sql);
		if($res)
		{
			header("location: index.php?id=$id&delete=success");
		}
		else{
			header("location: index.php?id=$id&delete=failed");
		}
	}

 ?>