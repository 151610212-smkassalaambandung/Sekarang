<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Html\Builder;
use Yajra\Datatables\Datatables;
use App\Furnitur;
use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Session;

class furnitursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index(Request $request, Builder $htmlBuilder)
    {
        if ($request->ajax()) {
        $furniturs = Furnitur::with('konsumen');
        return Datatables::of($furniturs)
        ->addColumn('action', function($furnitur){
        return view('datatable._action', [
            'model' => $furnitur,
            'form_url' => route('furniturs.destroy', $furnitur->id),
            'edit_url' => route('furniturs.edit', $furnitur->id),
            'confirm_message' => 'Yakin mau menghapus ' . $furnitur->id . '?'
            ]);
        })->make(true);
        }
        $html = $htmlBuilder
        ->addColumn(['data' => 'nama_furnitur', 'name'=>'nama_furnitur', 'title'=>'Nama furnitur'])
        ->addColumn(['data' => 'konsumen.nama_konsumen', 'name'=>'konsumen.nama_konsumen', 'title'=>'konsumen'])
        ->addColumn(['data' => 'jumlah_furnitur', 'name'=>'jumlah_furnitur', 'title'=>'Jumlah furnitur'])
        ->addColumn(['data' => 'harga_furnitur', 'name'=>'harga_furnitur', 'title'=>'Harga furnitur'])
        ->addColumn(['data' => 'action', 'name'=>'action', 'title'=>'', 'orderable'=>false, 'searchable'=>false]);
        return view('furniturs.index')->with(compact('html'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('furniturs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'nama_furnitur' =>'required|unique:furniturs,nama_furnitur',
            'konsumen_id'=>'required|exists:konsumens,id',
            'jumlah_furnitur'=>'required|numeric',
            'harga_furnitur'=>'required|numeric',
            'cover'=>'image|max:10000'
            ]);  
        $furnitur = Furnitur::create($request->except('cover'));
        //isi file cover jika ada cover yang di upload
        if($request->hasFile('cover')) {
            //mengambil file yang di upload
            $uploded_cover = $request->file('cover');
            //mengambil extensi file
            $extension = $uploded_cover->getClientOriginalExtension();
            //membuat nama file random berikut extensi
            $filename=md5(time()) .'.'. $extension;
            //menyimpan cover ke folder public/img
            $destinationPath = public_path() . DIRECTORY_SEPARATOR .'img';
            $uploded_cover->move($destinationPath,$filename);
            //mengisi field cover di book dengan file name yang baru di buat
            $furnitur->cover = $filename;
            $furnitur->save();
        }
        Session::flash("flash_notification", [
            "level"=>"success",
            "message"=>"Berhasil menyimpan $furnitur->nama_furnitur"
            ]);
        return redirect()->route('furniturs.index');
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
         $furnitur =Furnitur::find($id);
        return view('furniturs.edit')->with(compact('furnitur'));
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
        $this->validate($request, [
        'nama_furnitur' => 'required|unique:furniturs,nama_furnitur,' . $id,
        'konsumen_id' => 'required|exists:konsumens,id',
        'jumlah_furnitur' => 'required|numeric',
        'harga_furnitur' => 'required|numeric',
        'cover' => 'image|max:2048'
        ]);
        $furnitur = Furnitur::find($id);
        $furnitur->update($request->all());
        if ($request->hasFile('cover')) {
        // menambil cover yang diupload berikut ekstensinya
        $filename = null;
        $uploaded_cover = $request->file('cover');
        $extension = $uploaded_cover->getClientOriginalExtension();
        // membuat nama file random dengan extension
        $filename = md5(time()) . '.' . $extension;
        $destinationPath = public_path() . DIRECTORY_SEPARATOR . 'img';
        // memindahkan file ke folder public/img
        $uploaded_cover->move($destinationPath, $filename);
        // hapus cover lama, jika ada
        if ($furnitur->cover) {
        $old_cover = $furnitur->cover;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $furnitur->cover;
        try {
        File::delete($filepath);
        } catch (FileNotFoundException $e) {
        // File sudah dihapus/tidak ada
        }
        }
        // ganti field cover dengan cover yang baru
        $furnitur->cover = $filename;
        $furnitur->save();
        }
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan $furnitur->nama_furnitur"
        ]);
        return redirect()->route('furniturs.index');

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

        $furnitur = Furnitur::find($id);
        // hapus cover lama, jika ada
        if ($furnitur->cover) {
        $old_cover = $furnitur->cover;
        $filepath = public_path() . DIRECTORY_SEPARATOR . 'img'
        . DIRECTORY_SEPARATOR . $furnitur->cover;
        try {
        File::delete($filepath);
        } catch (FileNotFoundException $e) {
        // File sudah dihapus/tidak ada
        }
        }
        $furnitur->delete();
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Buku berhasil dihapus"
        ]);
        return redirect()->route('furniturs.index');
            }
}
