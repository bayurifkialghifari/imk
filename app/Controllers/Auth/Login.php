<?php
	
	namespace App\Controllers\Auth;

	use App\Core\Controller;
	use App\Core\Request;
	use App\Liblaries\Auth;
	use App\Liblaries\Sesion;

	Class Login extends Controller
	{
		public function __construct() {
			(new Sesion)->cekLogin();
		}

		public function index() {
			$data['app_name'] = 'Welcome';
        
			view('auth.login', $data);
		}

		public function doLogin() {
			$request = new Request;

			// Post data
			$email = $request->post('email');
			$password = $request->post('password');
			

			// Auth
			$auth = new Auth;
			
			$auth->table('pegawai');
			$auth->user_field('email');
			$auth->password_field('password');

			// Execute Auth
			$exe = $auth->login($email, $password);
		
			echo json_encode($exe);
		}

		public function logout() {
			$auth = new Auth;
			$auth->logout();

			redirect_back();
		}
	}