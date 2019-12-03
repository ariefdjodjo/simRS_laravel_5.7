<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home');
});

Auth::routes();

	Route::get('/home', function () { return view('home'); });
	Route::get('/status', function () { return view('auth/tidakAktif'); });

Route::group(['middleware' => ['web', 'auth']], function()    
{
	//Route::auth();
	// Authentication Routes...
	Route::get('/', array('as'=>'admin', 'uses'=> 'AdminController@index'));
	Route::get('profile', array('as'=>'profile', 'uses'=>'UserController@profile'));
	
	//route untuk email
	Route::get('email', array('as'=>'Email', 'uses'=>'EmailController@index'));
	Route::post('email/edit', array('as'=>'editEmail', 'uses'=>'EmailController@edit'));

	//pdf
	Route::get('telaah/pdfUsulan/{id}', array('as'=>'pdfUsulan', 'uses'=>'TelaahController@pdfUsulan'));
	Route::get('telaah/pdfTelaah/{id}', array('as'=>'pdfTelaah', 'uses'=>'TelaahController@pdfTelaah'));

	Route::get('loadBarang/{id_barang}', array('as'=>'loadBarang', 'uses'=>'UsulanController@loadBarang'));

});

//route as actor Administrator
Route::group(['middleware' => ['web','auth','level:1', 'status:1']], function(){
	//route untuk unit kerja
	Route::get('/unitKerja/data', array('as'=>'dataUnitKerja', 'uses'=>'MstUnitKerjaController@index'));
	Route::get('/unitKerja/edit/{id}', array('as'=>'editUnitKerja', 'uses'=>'MstUnitKerjaController@edit'));
	Route::get('/unitKerja/create', array('as'=>'mstUnitKerja', 'uses'=>'MstUnitKerjaController@create'));
	Route::post('/unitKerja/tambah', array('as' => 'addUnitKerja', 'uses' => 'MstUnitKerjaController@tambah'));
	Route::post('/unitKerja/update/{id}', array('as' => 'updateUnitKerja', 'uses' => 'MstUnitKerjaController@update'));
	Route::get('/unitKerja/delete/{id}', array('as' => 'deleteUnitKerja', 'uses' => 'MstUnitKerjaController@delete'));

	//route untuk user
	Route::get('user/register', array('as'=>'register', 'uses'=>'Auth\RegisterController@register'));
	Route::post('user/regUser', array('as'=>'createRegister', 'uses'=>'Auth\RegisterController@regUser'));
	Route::get('user/data', array('as'=>'dataUser', 'uses'=>'Auth\RegisterController@index'));
	Route::post('user/setStatus/{id}', array('as'=>'setAktifUser', 'uses' => 'UserController@setStatus'));
	Route::post('user/delete/{id}', array('as'=>'delUser', 'uses' => 'UserController@delete'));
	Route::post('user/editUser/{id}', array('as'=>'editUser', 'uses' => 'UserController@edit'));
	Route::post('user/ubahPassword/{id}', array('as'=>'ubahPassword', 'uses' => 'UserController@ubahPassword'));

	//route untuk mst ppk
	Route::get('mstPpk', array('as'=>'dataPpk', 'uses'=>'MstPpkController@index'));
	Route::post('mstPpk/tambah', array('as'=>'tambahPpk', 'uses'=>'MstPpkController@create'));
	Route::post('mstPpk/setStatus/{id}', array('as'=>'setStatusPpk', 'uses'=>'MstPpkController@setStatus'));
	Route::post('mstPpk/edit/{id}', array('as'=>'editPpk', 'uses'=>'MstPpkController@edit'));
	Route::post('mstPpk/hapus/{id}', array('as'=>'hapusPpk', 'uses'=>'MstPpkController@hapus'));

});

