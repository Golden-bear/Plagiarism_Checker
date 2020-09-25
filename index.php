<?php 
  session_start();
  if(!isset($_SESSION['login']))
  {
    header("location: login.php");
    exit;
  }
  else{
 ?>
<!DOCTYPE html>
<html>
<?php
  include "header.php";
?>
	<head>

		<script src="bower_components/chart.js/Chart.js"></script>
	</head>
<body class="hold-transition skin-blue sidebar-mini">

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Data File
      </h1>
      <ol class="breadcrumb">
        <li><a href="../index.php"><i class="fa fa-home"></i>Home</a></li>
        <li>Data File</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-xs-18">
    <p align="right">
      <!-- <a> <?php echo ("<button type='button' class = 'btn btn-success' onclick=\"location.href='cetak_asset.php'\"><img src='../images/excel.png' width=35 height=35>Export To Excel</button>");?></a> -->
    </p>
           <div class="box box-primary">
            <div class="box-body">
               <div class="tabel">   
              <table id="example1" class="table table-striped">
                <thead> 
                <tr>
                  <th style="text-align:center;">Tanggal</th>
                  <th style="text-align:center;">Data</th>
                  <th style="text-align:center;">Aksi</th>
                </tr>
                </thead>
        
                <tbody>
                <?php
                  include 'koneksi.php';
                  $sql = "SELECT * FROM tabel_data";
                  $query = mysqli_query($connect, $sql);
                  while($data = mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo "<td style='text-align:center;'>".$data['tanggal']."</td>";
                    echo "<td style='text-align:center;'>".$data['data_pdf']."</td>";
                    echo "<td style='text-align:center;'><a href='delete_data.php?id=".$data['id_file']."' class='btn btn-danger' onclick='return confirm('Yakin?');'>Delete</a><p></p></td>";
                    echo "</tr>";
                  }
                ?>
                </tbody>
              </table>
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" style="background: #021e4f">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      <h4 class="modal-title">Konfirmasi</h4>
                    </div>
                    <div class="modal-body">
                      <h4>Apakah Anda yakin data ini akan <b>dihapus</b>?</h4>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                      <a class="btn btn-primary" id="btn-yes">Ya</a>
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
<?php }?>