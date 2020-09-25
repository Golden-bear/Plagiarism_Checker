<?php
	$connect = mysqli_connect("localhost","root","","skripsi");

	$sql = mysqli_query ($connect,"SELECT * FROM tabel_data");

	while ($yahu = mysqli_fetch_array($sql)) {
		$yahu2 = $yahu['data_stem'];
		echo $yahu2;
		// $yahu2 = trim($yahu2);
		// $yahu2 = explode(" ", $yahu2);
		// $jiah = array_count_values($yahu2);

		// foreach($jiah as $x => $x_value) { //menampilkan isi array dan jumlah kata yang sama dalam array
  //   		echo $x." : ".$x_value;
  //    		echo "<br>";
		// }

		echo "<br>";
		echo "<br>";
	}
	
	
	

?>