//route untuk actor pengusul
Route::group(['middleware' => ['web','auth','level:2', 'status:1']], function(){
	//route untuk ttd Usulan
	Route::get('ttdUsulan/', array('as'=>'ttdUsulan', 'uses'=>'TtdUsulanController@index'));
	Route::post('ttdUsulan/tambah', array('as'=>'ttdUsulanTambah', 'uses'=>'TtdUsulanController@tambah'));
	Route::post('ttdUsulan/setDefault', array('as'=>'ttdUsulansetDefault', 'uses'=>'TtdUsulanController@setDefault'));
	Route::post('ttdUsulan/edit/{id}', array('as'=>'ttdUsulanEdit', 'uses'=>'TtdUsulanController@edit'));
	Route::post('ttdUsulan/hapus/{id}', array('as'=>'ttdUsulanEdit', 'uses'=>'TtdUsulanController@hapus'));

	//route untuk membuat usulan
	Route::get('usulan/', array('as'=>'usulan', 'uses'=>'UsulanController@index'));
	Route::get('usulan/draftUsulan/{tahun}', array('as'=>'draftUsulan', 'uses'=>'UsulanController@draftUsulan'));
	Route::get('usulan/dataUsulan/{tahun}', array('as'=>'dataUsulan', 'uses'=>'UsulanController@dataUsulan'));
	Route::get('tambahUsulan/', array('as'=>'tambahUsulan', 'uses'=>'UsulanController@tambah'));
	Route::get('editUsulan/{id}', array('as'=>'editUsulan', 'uses'=>'UsulanController@edit'));
	Route::post('usulan/prosesTambah/', array('as'=>'prosesTambah', 'uses'=>'UsulanController@prosesTambah'));
	Route::post('usulan/prosesEdit/{id}', array('as'=>'prosesEdit', 'uses'=>'UsulanController@prosesEdit'));
	Route::get('tambahItemBarang/{id}', array('as'=>'addItem', 'uses'=>'UsulanController@addItem'));
	
	
	Route::post('usulan/tambahLampiran/{id}', array('as'=>'uploadLampiran', 'uses'=>'UsulanController@uploadLampiran'));
	Route::get('hapusLampiran/{id}/{idFile}', array('as'=>'uploadLampiran', 'uses'=>'UsulanController@hapusLampiran'));
	Route::post('usulan/tambahBarang/{id}', array('as'=>'tambahBarang', 'uses'=>'UsulanController@tambahBarang'));
	Route::post('usulan/editBarang/{id}/{id_usulan}', array('as'=>'editBarang', 'uses'=>'UsulanController@editBarang'));
	Route::get('usulan/hapusBarang/{idBarang}/{idUsulan}', array('as'=>'hapusBarang', 'uses'=>'UsulanController@hapusBarang'));

	Route::get('usulan/detail/{id}', array('as'=>'detail', 'uses'=>'UsulanController@detail'));
	Route::get('usulan/kirim/{id}', array('as'=>'kirim', 'uses'=>'UsulanController@kirim'));

	Route::get('rekapUsulan/{tahun}', array('as'=>'rekap', 'uses'=>'UsulanController@rekap'));
	Route::get('rekapUsulan/pdf/{tahun}', array('as'=>'rekap', 'uses'=>'UsulanController@pdfRekap'));
	Route::get('eksportUsulan/{tahun}', array('as'=>'eksport', 'uses'=>'UsulanController@eksportUsulan'));

	Route::get('rekapDetailUsulan/{tahun}/{jenis}', array('as'=>'rekap', 'uses'=>'UsulanController@rekapDetail'));
	Route::get('rekapDetailUsulan/pdf/{tahun}/{jenis}', array('as'=>'rekap', 'uses'=>'UsulanController@pdfRekapDetail'));
});

