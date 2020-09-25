<?php 
  session_start();
  if(!isset($_SESSION['login']))
  {
    header("location: login.php");
    exit;
  }
  else{
    include 'input/stemming.php';
    include 'koneksi.php';
    if($_POST['simpan']){
    $namafile = basename($_FILES['bukti']['name']);
    $tipe_file =$_FILES['bukti']['type'];
    $x = explode('.', $namafile);
    $ekstensi = strtolower(end($x));
    $tname=$_FILES['bukti']['tmp_name'];
    $dirupload = "cekdokum/";
    $t_file = $dirupload . basename($_FILES['bukti']['name']);
    $terupload = move_uploaded_file($tname, $t_file);
    include 'PdfToText/PdfToText.phpclass';
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
        Dokumen uji : <?php echo $namafile; ?>
      </h1>
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
                  <th style="text-align:center;">Closeness set C</th>
                  <th style="text-align:center;">Kemiripan</th>
                </tr>
                </thead>
        
                <tbody>
                <?php
                  if ($tipe_file=="application/pdf"){
                    $pdf = new PdfToText($namafile);
                  $teksAsli = $pdf->Text;

                  $teksAsli=strtolower($teksAsli); //mengecilkan semua huruf

                  $hasill = mysqli_query($connect,"SELECT * FROM simbol");
                  while($record=mysqli_fetch_array($hasill))
                  {
                    $teksAsli=str_replace($record['kata']," ",$teksAsli);
                  }

                  $hasilll = mysqli_query($connect,"SELECT * FROM stoplist");
                  while($record=mysqli_fetch_array($hasilll))
                  {
                    $teksAsli=str_replace($record['katad']," ",$teksAsli);
                  }

                  $teksAsli=str_replace(" – ", " ", $teksAsli);
                  $teksAsli=trim($teksAsli,"“");
                  $kata1 = explode(" ",$teksAsli);

                  $penampung = [];
                  foreach($kata1 as $loop){
                    $stem = stemming($loop);//Memasukkan kata ke fungsi Algoritma Nazief (stemming)
                    if(!empty($stem) AND strlen($stem) > 3)
                    {
                      $penampung[]= $stem;      
                    }
                  }

                  $cnt_1 = array_count_values($penampung);
                  $hitungkata1=0;
                  foreach($cnt_1 as $uu => $uu_val){
                    $hitungkata1 += $uu_val;
                  }

                  $hitungpem1 = 0;
                  foreach ($cnt_1 as $q => $q_val) {
                    $hitungpem1 += $q_val * $q_val;
                  }

                  $sql = "SELECT * FROM tabel_data";
                  $query = mysqli_query($connect, $sql);
                  while($data = mysqli_fetch_array($query)){
                    echo "<tr>";
                    echo "<td style='text-align:center;'>".$data['tanggal']."</td>";
                    echo "<td style='text-align:center;'>".$data['data_pdf']."</td>";
                    $teksAsli2 = $data['data_stem'];
                    $teksAsli2 = trim($teksAsli2);
                    $teksAsli2 = explode(" ", $teksAsli2);
                    $cnt_2 = array_count_values($teksAsli2);
                    $hitungkata2=0;
                    foreach($cnt_2 as $uu => $uu_val){
                      $hitungkata2 += $uu_val;
                    }

                    $hitungpem2 = 0;
                    foreach ($cnt_2 as $c => $c_val) {
                      $hitungpem2 += $c_val * $c_val;
                    }

                    $epsilon = 2.5 - (($hitungkata1/$hitungkata2)+($hitungkata2/$hitungkata1));
                    echo "<td style='text-align:center;'>".round($epsilon,2)."</td>";

                    if($epsilon > 0){
                       $cnt_3 = [$cnt_1, $cnt_2];

                    $hitungsemua = [];
                    foreach($cnt_3[0] as $u => $u_val){
                      foreach($cnt_3[1] as $y => $y_val){
                        if($u == $y){
                          $hitungsemua[$u] = $u_val * $y_val ;
                        }
                      }
                    }
                    $hitung = 0; //(menghitung kalimat yang sama)
                    foreach($hitungsemua as $y => $y_val){ 
                      $hitung += $y_val;
                    }

                    $sub1= $hitung / $hitungpem1;
                    $sub2 = $hitung / $hitungpem2;

                    $subset = max($sub1,$sub2);
                    if($subset > 1){
                      $sim = 1 * 100;
                    }
                    else{
                      $sim = round($subset,2) * 100;
                    }
                    
                    echo "<td style='text-align:center;'>".$sim."%"."</td>";
                    
                    }
                    else{
                      echo "<td style='text-align:center;'>"."Tidak ada Hasil"."</td>";
                    }
                    echo "</tr>";
                   
                  }
                  }
                  else{
                    echo "<meta http-equiv='refresh' content='1;URL=cek.php' />";
                  }
                  
                }
                ?>
                </tbody>
              </table>
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
<?php } ?>