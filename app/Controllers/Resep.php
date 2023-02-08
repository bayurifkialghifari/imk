<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Resep as Reseps;
	use App\Models\Menu;
	use App\Models\Bahan;
	use App\Core\Request;

	Class Resep extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
            $request = new Request;
			$resep = new Reseps;
            $menu = new Menu;
            $bahan = new Bahan;
            $id = $request->get('menu');
			$get = $resep->select('resep.*, bahan.nama as bahan, bahan.stok as bahan_stok')
			->join('bahan', 'bahan.id', 'resep.id_bahan')
            ->where('resep.id_menu', $id)
			->get();
            $dmenu = $menu->find(['id' => $id]);
            $dbahan = $bahan->all();

            // Send data
			$data['title'] = 'Resep';
            $data['id'] = $id;
			$data['data'] = $resep->result_array($get);
            $data['menu'] = $dmenu->fetch_assoc();
            $data['bahan'] = $dbahan;

			view('page.resep', $data);
		}

		public function insert() {
			$resep = new Reseps;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
			unset($data['id']);

			// Create data
			$exe = $resep->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$resep = new Reseps;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $resep->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$resep = new Reseps;
			$request = new Request;	

			// Delete data
			$exe = $resep->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}