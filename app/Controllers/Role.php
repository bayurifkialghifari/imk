<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Role as Roles;
	use App\Core\Request;

	Class Role extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$role = new Roles;
			$get = $role->all();

			$data['title'] = 'Role';
			$data['data'] = $role->result_array($get);

			view('page.role', $data);
		}

		public function insert() {
			$role = new Roles;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $role->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$role = new Roles;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $role->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$role = new Roles;
			$request = new Request;	

			// Delete data
			$exe = $role->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}