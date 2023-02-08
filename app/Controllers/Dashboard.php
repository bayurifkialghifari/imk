<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\User;
	use App\Models\Role;
	use App\Models\Menu;
	use App\Models\Meja;
	use App\Models\Pembayaran;
	use App\Models\Detail_pesanan;
	use App\Models\Bahan;
	use App\Core\Request;

	Class Dashboard extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
			// Get role user
			$data['title'] = 'Dashboard';

			view('page.dashboard', $data);
		}
	}