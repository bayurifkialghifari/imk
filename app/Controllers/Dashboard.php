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
			Sesion::cekBelum();
		}

		public function index() {
			$user = new User;
			$role = new Role;
			$menu = new Menu;
			$meja = new Meja;
			$bahan = new Bahan;
			$pembayaran = new Pembayaran;
			$pesanan_detail = new Detail_pesanan;
			$request = new Request;
			
			// Get role user
			$get_role = $role->find(['id' => $request->sess('role_id')]);
			$get_role = $get_role->fetch_assoc();
			$data['title'] = 'Dashboard';
			$data['get_role'] = $get_role;

			// Total user
			$data['total_user'] = $user->all()->num_rows;
			$data['total_menu'] = $menu->all()->num_rows;
			$data['total_pesanan'] = $pesanan_detail->all()->num_rows;
			$data['total_meja'] = $meja->all()->num_rows;
			$data['total_bahan'] = $bahan->all()->num_rows;
			$data['pendapatan'] = $pembayaran->select('sum(total) as total')->get()->fetch_assoc();

			view('page.dashboard', $data);
		}
	}