<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
    use App\Liblaries\Hash;
	use App\Models\User as Users;
	use App\Models\Role;
	use App\Core\Request;

	Class User extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$user = new Users;
			$role = new Role;

			$get = $user->select('user.*, role.nama as role_name')
			->join('role', 'role.id', 'user.role_id')
			->get();

			$data['title'] = 'User';
			$data['role'] = $role->result_array($role->all());
			$data['data'] = $user->result_array($get);

			view('page.user', $data);
		}

		public function insert() {
			$user = new Users;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			$data['password'] = Hash::bcrypt_hash($data['password']);
			unset($data['id']);

			// Create data
			$exe = $user->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$user = new Users;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();
			$data['password'] = Hash::bcrypt_hash($data['password']);

			// Update data
			$exe = $user->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$user = new Users;
			$request = new Request;	

			// Delete data
			$exe = $user->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}