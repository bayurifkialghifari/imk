<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Core\Request;

	Class Dashboard extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$data['title'] = 'Dashboard';

			view('page.dashboard', $data);
		}
	}