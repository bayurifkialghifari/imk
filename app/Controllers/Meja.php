<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Meja as Mejas;
	use App\Core\Request;

	Class Meja extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$meja = new Mejas;
			$get = $meja->all();

			$data['title'] = 'Meja';
			$data['data'] = $meja->result_array($get);

			view('page.meja', $data);
		}

		public function insert() {
			$meja = new Mejas;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $meja->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$meja = new Mejas;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $meja->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$meja = new Mejas;
			$request = new Request;	

			// Delete data
			$exe = $meja->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}