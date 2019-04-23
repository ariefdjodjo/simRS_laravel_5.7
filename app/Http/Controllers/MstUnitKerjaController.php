<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MstUnitKerja;

class MstUnitKerjaController extends Controller
{
    public function __construct()
    {
        $this->middleware('level:1');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan data unit kerja
        $unitKerja=\App\MstUnitKerja::all();
        return view('admin.dashboard.unitKerja.unitKerja',compact('unitKerja'));   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.dashboard.unitKerja.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function tambah(Request $request)
    {
        $unitKerja = new MstUnitKerja();
        $unitKerja->nama_unit_kerja = $request->nama_unit_kerja;
        $unitKerja->no_telp = $request->no_telp;
        $unitKerja->email_unit_kerja = $request->email_unit_kerja;
        $unitKerja->kode_agenda_satker = $request->kode_agenda_satker;
        $unitKerja->save();

        return Redirect('unitKerja/data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //form edit unit kerja
        $data = MstUnitKerja::find($id);
        return view('admin.dashboard.unitKerja.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //proses edit data
        $unitKerja = MstUnitKerja::find($id);
        $unitKerja->nama_unit_kerja = $request->nama_unit_kerja;
        $unitKerja->no_telp = $request->no_telp;
        $unitKerja->email_unit_kerja = $request->email_unit_kerja;
        $unitKerja->kode_agenda_satker = $request->kode_agenda_satker;
        $unitKerja->update();

        return Redirect('unitKerja/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //menghapus unit kerja
        $unitKerja = MstUnitKerja::WHERE('id_unit_kerja', '=', $id);
        if($unitKerja == null) 
            app::abort(404);
        $unitKerja->delete();
        return Redirect('unitKerja/data');
    }
}
