<?php 
include '../koneksi.php';
include 'stemming.php';
session_start();
if(!isset($_SESSION['login']))
	{
		header ("location:../login.php");
	}
else
	{	
	if($_POST['simpan']){
		
		$namafile = basename($_FILES['bukti']['name']);
		$tipe_file =$_FILES['bukti']['type'];
		$x = explode('.', $namafile);
		$ekstensi = strtolower(end($x));
		$tname=$_FILES['bukti']['tmp_name'];
		$dirupload = "terupload/";
		$t_file = $dirupload . basename($_FILES['bukti']['name']);
		$terupload = move_uploaded_file($tname, $t_file);
		$dates=$_POST['tanggal'];
		include 'PdfToText/PdfToText.phpclass';

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

			$penampung = "";
			foreach($kata1 as $loop){
				$stem = stemming($loop);//Memasukkan kata ke fungsi Algoritma Nazief (stemming)
				if(!empty($stem) AND strlen($stem) > 3)
				{
					$penampung = $penampung.$stem." ";			
				}
			}

	
			$sql = "INSERT INTO tabel_data VALUES (NULL,'$namafile','$penampung','$dates')";
			$jia = mysqli_query($connect,$sql);
			if($jia)
			{
				header("location:../index.php?save=success");
			}
			else{
				header("location:../index.php?save=failed");
			}
	}
	else{header("location:../tambah.php?save=failed");}
	
	}
	
}
	 ?>