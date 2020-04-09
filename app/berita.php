<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class berita extends Model {

    protected $table = 'tb_berita';

    protected $fillable = [
        'id_berita', 'judul_berita', 'gambar_berita', 'id_kategori', 'isi_berita'
    ];

}