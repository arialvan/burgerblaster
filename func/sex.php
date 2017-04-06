<?php
function jenisKelamin($kelamin){
	if($kelamin =='L'){
		echo "Laki laki";
	}elseif($kelamin =='P'){
		echo "Perempuan";
	}else{
		echo "Unknown";
	}
}

function lev($level){
	if($level ==1){
		echo "Admin";
	}elseif($level ==2){
		echo "Kasir";
	}elseif($level ==3){
		echo "Waiters";
	}elseif($level ==4){
		echo "CEO";
        }elseif($level ==5){
		echo "Pelanggan";
	}else{
		echo "Unknown";
	}
}

 function rupiah($angka){
           $jadi="IDR. ".number_format($angka,0,',','.');
            return $jadi;
     }

function implo($array){
	if(is_array($array)){
		$implode = implode('#',$array);	
		
	}
	return $implode;
}

function explo($var){
	$ex = explode('#',$var);
	return $ex;
}

function status($status){
	if($status ==0){
		echo "Creat Order";
	}elseif($status ==1){
		echo "Order Process";
	}elseif($status ==2){
		echo "Order Done";
	}elseif($status ==3){
		echo "Sold";
	}else{
		echo "Unknown";
	}
}

function type($type){
	if($type ==1){
		echo "onplace";
	}elseif($type ==2){
		echo "takehome";
	}else{
		echo "Unknown";
	}
}

function DateToIndo($date) { // fungsi atau method untuk mengubah tanggal ke format indonesia
   // variabel BulanIndo merupakan variabel array yang menyimpan nama-nama bulan
		$BulanIndo = array("Januari", "Februari", "Maret",
						   "April", "Mei", "Juni",
						   "Juli", "Agustus", "September",
						   "Oktober", "November", "Desember");
	
		$tahun = substr($date, 0, 4); // memisahkan format tahun menggunakan substring
		$bulan = substr($date, 5, 2); // memisahkan format bulan menggunakan substring
		$tgl   = substr($date, 8, 2); // memisahkan format tanggal menggunakan substring
		
		$result = $tgl . " " . $BulanIndo[(int)$bulan-1] . " ". $tahun;
		return($result);
}


function meja($meja){
        
	if($meja ==0){
		echo "Take Away";
	}elseif($meja ==1){
		echo "Meja No 1";
	}elseif($meja ==2){
		echo "Meja No 2";
	}elseif($meja ==3){
		echo "Meja No 3";
        }elseif($meja ==4){
		echo "Meja No 4";
        }elseif($meja ==5){
		echo "Meja No 5";
        }elseif($meja ==6){
		echo "Meja No 6";
        }elseif($meja ==7){
		echo "Meja No 7";
        }elseif($meja ==8){
		echo "Meja No 8";
        }elseif($meja ==9){
		echo "Meja No 9";
        }elseif($meja ==10){
		echo "Meja No 10";
        }elseif($meja ==11){
		echo "Meja No 11";
        }elseif($meja ==12){
		echo "Meja No 12";
        }elseif($meja ==13){
		echo "Meja No 13";
        }elseif($meja ==14){
		echo "Meja No 14";
        }elseif($meja ==15){
		echo "Meja No 15";
	}else{
		echo "Unknown";
	}
}

?>