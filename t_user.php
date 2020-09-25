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
      <h1>Tambah User</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Profil</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-8">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Profil Pengguna</h3>
            </div>
            <div class="box-body">
			<form method="post" action="add_user.php" enctype="multipart/form-data" role="form">
                <div class="form-group">
                  <label>Username</label>
                  <input type="text" name="username" class="form-control" required>
                </div>
				<div class="form-group">
                  <label>Password</label>
                  <input type="password" name="password" class="form-control" required >
                </div>
               <a href="add_user.php"> <input type="submit" value="Tambah" class='btn btn-primary'> </a>
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