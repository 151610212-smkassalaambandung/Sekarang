<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Barang;

class BarangsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request,Builder $htmlBuilder)
    {
        //
    if ($request->ajax()) {
            $barangs = Barang::with('pegawai');
            return Datatables::of($barangs)->addColumn('action', function($barang){
            return view('datatable._action',[
                'model'     => $barang,
                'form_url'  => route('barangs.destroy', $barang->id),
                'edit_url' => route('barangs.edit', $barang->id),
                'confirm_message'=>'Yakin mau menghapus : '.$barang->title.' ?'
            
                ]);
        })->make(true);
    }
    $html = $htmlBuilder
            ->addColumn(['data'=>'title','name'=>'title','title'=>'nama_barang'])
            ->addColumn(['data'=>'jumlah_barang','name'=>'jumlah_barang','title'=>'jumlah_barang'])
            ->addColumn(['data'=>'pegawai.nama_pegawai','name'=>'pegawai.nama_pegawai','title'=>'Pegawai'])
            ->addColumn(['data'=>'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('barangs.index')->with(compact('html'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
