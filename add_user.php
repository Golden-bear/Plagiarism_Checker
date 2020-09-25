<?php
session_start();
if(!isset($_SESSION['login']))
	{
		header ("location:login.php");
	}
else
	{
		$connect = mysqli_connect ('localhost','root','','skripsi');
		$username = $_POST['username'];
		$password = $_POST['password'];
		$hak_akses = '1';

		$query ="INSERT INTO users(username,password,hak_akses) VALUES ('$username','$password','$hak_akses')";
		$sql = mysqli_query($connect, $query);
		
		if($sql){
			header('location: index.php?save=success');
		}
		else{
			header('location: index.php?save=failed');
		}
		
	}
?>