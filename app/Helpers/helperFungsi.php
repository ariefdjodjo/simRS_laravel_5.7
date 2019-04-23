<?php
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
        $format = number_format($value,2,',','.');
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
			return "Jasa";
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
?>
