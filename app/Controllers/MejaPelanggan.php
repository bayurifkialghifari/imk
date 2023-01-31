<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Liblaries\Sesion;
use App\Models\Meja;
use App\Models\Meja_pelanggan;
use App\Models\Pelanggan;
use App\Core\Request;

class MejaPelanggan extends Controller
{
    public function __construct()
    {
        Sesion::cekBelum();
    }

    public function index()
    {
        $meja = new Meja;
        $pelanggan = new Pelanggan;
        $meja_pelanggan = new Meja_pelanggan;
        $get = $meja->all();

        $data['title'] = 'Meja Pelanggan';
        $data['data'] = $meja->result_array($get);
        $data['mejap'] = $meja_pelanggan;

        view('page.meja-pelanggan', $data);
    }

    // Isi meja
    public function isi_meja()
    {
        $meja_pelanggan = new Meja_pelanggan;
        $pelanggan = new Pelanggan;
        $request = new Request;

        // Get data post
        $data = $request->post_all();

        // Create pelanggan
        $newpelanggan = $pelanggan->create([
            'atas_nama' => $data['atas_nama'],
            'jumlah' => $data['jumlah']
        ]);
        // Get id pelanggan
        $id_pelanggan = $pelanggan->select('max(id) as id')->get();
        $id_pelanggan = $id_pelanggan->fetch_assoc();
        $id_pelanggan = $id_pelanggan['id'];

        // Create meja pelanggan
        $newmejap = $meja_pelanggan->create([
            'id_meja' => $data['id'],
            'id_pelanggan' => $id_pelanggan,
            'status' => 'Active',
        ]);


        echo json_encode($newjap);
    }

    // Batal isi meja
    public function batal_isi()
    {
        $meja_pelanggan = new Meja_pelanggan;
        $request = new Request;

        // Get data id
        $id = $request->post('id');

        $exe = $meja_pelanggan->update(['id_meja' => $id], [
            'status' => 'Not Active',
        ]);

        echo json_encode($exe);
    }
}