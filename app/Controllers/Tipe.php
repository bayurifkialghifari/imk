<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Tipe as Tipes;
	use App\Core\Request;

	Class Tipe extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
			$tipe = new Tipes;
			$get = $tipe->all();

			$data['title'] = 'Tipe';
			$data['data'] = $tipe->result_array($get);

			view('page.tipe', $data);
		}

		public function insert() {
			$tipe = new Tipes;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $tipe->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$tipe = new Tipes;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $tipe->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$tipe = new Tipes;
			$request = new Request;	

			// Delete data
			$exe = $tipe->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}