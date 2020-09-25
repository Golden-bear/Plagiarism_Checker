<?php
$koneksi = mysqli_connect("localhost","root","","skripsi");
	
function cekKamus($kata){
// cari di database	
$koneksi = mysqli_connect("localhost","root","","skripsi");
$sql = mysqli_query($koneksi,"SELECT * from tb_katadasar where katadasar ='$kata'");
	//echo $sql.'<br/>’;
	if(mysqli_num_rows($sql)==1)
	{
		return true; // True jika ada
	}
	else{
		return false; // jika tidak ada FALSE
	}
}

//fungsi untuk menghapus suffix seperti -ku, -mu, -nya, -kah, -lah, pun
function Del_Inflection_Suffixes($kata){ 
	$kataAsal = $kata;
	
	if(preg_match('/([km]u|nya|[kl]ah|pun)\z/i',$kata)){ // Cek Inflection Suffixes
		$__D = preg_replace('/([km]u|nya|[kl]ah|pun)\z/i','',$kata);

		return $__D;
	}
	return $kataAsal;
}

// Cek Prefix Disallowed Sufixes (Kombinasi Awalan dan Akhiran yang tidak diizinkan)
//tidak di panggil 
function Cek_Prefix_Disallowed_Sufixes($kata){

	if(preg_match('/^(be)[[:alpha:]]+/(i)\z/i',$kata)){ // be- dan -i
		return true;
	}

	if(preg_match('/^(se)[[:alpha:]]+/(i|kan)\z/i',$kata)){ // se- dan -i,-kan
		return true;
	}
	
	if(preg_match('/^(di)[[:alpha:]]+/(an)\z/i',$kata)){ // di- dan -an
		return true;
	}
	
	if(preg_match('/^(me)[[:alpha:]]+/(an)\z/i',$kata)){ // me- dan -an
		return true;
	}
	
	if(preg_match('/^(ke)[[:alpha:]]+/(i|kan)\z/i',$kata)){ // ke- dan -i,-kan
		return true;
	}
	return false;
}

// Hapus Derivation Suffixes ("-i", "-an" atau "-kan")
function Del_Derivation_Suffixes($kata){
	$kataAsal = $kata;
	if(preg_match('/(i|an)\z/i',$kata)){ // Cek Suffixes
		$__D = preg_replace('/(i|an)\z/i','',$kata);
		if(cekKamus($__D)){ // Cek Kamus
			return $__D;
		}else if(preg_match('/(kan)\z/i',$kata)){
			$__D = preg_replace('/(kan)\z/i','',$kata);
			if(cekKamus($__D)){
				return $__D;
			}
		}
/*– Jika Tidak ditemukan di kamus –*/
	}
	return $kataAsal;
}

// Hapus Derivation Prefix ("di-", "ke-", "se-", "te-", "be-", "me-", atau "pe-")
function Del_Derivation_Prefix($kata){
	$kataAsal = $kata;

	/* —— Tentukan Tipe Awalan ————*/
	if(preg_match('/^(di|[ks]e)/',$kata)){ // Jika di-,ke-,se-
		$__D = preg_replace('/^(di|[ks]e)/','',$kata);
		
		if(cekKamus($__D)){
			return $__D;
		}
		
		$__D__ = Del_Derivation_Suffixes($__D);
			
		if(cekKamus($__D__)){
			return $__D__;
		}
		
		if(preg_match('/^(diper)/',$kata)){ //diper-
			$__D = preg_replace('/^(diper)/','',$kata);
			$__D__ = Del_Derivation_Suffixes($__D);
		
			if(cekKamus($__D__)){
				return $__D__;
			}
			
		}
		
		if(preg_match('/^(ke[bt]er)/',$kata)){  //keber- dan keter-
			$__D = preg_replace('/^(ke[bt]er)/','',$kata);
			$__D__ = Del_Derivation_Suffixes($__D);
		
			if(cekKamus($__D__)){
				return $__D__;
			}
		}
			
	}
	
	if(preg_match('/^([bt]e)/',$kata)){ //Jika awalannya adalah "te-","ter-", "be-","ber-"
		
		$__D = preg_replace('/^([bt]e)/','',$kata);
		if(cekKamus($__D)){
			return $__D; // Jika ada balik
		}
		
		$__D = preg_replace('/^([bt]e[lr])/','',$kata);	
		if(cekKamus($__D)){
			return $__D; // Jika ada balik
		}	
		
		$__D__ = Del_Derivation_Suffixes($__D);
		if(cekKamus($__D__)){
			return $__D__;
		}
	}
	
	if(preg_match('/^([mp]e)/',$kata)){
		$__D = preg_replace('/^([mp]e)/','',$kata);
		if(cekKamus($__D)){
			return $__D; // Jika ada balik
		}
		$__D__ = Del_Derivation_Suffixes($__D);
		if(cekKamus($__D__)){
			return $__D__;
		}
		
		if(preg_match('/^(memper)/',$kata)){
			$__D = preg_replace('/^(memper)/','',$kata);
			if(cekKamus($kata)){
				return $__D;
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
		}
		
		if(preg_match('/^([mp]eng)/',$kata)){
			$__D = preg_replace('/^([mp]eng)/','',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
			
			$__D = preg_replace('/^([mp]eng)/','k',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
		}
		
		if(preg_match('/^([mp]eny)/',$kata)){
			$__D = preg_replace('/^([mp]eny)/','s',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
		}
		
		if(preg_match('/^([mp]e[lr])/',$kata)){
			$__D = preg_replace('/^([mp]e[lr])/','',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
		}
		
		if(preg_match('/^([mp]en)/',$kata)){
			$__D = preg_replace('/^([mp]en)/','t',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
			
			$__D = preg_replace('/^([mp]en)/','',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
		}
			
		if(preg_match('/^([mp]em)/',$kata)){
			$__D = preg_replace('/^([mp]em)/','',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
			
			$__D = preg_replace('/^([mp]em)/','p',$kata);
			if(cekKamus($__D)){
				return $__D; // Jika ada balik
			}
			
			$__D__ = Del_Derivation_Suffixes($__D);
			if(cekKamus($__D__)){
				return $__D__;
			}
		}	
	}
	return $kataAsal;
}

//fungsi pencarian akar D
function stemming($kata){ 

	$kataAsal = $kata;

	$cekD = cekKamus($kata);
	if($cekD == true){ // Cek Kamus
		return $kata; // Jika Ada maka D tersebut adalah D dasar
	}else{ //jika tidak ada dalam kamus maka dilakukan stemming
		$kata = Del_Inflection_Suffixes($kata);
		if(cekKamus($kata)){
			return $kata;
		}

		
		//$kata = Del_Derivation_Suffixes($kata);
		//if(cekKamus($kata)){
		//	return $kata;
		//}
		
		$kata = Del_Derivation_Prefix($kata);
		if(cekKamus($kata)){
			return $kata;
		}
	}
}
?>