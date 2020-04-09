<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\berita;
use App\kategori;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class BeritaController extends Controller {

    public function view(){
        $get = berita::all();
    
        if($get == null){
            return response()->json([
                'success' => false,
                'massage' => 'data tidak ada!!' 
            ]);
        }else {
            return response()->json([
                'success' => true,
                'result' => $get,
            ]);
        }

    }

    public function viewId($id){
        $data = berita::where('id_berita', $id)->first();

        if($data){
            return response()->json([
                'success' => true,
                'massage' => 'berita di temukan!!',
                'data'    => $data
            ]);
        }else {
            return response()->json([
                'succes'  => false,
                'massage' => 'berita tidak di temukan!!',
                'data'    => ''
            ]);
        }

    }

    public function create(Request $request){

        $judul = $request->input('judul_berita');
        $isiBerita = $request->input('isi_berita');
        $gambar    = $request->input('gambar_berita');
        $namaKategori = $request->input('nama_kategori');

        $kategori = DB::table('tb_kategori')->where('nama_kategori',$namaKategori)->first();

        if($kategori == null){
            return response()->json([
                'massage' => 'Kategori tidak ada!!',
            ], 201);
        }

        $tambah = DB::table('tb_berita')->insert([
            'judul_berita'  => $judul,
            'gambar_berita' => $gambar,
            'isi_berita'    => $isiBerita,
            'id_kategori'   => $kategori->id_kategori
        ]);

        if ($tambah){
            return response()->json([
                'success' => true,
                'massage' => 'Tambah Berhasil!!'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'massage' => 'Tambah Gagal!!',
                'data'    => ''
            ]);
        }
    }

    public function destroy($id){
        $data = Berita::where('id_berita', $id);
        if ($data->delete()){
            return response()->json([
                'success' => true,
                'massage' => 'Delete Berhasil!!'
            ]);
        }
        else {
            return response()->json([
                'success' => false,
                'massage' => 'delete Gagal!!'
            ]);
        }
    }

    public function update(Request $request, $id){

        $judul = $request->input('judul_berita');
        $gambar = $request->input('gambar_berita');
        $kategori = $request->input('nama_kategori');
        $berita   = $request->input('isi_berita');

        $getKategori = DB::table('tb_kategori')->where('nama_kategori',$kategori)->first();

        if($getKategori == null){
            return response()->json([
                'massage' => 'Kategori tidak ada!!',
            ], 201);
        }

        $update = DB::table('tb_berita')->update([
            'judul_berita'  => $judul,
            'gambar_berita' => $gambar,
            'isi_berita'    => $berita,
            'id_kategori'   => $getKategori->id_kategori
        ]);

        if($update){
            return response()->json([
                'success' => true,
                'massage' => 'data sudah di update'
            ]);
        }else {
            return response()->json([
                'success' => false,
                'massage' => 'data gagal di update'
            ]);
        }
    }

    public function getKategory($id){
        $data = DB::table('tb_berita')->where('id_kategori',$id)->get();

        if ($data == null){
            return response()->json([
                'data' => 'data tidak ada !!'
            ]);
        }
        else {
            return response()->json([
                'result' => $data
            ]);
        }
    }

}