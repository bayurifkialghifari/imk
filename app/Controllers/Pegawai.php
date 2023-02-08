<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
    use App\Liblaries\Hash;
	use App\Models\Pegawai as Pegawais;
	use App\Models\Film;
	use App\Core\Request;

	Class Pegawai extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
			$pegawai = new Pegawais;
            $get = $pegawai->all();

			$data['title'] = 'Pegawai';
			$data['data'] = $pegawai->result_array($get);

			view('page.pegawai', $data);
		}

		public function insert() {
			$film = new Pegawais;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
            $data['password'] = Hash::bcrypt_hash($data['password']);
			unset($data['id']);

			// Create data
			$exe = $film->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$film = new Pegawais;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();
			$data['password'] = Hash::bcrypt_hash($data['password']);

			// Update data
			$exe = $film->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$film = new Pegawais;
			$request = new Request;	

			// Delete data
			$exe = $film->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}