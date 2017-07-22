<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Konsumen;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use Session;

class konsumensController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Builder $htmlBuilder)
    {
        if($request->ajax()){
            $konsumens=Konsumen::select(['id','nama_konsumen']);
           return Datatables::of($konsumens)
                ->addColumn('action' , function($konsumen){
                    return view('datatable._action',[
                    'model'=>$konsumen,
                    'form_url'=>route('konsumens.destroy', $konsumen->id),
                    'edit_url' => route('konsumens.edit', $konsumen->id),
                    'confirm_message'=> 'Yakin mau menghapus' . $konsumen->nama_konsumen .'?'

                 ]);
                })->make(true);
        }

        $html=$htmlBuilder
            ->addColumn(['data'=>'nama_konsumen','name'=>'nama_konsumen','title'=>'Nama Konsumen'])
            ->addColumn(['data'=>'action','nama_konsumen'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);

                return view('konsumens.index')->with(compact('html'));
        }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('konsumens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, ['nama_konsumen'=>'required|unique:konsumens']);
        $konsumen= Konsumen::create($request->only('nama_konsumen'));
        Session::flash("flash_notification",[
            "level"=>"success",
            "message"=>"Berhasil menyimpan $konsumen->nama_konsumen"
            ]);
        return redirect()->route('konsumens.index');
    
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
        $konsumen=Konsumen::find($id);
        return view('konsumens.edit')->with(compact('konsumen'));
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
            $this->validate($request, ['nama_konsumen'=>'required|unique:konsumens']);
            $konsumen=Konsumen::find($id);
            $konsumen->update($request->only('nama_konsumen'));
            Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $konsumen->nama_konsumen"
            ]);
            return redirect()->route('konsumens.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Konsumen::destroy($id)) return redirect()->back();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"konsumen berhasil dihapus"
        ]);
        return redirect()->route('konsumens.index');
    }
}
