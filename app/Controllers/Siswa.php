<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Siswa as Siswas;
	use App\Core\Request;

	Class Siswa extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$siswa = new Siswas;
			$get = $siswa->all();

			$data['title'] = 'Siswa';
			$data['data'] = $siswa->result_array($get);

			view('page.siswa', $data);
		}

		public function insert() {
			$siswa = new Siswas;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $siswa->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$siswa = new Siswas;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $siswa->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$siswa = new Siswas;
			$request = new Request;	

			// Delete data
			$exe = $siswa->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}