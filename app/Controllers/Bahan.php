<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Bahan as Bahans;
	use App\Core\Request;

	Class Bahan extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
			$bahan = new Bahans;
			$get = $bahan->all();

			$data['title'] = 'Bahan';
			$data['data'] = $bahan->result_array($get);

			view('page.bahan', $data);
		}

		public function insert() {
			$bahan = new Bahans;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $bahan->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$bahan = new Bahans;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $bahan->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$bahan = new Bahans;
			$request = new Request;	

			// Delete data
			$exe = $bahan->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}