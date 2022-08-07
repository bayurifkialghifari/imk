<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Menu as Menus;
	use App\Models\Tipe;
	use App\Models\Resep;
	use App\Liblaries\Upload;
	use App\Core\Request;

	Class Menu extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$menu = new Menus;
            $tipe = new Tipe;
			$resep = new Resep;
			$get = $menu->select('menu.*, tipe.nama as nama_tipe')
			->join('tipe', 'tipe.id', 'menu.id_tipe')
			->get();
            $dtipe = $tipe->all();

			$data['title'] = 'Menu';
			$data['data'] = $menu->result_array($get);
			$data['tipe'] = $tipe->result_array($dtipe);
			$data['resep'] = $resep;

			view('page.menu', $data);
		}

		public function insert() {
			$menu = new Menus;
			$request = new Request;

			// Get data post
			$data = $request->post_all();

			// Gambar
			if(isset($_FILES['gambar']))
			{
				$data = array_merge($data, ['gambar' => Upload::execute('gambar', ['folder' => 'menu/', 'max_size' => 500000])]);
			}

			unset($data['id']);

			// Create data
			$exe = $menu->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$menu = new Menus;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Gambar
			if(isset($_FILES['gambar']))
			{
				$data = array_merge($data, ['gambar' => Upload::execute('gambar', ['folder' => 'menu/', 'max_size' => 500000])]);
			}

			// Update data
			$exe = $menu->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$menu = new Menus;
			$request = new Request;	

			// Delete data
			$exe = $menu->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}