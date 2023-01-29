<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Film as Films;
	use App\Liblaries\Hash;
	use App\Core\Request;

	Class Film extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$film = new Films;
			$get = $film->all();

			$data['title'] = 'Film';
			$data['data'] = $film->result_array($get);

			view('page.film', $data);
		}

		public function insert() {
			$film = new Films;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $film->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$film = new Films;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $film->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$film = new Films;
			$request = new Request;	

			// Delete data
			$exe = $film->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}