<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Liblaries\Sesion;
use App\Models\Kursi as Kursis;
use App\Models\Studio;
use App\Core\Request;

class Kursi extends Controller
{
    public function __construct()
    {
        (new Sesion)->cekBelum();
    }

    public function index()
    {
        $kursi = new Kursis;
        $kursi = $kursi->select('kursi.*, studio.nama as nama_studio')
            ->join('studio', 'studio.id', 'kursi.id_studio');
        $get = $kursi->get();
        $studio = (new Studio)->all();

        $data['title'] = 'Kursi';
        $data['data'] = $kursi->result_array($get);
        $data['studio'] = $kursi->result_array($studio);

        view('page.kursi', $data);
    }

    public function insert()
    {
        $kursi = new Kursis;
        $request = new Request;

        // Get data post
        $data = $request->post_all();
        unset($data['id']);

        // Create data
        $exe = $kursi->create($data);

        echo json_encode($exe);
    }

    public function update()
    {
        $kursi = new Kursis;
        $request = new Request;

        // Get data post
        $data = $request->post_all();

        // Update data
        $exe = $kursi->update(['id' => $data['id']], $data);

        echo json_encode($exe);
    }

    public function delete()
    {
        $kursi = new Kursis;
        $request = new Request;

        // Delete data
        $exe = $kursi->delete(['id' => $request->post('id')]);

        echo json_encode($exe);
    }
}