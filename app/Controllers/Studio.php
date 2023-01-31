<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Liblaries\Sesion;
use App\Models\Studio as Studios;
use App\Core\Request;

class Studio extends Controller
{
	public function __construct()
	{
		Sesion::cekBelum();
	}

	public function index()
	{
		$studio = new Studios;
		$get = $studio->all();

		$data['title'] = 'Studio';
		$data['data'] = $studio->result_array($get);

		view('page.studio', $data);
	}

	public function insert()
	{
		$studio = new Studios;
		$request = new Request;

		// Get data post
		$data = $request->post_all();
		unset($data['id']);

		// Create data
		$exe = $studio->create($data);

		echo json_encode($exe);
	}

	public function update()
	{
		$studio = new Studios;
		$request = new Request;

		// Get data post
		$data = $request->post_all();

		// Update data
		$exe = $studio->update(['id' => $data['id']], $data);

		echo json_encode($exe);
	}

	public function delete()
	{
		$studio = new Studios;
		$request = new Request;

		// Delete data
		$exe = $studio->delete(['id' => $request->post('id')]);

		echo json_encode($exe);
	}
}