<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Liblaries\Sesion;
use App\Models\Jadwal as Jadwals;
use App\Models\Film;
use App\Core\Request;

class Jadwal extends Controller
{
	public function __construct()
	{
		(new Sesion)->cekBelum();
	}

	public function index()
	{
		$jadwal = new Jadwals;
		$jadwal = $jadwal->select('jadwal.*, film.nama as nama_film')
			->join('film', 'film.id', 'jadwal.id_film');
		$get = $jadwal->get();
		$film = (new Film)->all();

		$data['title'] = 'Jadwal';
		$data['data'] = $jadwal->result_array($get);
		$data['film'] = $jadwal->result_array($film);

		view('page.jadwal', $data);
	}

	public function insert()
	{
		$film = new Jadwals;
		$request = new Request;

		// Get data post
		$data = $request->post_all();
		unset($data['id']);

		// Create data
		$exe = $film->create($data);

		echo json_encode($exe);
	}

	public function update()
	{
		$film = new Jadwals;
		$request = new Request;

		// Get data post
		$data = $request->post_all();

		// Update data
		$exe = $film->update(['id' => $data['id']], $data);

		echo json_encode($exe);
	}

	public function delete()
	{
		$film = new Jadwals;
		$request = new Request;

		// Delete data
		$exe = $film->delete(['id' => $request->post('id')]);

		echo json_encode($exe);
	}
}