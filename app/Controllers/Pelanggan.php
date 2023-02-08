<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Pelanggan as Pelanggans;
	use App\Liblaries\Hash;
	use App\Core\Request;

	Class Pelanggan extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
			$pelanggan = new Pelanggans;
			$get = $pelanggan->all();

			$data['title'] = 'Pelanggan';
			$data['data'] = $pelanggan->result_array($get);

			view('page.pelanggan', $data);
		}

		public function insert() {
			$pelanggan = new Pelanggans;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $pelanggan->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$pelanggan = new Pelanggans;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $pelanggan->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$pelanggan = new Pelanggans;
			$request = new Request;	

			// Delete data
			$exe = $pelanggan->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}