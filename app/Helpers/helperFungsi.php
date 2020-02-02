<?php

	function getUrgensi($id){
		switch ($id) {
			case '1':
			return "Biasa";
			break;

			case '2':
			return "Segera";
			break;

			case '3':
			return "Rahasia";
			break;
		}
	}
	//fungsi notifikasi
	function getNotif($status, $type) {
		$notif = array(
			'message' => $status,
            'type' => $type
		);

		return $notif;
	}
	//fungsi untuk menampilkan status level user
	function getLevel($lvl) {
		switch ($lvl) {
			case '1':
				return "Administrator";
				break;
			case '2':
				return "User Pengusul";
				break;
			case '3':
				return "User Penelaah";
				break;
			case '4':
				return "User SPP";
				break;
			case '5':
				return "User Manajemen";
				break;
			default:
				# code...
				break;
		}
	}

	//fungsi untuk menampilkan tanggal dalam format indonesia
	function  getTfi($tgl){
		$tanggal  =  substr($tgl,8,2);
		$bulan	=  getBulan(substr($tgl,5,2));
		$tahun	=  substr($tgl,0,4);
		return  $tanggal.' '.$bulan.' '.$tahun;
	}

	function  getBulan($bln){
		switch  ($bln){
			case  1:
			return  "Januari";
			break;
			case  2:
			return  "Februari";
			break;
			case  3:
			return  "Maret";
			break;
			case  4:
			return  "April";
			break;
			case  5:
			return  "Mei";
			break;
			case  6:
			return  "Juni";
			break;
			case  7:
			return  "Juli";
			break;
			case  8:
			return  "Agustus";
			break;
			case  9:
			return  "September";
			break;
			case  10:
			return  "Oktober";
			break;
			case  11:
			return  "November";
			break;
			case  12:
			return  "Desember";
			break;
		}
	}

	function romawi($bulanne) {
		switch  ($bulanne){
			case  1:
			return  "I";
			break;
			case  2:
			return  "II";
			break;
			case  3:
			return  "III";
			break;
			case  4:
			return  "IV";
			break;
			case  5:
			return  "V";
			break;
			case  6:
			return  "VI";
			break;
			case  7:
			return  "VII";
			break;
			case  8:
			return  "VIII";
			break;
			case  9:
			return  "IX";
			break;
			case  10:
			return  "X";
			break;
			case  11:
			return  "XI";
			break;
			case  12:
			return  "XII";
			break;
		}
	}

	function getRupiah($value) {
        $format = "Rp " . number_format($value,2,',','.');
        return $format;
    }

	/** function untuk menampilkan kode klasifikasi */
    function getNumber($value) {
		if($value === "") {
			$format = number_format(0,2,',','.');
		} else {
			$format = number_format($value,2,',','.');
		}
        
        return $format;
	}
	
	function getNumberTanpaKoma($value) {
		if($value === "") {
			$format = number_format(0,0,',','.');
		} else {
			$format = number_format($value,0,',','.');
		}
        
        return $format;
    }

	/** fungsi menampilkan exsplode */
	function getId($value) {
		$data 	= explode("-",$value);
		$id		= $data[0];

		return $id;
	}

	function getKode($value) {
		$data 	= explode("-",$value);
		$kode		= $data[1];

		return $kode;
	}


    function getTahun($value) {
    	$kode = substr($value, 0, 4);

    	return $kode;
    }
    
    function getKegiatan($value) {
    	$kode = substr($value, 5, 4);

    	return $kode;
	}
	
	function getOutput($value) {
		$kode = substr($value, 10,3);
		return $kode;
	}

	function getSubOutput($value) {
		$kode = substr($value, 14,3);
		return $kode;
	}

	function getKomponen($value) {
		$kode = substr($value, 18,3);
		return $kode;
	}

	function getSubKomponen($value) {
		$kode = substr($value, 22,1);
		return $kode;
	}

	/** TTTT-KKKK-OOO-SSS-kkkk-s-AAAAAA */
	function getKlasifikasi($level, $value) {
		switch ($level) {
			case  "tahun":
			$kode = substr($value, 0,4);
			return $kode;
			break;

			case "kegiatan":
			$kode = substr($value, 0,9);
			return $kode;
			break;

			case "output":
			$kode = substr($value, 0,13);
			return $kode;
			break;

			case "subOutput":
			$kode = substr($value, 0,17);
			return $kode;
			break;

			case "komponen":
			$kode = substr($value, 0,21);
			return $kode;
			break;

			case "subKomponen";
			$kode = substr($value, 0,23);
			return $kode;
			break;

			case "akun":
			$kode = substr($value, 0,31);
			return $kode;
			break;
		}
		
	}
	
	use App\RkaklTahun as RkaklTahun;
	use App\RkaklKegiatan as RkaklKegiatan;
	use App\RkaklOutput as RkaklOutput;
	use App\RkaklSubOutput as RkaklSubOutput;
	use App\RkaklKomponen as RkaklKomponen;
	use App\RkaklSubKomponen as RkaklSubKomponen;
	use App\RkaklAkun as RkaklAkun;
	use App\RkaklSubAlokasi as RkaklSubAlokasi;
	use App\MstPpk as MstPpk;
	use Illuminate\Support\Facades\DB;

	function getMa($id){
		$subAlokasi = RkaklSubAlokasi::find($id);
		$dataTahun	= RkaklTahun::find($subAlokasi->tahun);
		$dataKegiatan = RkaklKegiatan::find($subAlokasi->id_kegiatan);
		$dataOutput	= RkaklOutput::find($subAlokasi->id_output);
		$dataSubOutput	= RkaklSubOutput::find($subAlokasi->id_sub_output);
		$dataKomponen	= RkaklKomponen::find($subAlokasi->id_komponen);
		$dataSubKomponen	= RkaklSubKomponen::find($subAlokasi->id_sub_komponen);
		$dataAkun 	= RkaklAkun::find($subAlokasi->id_akun);

		$kode = $subAlokasi->kode_kl_satker.'.'.$dataTahun->kode_program.'.'.getKode($dataKegiatan->kode_kegiatan).'.'.getKode($dataOutput->kode_output).'.'.getKode($dataSubOutput->kode_sub_output).'.'.getKode($dataKomponen->kode_komponen).'.'.getKode($dataSubKomponen->kode_sub_komponen).'.'.$dataAkun->kode_akun;

		return $kode;
	}

	function getJenis($id) {
		switch ($id) {
			case "5201":
			return "Barang Cetakan";
			break;

			case "5202":
			return "Barang ATK";
			break;

			case "5203":
			return "Barang Rumah Tangga";
			break;

			case "5204":
			return "Perbekalan Obat";
			break;

			case "5205":
			return "AMHP/BMHP";
			break;

			case "5206":
			return "Belanja Operasional";
			break;

			case "5207":
			return "Belanja Jasa";
			break;

			case "5208":
			return "Belanja Bahan Makanan";
			break;

			case "5301":
			return "Investasi Alat Kesehatan";
			break;

			case "5302":
			return "Investasi Alat Non Kesehatan";
			break;

			case "5303":
			return "Investasi Perangkat Pengolah Data";
			break;
		}
	}

	function getNow(){
		echo date('Y-m-d');
	}

	function terbilang($angka) {
		// pastikan kita hanya berususan dengan tipe data numeric
		$angka = (float)$angka;
		 
		// array bilangan 
		// sepuluh dan sebelas merupakan special karena awalan 'se'
		$bilangan = array(
				'',
				'satu',
				'dua',
				'tiga',
				'empat',
				'lima',
				'enam',
				'tujuh',
				'delapan',
				'sembilan',
				'sepuluh',
				'sebelas'
		);
		 
		// pencocokan dimulai dari satuan angka terkecil
		if ($angka < 12) {
			// mapping angka ke index array $bilangan
			return $bilangan[$angka];
		} else if ($angka < 20) {
			// bilangan 'belasan'
			// misal 18 maka 18 - 10 = 8
			return $bilangan[$angka - 10] . ' belas';
		} else if ($angka < 100) {
			// bilangan 'puluhan'
			// misal 27 maka 27 / 10 = 2.7 (integer => 2) 'dua'
			// untuk mendapatkan sisa bagi gunakan modulus
			// 27 mod 10 = 7 'tujuh'
			$hasil_bagi = (int)($angka / 10);
			$hasil_mod = $angka % 10;
			return trim(sprintf('%s puluh %s', $bilangan[$hasil_bagi], $bilangan[$hasil_mod]));
		} else if ($angka < 200) {
			// bilangan 'seratusan' (itulah indonesia knp tidak satu ratus saja? :))
			// misal 151 maka 151 = 100 = 51 (hasil berupa 'puluhan')
			// daripada menulis ulang rutin kode puluhan maka gunakan
			// saja fungsi rekursif dengan memanggil fungsi terbilang(51)
			return sprintf('seratus %s', terbilang($angka - 100));
		} else if ($angka < 1000) {
			// bilangan 'ratusan'
			// misal 467 maka 467 / 100 = 4,67 (integer => 4) 'empat'
			// sisanya 467 mod 100 = 67 (berupa puluhan jadi gunakan rekursif terbilang(67))
			$hasil_bagi = (int)($angka / 100);
			$hasil_mod = $angka % 100;
			return trim(sprintf('%s ratus %s', $bilangan[$hasil_bagi], terbilang($hasil_mod)));
		} else if ($angka < 2000) {
			// bilangan 'seribuan'
			// misal 1250 maka 1250 - 1000 = 250 (ratusan)
			// gunakan rekursif terbilang(250)
			return trim(sprintf('seribu %s', terbilang($angka - 1000)));
		} else if ($angka < 1000000) {
			// bilangan 'ribuan' (sampai ratusan ribu
			$hasil_bagi = (int)($angka / 1000); // karena hasilnya bisa ratusan jadi langsung digunakan rekursif
			$hasil_mod = $angka % 1000;
			return sprintf('%s ribu %s', terbilang($hasil_bagi), terbilang($hasil_mod));
		} else if ($angka < 1000000000) {
			// bilangan 'jutaan' (sampai ratusan juta)
			// 'satu puluh' => SALAH
			// 'satu ratus' => SALAH
			// 'satu juta' => BENAR 
			// @#$%^ WT*
			 
			// hasil bagi bisa satuan, belasan, ratusan jadi langsung kita gunakan rekursif
			$hasil_bagi = (int)($angka / 1000000);
			$hasil_mod = $angka % 1000000;
			return trim(sprintf('%s juta %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
		} else if ($angka < 1000000000000) {
			// bilangan 'milyaran'
			$hasil_bagi = (int)($angka / 1000000000);
			// karena batas maksimum integer untuk 32bit sistem adalah 2147483647
			// maka kita gunakan fmod agar dapat menghandle angka yang lebih besar
			$hasil_mod = fmod($angka, 1000000000);
			return trim(sprintf('%s milyar %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
		} else if ($angka < 1000000000000000) {
			// bilangan 'triliun'
			$hasil_bagi = $angka / 1000000000000;
			$hasil_mod = fmod($angka, 1000000000000);
			return trim(sprintf('%s triliun %s', terbilang($hasil_bagi), terbilang($hasil_mod)));
		} else {
			return 'Wow...';
		}
	}
?>
