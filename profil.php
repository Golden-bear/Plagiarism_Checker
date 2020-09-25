<?php
  session_start();
  if(!isset($_SESSION['login']))
  {
    header ("location:login.php");
    exit;
  }
  else{
?>

<!DOCTYPE html>
<html>
<?php
include "header.php";
?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Detail Data User</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Profil</li>
      </ol>
    </section>
		<?php
	  	include "koneksi.php";
		
  		$query = "SELECT * FROM user ";
  		$sql=mysqli_query($connect,$query);
  		$data=mysqli_fetch_array($sql);
		?>
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Profil Pengguna</h3>
            </div>
            <div class="box-body">
			<form method="post" action="update.php" enctype="multipart/form-data" role="form">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" value="<?php echo $data['username']; ?>" readonly>
                </div>
				<div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" value="<?php echo $data['password']; ?>" required >
                </div>
               <a href="update.php"> <input type="submit" value="Ubah" class='btn btn-primary'> </a>
			   </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
<?php
include "footer.php";
?>
</html>
<?php } ?>