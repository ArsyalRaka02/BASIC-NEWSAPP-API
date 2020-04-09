<?php

namespace App\Http\Controllers;

use App\kategori;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class kategoriController extends Controller {

    public function view(){
        $data = kategori::all();
        return response($data);
    }

    public function viewId($id){
        $data = kategori::where('id_kategori', $id)->first();

        if($data){
            return response()->json([
                'success' => true,
                'massage' => 'kategori found !!',
                'data'    => $data
            ], 200);
        }else {
            return response()->json([
                'succes'  => false,
                'massage' => 'kategori not found !!',
                'data'    => ''
            ], 400);
        }
    }
    
    public function create(Request $request){
        $kategori = $request->input('nama_kategori');

        $create = kategori::create([
            'nama_kategori' => $kategori
        ]);

        if($create){
            return response()->json([
                'succes'  => true,
                'massage' => 'data telah di tambah',
                'data'    => $create
            ], 201);
        }else {
            return response()->json([
                'succes'  => false,
                'massage' => 'data gagal di tambah',
                'data'    => ''
            ], 400);
        }

    }

    public function update(Request $request, $id){
	$kategori = $request->input('nama_kategori');	
	
        $update = DB::table('tb_kategori')->update([
		'nama_kategori' => $kategori
	]);
	
        if($update){
            return response()->json([
                'success'  => true,
                'massage'    => 'Update Berhasil'
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'massage' => 'data belum di update'
            ]);
        }

    }

    public function destroy($id){
        $data = kategori::where('id_kategori', $id);

        if($data->delete()){
            return response()->json([
                'success' => true,
                'massage' => 'data telah di hapus !!'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'data gagal di hapus !!'
            ], 400);
        }
    }

}