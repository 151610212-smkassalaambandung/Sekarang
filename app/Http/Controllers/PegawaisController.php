<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pegawai;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class PegawaisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if($request->ajax()){
            $pegawais=Pegawai::select(['id','nama_pegawai']);
           return Datatables::of($pegawais)
                ->addColumn('action' , function($pegawai){
                    return view('datatable._action',[
                    'model'=>$pegawai,
                    'form_url'=>route('pegawais.destroy', $pegawai->id),
                    'edit_url' => route('pegawais.edit', $pegawai->id),
                    'confirm_message'=> 'Yakin mau menghapus' . $pegawai->nama_pegawai .'?'

                 ]);
                })->make(true);
        }

        $html=$htmlBuilder
            ->addColumn(['data'=>'nama_pegawai','name'=>'nama_pegawai','title'=>'Nama Pegawai'])
            ->addColumn(['data'=>'action','nama_pegawai'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

                return view('pegawais.index')->with(compact('html'));
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pegawais.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nama_pegawai'=>'required|unique:pegawais']);
        $pegawai= Pegawai::create($request->only('nama_pegawai'));
        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $pegawai->nama_pegawai"
            ]);
        return redirect()->route('pegawais.index');
    
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
        $pegawai=Pegawai::find($id);
        return view('pegawais.edit')->with(compact('pegawai'));
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
            $this->validate($request, ['nama_pegawai'=>'required|unique:pegawais']);
            $pegawai=Pegawai::find($id);
            $pegawai->update($request->only('nama_pegawai'));
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $pegawai->nama_pegawai"
            ]);
            return redirect()->route('pegawais.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Pegawai::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"pegawai berhasil dihapus"
        ]);
        return redirect()->route('pegawais.index');
    }
}
