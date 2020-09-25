<?php 
session_start();
if(!isset($_SESSION['login']))
	{
		header ("location:../login.php");
	}
else
	{
    error_reporting(0);
    // $id=$_REQUEST['id'];
?>
<!DOCTYPE html>
<html>
<?php
include "header.php";
?>
	
<body class="hold-transition skin-blue sidebar-mini">
  <div class="content-wrapper">
    <section class="content-header">
      <h1> Form Cek Dokumen</h1>
      <ol class="breadcrumb">
        <li><a href="index.php"><i class="fa fa-home"></i> Home</a></li>
		<li>DOKUMEN</li>
    <li>Cek Dokumen</li>
      </ol>
    </section>

    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">

			
            <div class="box-body">
			<form method="post" enctype="multipart/form-data" role="form" action="hasil.php">
                <div class="form-group">
                <div class="form-group">
          <label>Dokumen</label>
          <input type="file" name="bukti" class="form-control">
                </div>
			
      <div class="row">
          <div class="col-xs-8"></div>
          <div class="col-xs-4">
            <button type="submit" name="simpan" value= "simpan" class="btn btn-primary btn-block btn-flat">CEK</button>
          </div>
          </div> 
            </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <script type="text/javascript">
    <?php 
      if($simpan!=NULL)
      {
        if($simpan=='success'){?>
          alert("Data Berhasil Disimpan!");
     <?php }
        else{?>
          alert("Data Gagal Disimpan!");
      <?php }
      } ?>
  </script>
</body>
<?php
	include "footer.php";
?>
</html>
<?php } ?>