//route untuk Actor penelaah
Route::group(['middleware' => ['web','auth','level:3', 'status:1']], function(){
	//route untuk ttd telaah
	Route::get('ttdTelaah/', array('as'=>'TtdTelaah', 'uses'=>'TtdTelaahController@index'));
	Route::post('ttdTelaah/tambah', array('as'=>'TtdTelaahTambah', 'uses'=>'TtdTelaahController@tambah'));
	Route::post('ttdTelaah/setDefault', array('as'=>'TtdTelaahsetDefault', 'uses'=>'TtdTelaahController@setDefault'));
	Route::post('ttdTelaah/edit/{id}', array('as'=>'TtdTelaahEdit', 'uses'=>'TtdTelaahController@edit'));
	Route::post('ttdTelaah/hapus/{id}', array('as'=>'TtdTelaahEdit', 'uses'=>'TtdTelaahController@hapus'));

	//Route untuk master barang
	Route::get('masterBarang/', array('as'=>'MasterBarang', 'uses'=>'MstBarangController@index'));
	Route::get('masterBarang/detail/{jenis}', array('as'=>'JenisMasterBarang', 'uses'=>'MstBarangController@detailMaster'));
	Route::post('masterBarang/tambah', array('as'=>'masterBarangTambah', 'uses'=>'MstBarangController@tambah'));
	Route::post('masterBarang/edit/{id}', array('as'=>'MasterBarangEdit', 'uses'=>'MstBarangController@edit'));
	Route::post('masterBarang/hapus/{id}', array('as'=>'MasterBarangEdit', 'uses'=>'MstBarangController@hapus'));

	//Route untuk Standart Biaya
	Route::get('standarBiaya/{tahun}', array('as'=>'MasterStandarBiaya', 'uses'=>'MstStandarBiayaController@index'));
	Route::get('standarBiaya/tambah/{tahun}', array('as'=>'MasterStandarBiaya', 'uses'=>'MstStandarBiayaController@tambah'));
	Route::post('standarBiaya/tambahProses/{tahun}', array('as'=>'MasterStandarBiayaTambah', 'uses'=>'MstStandarBiayaController@tambahProses'));
	Route::get('standarBiaya/edit/{tahun}/{id}', array('as'=>'MasterStandarBiayaEdit', 'uses'=>'MstStandarBiayaController@edit'));
	Route::post('standarBiaya/prosesEdit/{tahun}', array('as'=>'MasterStandarBiayaEdit', 'uses'=>'MstStandarBiayaController@prosesEdit'));
	Route::get('standarBiaya/hapus/{tahun}/{id}', array('as'=>'MasterStandarBiayaHapus', 'uses'=>'MstStandarBiayaController@hapus'));

	//usulan masuk
	Route::get('telaah/usulanMasuk/{kriteria}/{tahun}', array('as'=>'usulanMasuk', 'uses'=>'TelaahController@usulanMasuk'));
	Route::get('telaah/baca/{id}', array('as'=>'baca', 'uses'=>'TelaahController@baca'));
	Route::get('telaah/detailUsulan/{id}', array('as'=>'detailUsulan', 'uses'=>'TelaahController@detailUsulan'));
	Route::get('telaah/rekapUsulan/{tahun}', array('as'=>'detailUsulan', 'uses'=>'TelaahController@rekapUsulan'));
	Route::get('rekapDetailUsulan/{tahun}/{jenis}', array('as'=>'detailUsulanJenis', 'uses'=>'TelaahController@rekapUsulanJenis'));

	//telaah
	Route::get('telaah/tambahTelaah/{id}', array('as'=>'tambahTelaah', 'uses'=>'TelaahController@tambahTelaah'));
	Route::post('telaah/tambahTelaah/tambah', array('as'=>'prosesTambahTelaah', 'uses'=>'TelaahController@prosesTambahTelaah'));
	Route::get('telaah/tambahTelaah/{id}/detailTelaah', array('as'=>'analisisHarga', 'uses'=>'TelaahController@detailTelaah'));
	Route::get('telaah/tambahTelaah/{id}/analisisHarga', array('as'=>'analisisHarga', 'uses'=>'TelaahController@analisisHarga'));
	Route::get('telaah/tambahTelaah/{id}/analisisHarga/proses', array('as'=>'analisisHargaProses', 'uses'=>'TelaahController@prosesAnalisis'));
	Route::get('telaah/loadUsulan/{tahun}', array('as'=>'loadUsulan', 'uses'=>'TelaahController@loadUsulan'));
	Route::post('telaah/ubahHarga/{idBarang}/{idUsulan}', array('as'=>'prosesTambahTelaah', 'uses'=>'TelaahController@prosesUbah'));
	Route::get('telaah/tambahTelaah/{id}/analisisKebutuhan', array('as'=>'analisisKebutuhan', 'uses'=>'TelaahController@analisisKebutuhan'));
	Route::post('telaah/analisisKebutuhanProses', array('as'=>'prosesTambahTelaah', 'uses'=>'TelaahController@prosesUpdateKebutuhan'));
	Route::get('telaah/selesai/{id}', array('as'=>'telaahSelesai', 'uses'=>'TelaahController@telaahSelesai'));
	Route::get('telaah/kirim/{id}', array('as'=>'kirimTelaah', 'uses'=>'TelaahController@kirimTelaah'));
	Route::post('telaah/editTelaah/{id}', array('as'=>'editTelaah', 'uses'=>'TelaahController@editTelaah'));
	
	//Telaah Data
	Route::get('telaah/draftTelaah/{tahun}', array('as'=>'telaahDraft', 'uses'=>'TelaahController@draftTelaah'));
	Route::get('telaah/daftarTelaah/{tahun}', array('as'=>'daftarTelaah', 'uses'=>'TelaahController@daftarTelaah'));
});

