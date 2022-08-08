<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Meja_pelanggan;
	use App\Models\Pesanan as Pesanans;
	use App\Models\Detail_pesanan;
	use App\Models\Menu;
	use App\Core\Request;

	Class Pesanan extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$meja_pelanggan = new Meja_pelanggan;
            $detail_pesanan = new Detail_pesanan;
            $pesanan = new Pesanans;
            $menu = new Menu;
			$request = new Request;

            // Get id
            $id = $request->get('meja');

            // Cek pesanan
            $pesanan = self::cekPesanan($id);

            $get = $detail_pesanan->select('detail_pesanan.*, menu.nama as menu, menu.harga as harga')
            ->join('menu', 'menu.id', 'detail_pesanan.id_menu')
            ->where('id_pesanan', $pesanan['id'])
            ->get();
            
			$data['title'] = 'Meja';
            $data['meja'] = $meja_pelanggan->select('meja.nomor as nomor, meja_pelanggan.*, pelanggan.atas_nama as atas_nama')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->where('meja_pelanggan.id', $id)
            ->get();
			$data['data'] = $detail_pesanan->result_array($get);
			$data['menu'] = $menu->result_array($menu->all());
            $data['pesanan'] = $pesanan['id'];

            view('page.pesanan', $data);            
		}

        public function cekPesanan($id) {
            $pesanan = new Pesanans;
            $request = new Request;
            $cek = $pesanan->find(['id_meja_pelanggan' => $id]);
            
            // If exist
            if($cek->num_rows > 0) {
                return $cek->fetch_assoc();
            } else {
                // Create pesanan
                $exe = $pesanan->create([
                    'id_meja_pelanggan' => $id,
                    'id_user' => $request->sess('id'),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);

                $cek = $pesanan->find(['id_meja_pelanggan' => $id]);

                return $cek->fetch_assoc();
            }
        }

        public function insert() {
            $detail_pesanan = new Detail_pesanan;
            $menu = new Menu;
            $request = new Request;

            // Get post data
            $data = $request->post_all();
            $id_menu = explode('|',$data['id_menu'])[0];
            
            // Create detail pesanan
            $exe = $detail_pesanan->create([
                'id_pesanan' => $data['id_pesanan'],
                'id_menu' => $id_menu,
                'qty' => $data['jumlah_pesan'],
                'total' => $data['total_harga'],
                'created_at' => date('Y-m-d H:i:s'),
            ]);

            // Kurang stok menu
            $min = $menu->update(['id' => $id_menu], [
                'stok' => $data['stok_sisa']
            ]);

            echo json_encode($exe);
        }

        public function delete() {
            $detail_pesanan = new Detail_pesanan;
            $menu = new Menu;
            $request = new Request;

            // Get post data
            $id = $request->post('id');            

            // Get detail pesanan
            $getDetail = $detail_pesanan->find(['id' => $id]);
            $getDetail = $getDetail->fetch_assoc();



            // Delete detail pesanan
            $exe = $detail_pesanan->delete(['id' => $id]);

            // Plus stok menu
            $getmenu = $menu->find(['id' => $getDetail['id_menu']]);
            $getmenu = $getmenu->fetch_assoc();

            $plus = $menu->update(['id' => $getDetail['id_menu']], [
                'stok' => (int)$getmenu['stok'] + (int)$getDetail['qty']
            ]);

            echo json_encode($plus);
        }
	}