<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Liblaries\Sesion;
use App\Models\Tiket as Tikets;
use App\Models\Studio;
use App\Core\Request;
use App\Models\Film;
use App\Models\Jadwal;
use App\Models\Kursi;

class Tiket extends Controller
{
    public function __construct()
    {
        Sesion::cekBelum();
    }

    public function index()
    {
        $tiket = new Tikets;
        $tiket = $tiket->select('tiket.*, jadwal.tanggal as tanggal, jadwal.jam as jam, film.nama as film, kursi.no as no_kursi')
            ->join('jadwal', 'jadwal.id', 'tiket.id_jadwal')
            ->join('film', 'jadwal.id_film', 'film.id')
            ->join('kursi', 'kursi.id', 'tiket.id_kursi');
        $get = $tiket->get();
        $jadwal = (new Jadwal)->select('jadwal.*, film.nama as film')->join('film', 'jadwal.id_film', 'film.id')->get();
        $kursi = (new Kursi)->all();

        $data['title'] = 'Kursi';
        $data['data'] = $tiket->result_array($get);
        $data['jadwal'] = $tiket->result_array($jadwal);
        $data['kursi'] = $tiket->result_array($kursi);

        view('page.tiket', $data);
    }

    public function insert()
    {
        $tiket = new Tikets;
        $request = new Request;

        // Get data post
        $data = $request->post_all();
        unset($data['id']);

        // Create data
        $exe = $tiket->create($data);

        echo json_encode($exe);
    }

    public function update()
    {
        $tiket = new Tikets;
        $request = new Request;

        // Get data post
        $data = $request->post_all();

        // Update data
        $exe = $tiket->update(['id' => $data['id']], $data);

        echo json_encode($exe);
    }

    public function delete()
    {
        $tiket = new Tikets;
        $request = new Request;

        // Delete data
        $exe = $tiket->delete(['id' => $request->post('id')]);

        echo json_encode($exe);
    }
}