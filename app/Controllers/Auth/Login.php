<?php
	
	namespace App\Controllers\Auth;

	use App\Core\Controller;
	use App\Core\Request;
	use App\Liblaries\Auth;
	use App\Liblaries\Sesion;

	Class Login extends Controller
	{
		public function __construct() {
			Sesion::cekLogin();
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
			Auth::table('user');
			Auth::user_field('email');
			Auth::password_field('password');

			// Execute Auth
			$exe = Auth::login($email, $password);
		
			echo json_encode($exe);
		}

		public function logout() {
			Auth::logout();

			redirect_back();
		}
	}