//route untuk Actor spp
Route::group(['middleware' => ['web','auth','level:4', 'status:1']], function(){
	//route tahun
	Route::get('klasifikasi/', array('as'=>'klasifikasi', 'uses'=>'RkaklTahunController@index'));
	Route::post('klasifikasi/prosesAdd', array('as'=>'klasifikasiTahunAdd', 'uses'=>'RkaklTahunController@prosesAdd'));
	Route::post('klasifikasi/prosesEdit/{id}', array('as'=>'klasifikasiTahunEdit', 'uses'=>'RkaklTahunController@prosesEdit'));
	Route::post('klasifikasi/prosesHapus/{id}', array('as'=>'klasifikasiTahunHapus', 'uses'=>'RkaklTahunController@prosesHapus'));

	//route kegiatan
	Route::get('klasifikasi/{tahun}', array('as'=>'dataKegiatan', 'uses'=>'RkaklKegiatanController@index'));
	Route::post('klasifikasi/keg/prosesAdd', array('as'=>'klasifikasiKegAdd', 'uses'=>'RkaklKegiatanController@prosesAdd'));
	Route::post('klasifikasi/keg/prosesEdit/{id}', array('as'=>'klasifikasiKegEdit', 'uses'=>'RkaklKegiatanController@prosesEdit'));
	Route::post('klasifikasi/keg/prosesHapus/{tahun}/{id}', array('as'=>'klasifikasiKegHapus', 'uses'=>'RkaklKegiatanController@prosesHapus'));

	//route untuk output
	Route::get('klasifikasi/{tahun}/{keg}', array('as'=>'dataOutput', 'uses'=>'RkaklOutputController@index'));
	Route::post('klasifikasi/output/prosesAdd', array('as'=>'klasifikasiOutputAdd', 'uses'=>'RkaklOutputController@prosesAdd'));
	Route::post('klasifikasi/output/prosesEdit/{id}', array('as'=>'klasifikasiOutputEdit', 'uses'=>'RkaklOutputController@prosesEdit'));
	Route::post('klasifikasi/output/prosesHapus/{id}', array('as'=>'klasifikasiOutputHapus', 'uses'=>'RkaklOutputController@prosesHapus'));

	/** Route untuk sub output */
	Route::get('klasifikasi/{tahun}/{keg}/{output}', array('as'=>'dataSubOutput', 'uses'=>'RkaklSubOutputController@index'));
	Route::post('klasifikasi/subOutput/prosesAdd', array('as'=>'klasifikasiSubOutputAdd', 'uses'=>'RkaklSubOutputController@prosesAdd'));
	Route::post('klasifikasi/subOutput/prosesEdit/{id}', array('as'=>'klasifikasiSubOutputEdit', 'uses'=>'RkaklSubOutputController@prosesEdit'));
	Route::post('klasifikasi/subOutput/prosesHapus/{id}', array('as'=>'klasifikasiSubOutputHapus', 'uses'=>'RkaklSubOutputController@prosesHapus'));

	/** Route untuk Komponen */
	Route::get('klasifikasi/{tahun}/{keg}/{output}/{subOutput}', array('as'=>'dataKomponen', 'uses'=>'RkaklKomponenController@index'));
	Route::post('klasifikasi/komponen/prosesAdd', array('as'=>'klasifikasiKomponenAdd', 'uses'=>'RkaklKomponenController@prosesAdd'));
	Route::post('klasifikasi/komponen/prosesEdit/{id}', array('as'=>'klasifikasiKomponenEdit', 'uses'=>'RkaklKomponenController@prosesEdit'));
	Route::post('klasifikasi/komponen/prosesHapus/{id}', array('as'=>'klasifikasiKomponenHapus', 'uses'=>'RkaklKomponenController@prosesHapus'));

	/** Route untuk sub Komponen */
	Route::get('klasifikasi/{tahun}/{keg}/{output}/{subOutput}/{komponen}', array('as'=>'dataSubKomponen', 'uses'=>'RkaklSubKomponenController@index'));
	Route::post('klasifikasi/subKomponen/prosesAdd', array('as'=>'klasifikasiSubKomponenAdd', 'uses'=>'RkaklSubKomponenController@prosesAdd'));
	Route::post('klasifikasi/subKomponen/prosesEdit/{id}', array('as'=>'klasifikasiSubKomponenEdit', 'uses'=>'RkaklSubKomponenController@prosesEdit'));
	Route::post('klasifikasi/subKomponen/prosesHapus/{id}', array('as'=>'klasifikasiSubKomponenHapus', 'uses'=>'RkaklSubKomponenController@prosesHapus'));

	//route master akun
	Route::get('akun/{tahun}', array('as'=>'dataAkun', 'uses'=>'RkaklAkunController@index'));
	Route::post('akun/addAkun', array('as'=>'addAkun', 'uses'=>'RkaklAkunController@addAkun'));
	Route::post('akun/editAkun', array('as'=>'editAkun', 'uses'=>'RkaklAkunController@editAkun'));
	Route::post('akun/hapusAkun/{id}/{tahun}', array('as'=>'hapusAkun', 'uses'=>'RkaklAkunController@hapusAkun'));

	//route untuk sub Alokasi
	Route::get('detailSA/{id}', array('as'=>'detailSubAlokasi', 'uses'=>'RkaklSubAlokasiController@detailSa'));
	Route::get('editSA/{id}', array('as'=>'detailSubAlokasi', 'uses'=>'RkaklSubAlokasiController@editSA'));
	Route::get('klasifikasi/{tahun}/{keg}/{output}/{subOutput}/{komponen}/{subKomponen}', array('as'=>'dataSubAlokasi', 'uses'=>'RkaklSubAlokasiController@index'));
	Route::get('klasifikasi/addSA/{tahun}/{keg}/{output}/{subOutput}/{komponen}/{subKomponen}', array('as'=>'addSubAlokasi', 'uses'=>'RkaklSubAlokasiController@addSA'));
	Route::post('klasifikasi/addSubAlokasi', array('as'=>'addSubAlokasi', 'uses'=>'RkaklSubAlokasiController@addSubAlokasi'));
	Route::post('klasifikasi/prosesEdit/{id}', array('as'=>'editSA', 'uses'=>'RkaklSubAlokasiController@prosesEdit'));
	Route::post('klasifikasi/prosesHapus/{id}', array('as'=>'prosesHapus', 'uses'=>'RkaklSubAlokasiController@prosesHapus'));
	Route::get('pagu/{th}', array('as'=>'dataAlokasi', 'uses'=>'RkaklSubAlokasiController@dataAlokasi'));

	//route untuk data penandatangan SP
	Route::get('ttdSp/', array('as'=>'TtdSpp', 'uses'=>'TtdSppController@index'));
	Route::post('ttdSp/tambah', array('as'=>'TtdSppTambah', 'uses'=>'TtdSppController@tambah'));
	Route::post('ttdSp/setDefault', array('as'=>'TtdSppsetDefault', 'uses'=>'TtdSppController@setDefault'));
	Route::post('ttdSp/edit/{id}', array('as'=>'TtdSppEdit', 'uses'=>'TtdSppController@edit'));
	Route::post('ttdSp/hapus/{id}', array('as'=>'TtdSppEdit', 'uses'=>'TtdSppController@hapus'));

	Route::get('spp/usulan/{tahun}', array('as'=>'SppUsulan', 'uses'=>'UsulanController@dataUsulanSpp'));
	Route::get('spp/detail/{id}', array('as'=>'detail', 'uses'=>'UsulanController@detail'));

	Route::get('spp/telaah/{tahun}', array('as'=>'daftarTelaah', 'uses'=>'TelaahController@daftarTelaah'));
	Route::get('spp/telaah/{id}/detail', array('as'=>'detailTelaah', 'uses'=>'TelaahController@telaahSelesai'));
	Route::get('loadUsulanTelaah/{id}', array('as'=>'loadUsulanTelaah', 'uses'=>'SpController@loadUsulanTelaah'));
	
	Route::get('spp/tambah/step1/{id}', array('as'=>'tambahSp1', 'uses'=>'SpController@step1'));
	Route::post('spp/pilihTahun', array('as' => 'PilihTahun', 'uses'=>'spController@pilihTahun'));
	Route::get('spp/tambah/step2/{tahun}/{id}', array('as'=>'tambahSp2', 'uses'=>'SpController@step2'));
	Route::post('spp/simpanSp', array('as' => 'tambahSp2', 'uses'=>'spController@simpanSp'));
	Route::get('spp/tambah/step3/{tahun}/{id}', array('as'=>'tambahSp3', 'uses'=>'SpController@step3'));

	//report
	Route::get('Laporan/{tahun}', array('as'=>'TtdSpp', 'uses'=>'RkaklSubAlokasiController@treeView'));
	Route::get('coba/treeGrid', array('as'=>'treeGrid', 'uses'=>'RkaklSubAlokasiController@treeGrid'));
});

//route untuk Actor manajemen
Route::group(['middleware' => ['web','auth','level:5', 'status:1']], function(){

});


