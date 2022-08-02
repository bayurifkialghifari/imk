<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Kelas as Kelass;
	use App\Models\Angkatan;
	use App\Core\Request;

	Class Kelas extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$kelas = new Kelass;
			$angkatan = new Angkatan;

			$get = $kelas->select('kelas.*, angkatan.nama as angkatan_nama')
			->join('angkatan', 'angkatan.id', 'kelas.angkatan_id')
			->get();

			$data['title'] = 'Kelas';
			$data['angkatan'] = $angkatan->result_array($angkatan->all());
			$data['data'] = $kelas->result_array($get);

			view('page.kelas', $data);
		}

		public function insert() {
			$kelas = new Kelass;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $kelas->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$kelas = new Kelass;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $kelas->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$kelas = new Kelass;
			$request = new Request;	

			// Delete data
			$exe = $kelas->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}