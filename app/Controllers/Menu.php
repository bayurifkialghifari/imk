<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Menu as Menus;
	use App\Models\Tipe;
	use App\Models\Resep;
	use App\Models\Bahan;
	use App\Liblaries\Upload;
	use App\Core\Request;

	Class Menu extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
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

		// Check resep spesific menu
		public function checkResep() {
			$resep = new Resep;
			$request = new Request;

			// Get menu id
			$id = $request->get('id');

			// Get data resep
			$get = $resep->select('resep.*, bahan.nama as bahan, bahan.stok as bahan_stok')
			->join('bahan', 'bahan.id', 'resep.id_bahan')
            ->where('resep.id_menu', $id)
			->get();

			echo json_encode($resep->result_array($get));
		}

		// Add stok	menu
		public function addStok() {
			$request = new Request;
			$menu = new Menus;
			$bahan = new Bahan;

			// Get id menu
			$id = $request->get('id');
			
			// Status stok tersedia atau tidak
			$bahanupdate = [];
			$status = true;

			// Get data post
			$data = $request->post_all();

			// Cek stok tersedia
			foreach($data['bahan'] as $b) {
				// Stok sekarang di kurang stok input
				$stokNow = (int)$b['bahan_stok'] - ((int)$b['jumlah'] * (int)$data['stok_input']);
				array_push($bahanupdate, [
					'id' => $b['id_bahan'],
					'stok' => $stokNow,
				]);
				
				// Cek stok tersedia atau tidak
				if((int)$stokNow < 0) {
					$status = false;
					break;
				}
			}

			// If Bahan mencukupi
			if ($status) {

				// Update stok bahan
				foreach($bahanupdate as $bu) {
					$exe = $bahan->update(['id' => $bu['id']], [
						'stok' => $bu['stok']
					]);	
				}

				// Tambah stok menu
				$plus = $menu->update(['id' => $id], [
					'stok' => $data['stok_final']
				]);

				echo json_encode([
					'status' => true,
					'data' => $bahanupdate
				]);
			} else {
				echo json_encode([
					'status' => false,
					'data' => []
				]);
			}
		}

		// Min stok menu
		public function minStok() {
			$request = new Request;
			$menu = new Menus;
			$bahan = new Bahan;

			// Get id menu
			$id = $request->get('id');

			// Get data post
			$data = $request->post_all();

			// Tambah stok tersedia
			foreach($data['bahan'] as $b) {
				$stokNow = (int)$b['bahan_stok'] + ((int)$b['jumlah'] * (int)$data['stok_input']);

				$exe = $bahan->update(['id' => $b['id_bahan']], [
					'stok' => $stokNow
				]);	
			}

			// Kurang stok menu
			$plus = $menu->update(['id' => $id], [
				'stok' => $data['stok_final']
			]);

			echo json_encode([
				'status' => true,
				'data' => $data['bahan']
			]);
		}
	}