<!DOCTYPE html>
<html>
 <head>
  <title>Pagiarism Checker</title>  
  <script src="js/jquery-1.10.2.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <script src="js/bootstrap.min.js"></script>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
 </head>
 <body>
<div class="login-box" >
  <div class="login-logo">
    <a>Sistem Deteksi<br><b>Plagiat</b></a>
  </div>
  <div class="login-box-body">
     <form method="post">
	  <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" required placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
       <input type="password" name="password" class="form-control" required placeholder="Password" />
	   <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
			<?php
			include "koneksi.php";
			if (isset($_POST['login']))
			{
				$username=$_REQUEST['username'];
				$password=$_REQUEST['password'];
				$query = "SELECT * FROM users WHERE username='$username'AND password='$password'";
				$cek=mysqli_query($connect, $query );
				$data=mysqli_fetch_array($cek);
				$count=mysqli_num_rows($cek);

				if($count==1)
				{
					session_start();
					$_SESSION['login']=true;
					$_SESSION['hak_akses']= $data['hak_akses'];
					$_SESSION['nama']= $data['username'];
					header ("location: index.php");
					exit;
				}
				else
				{
			?>
			<div class="alert alert-danger alert-dismissible fade in">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				Username atau password salah
			</div>
			<?php 
				}
			}
			?>
			 <div class="form-group">
			   <button type="submit" name="login" value="login" class="btn btn-primary btn-block btn-lg">Masuk</button>
			 </div>
	 </form>	
  </div>
</div>
  
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
 </body>
</html>