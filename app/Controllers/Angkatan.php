<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Angkatan as Angkatans;
	use App\Core\Request;

	Class Angkatan extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$angkatan = new Angkatans;
			$get = $angkatan->all();

			$data['title'] = 'Angkatan';
			$data['data'] = $angkatan->result_array($get);

			view('page.angkatan', $data);
		}

		public function insert() {
			$angkatan = new Angkatans;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $angkatan->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$angkatan = new Angkatans;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $angkatan->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$angkatan = new Angkatans;
			$request = new Request;	

			// Delete data
			$exe = $angkatan->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}