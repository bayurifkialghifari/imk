<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Meja_pelanggan;
	use App\Models\Pesanan;
	use App\Models\Detail_pesanan;
	use App\Models\Menu;
	use App\Core\Request;

	Class ListPesanan extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$meja_pelanggan = new Meja_pelanggan;
            $detail_pesanan = new Detail_pesanan;
            $pesanan = new Pesanan;
            $menu = new Menu;
			$request = new Request;

            $status = $request->get('status') == '' ? 'Belum Siap' : $request->get('status');
            $status = urldecode($status);

            $get = $detail_pesanan->select('meja.nomor as nomor, menu.nama as menu, pelanggan.atas_nama as pelanggan, detail_pesanan.*')
            ->join('menu', 'menu.id', 'detail_pesanan.id_menu')
            ->join('pesanan', 'pesanan.id', 'detail_pesanan.id_pesanan')
            ->join('meja_pelanggan', 'meja_pelanggan.id', 'pesanan.id_meja_pelanggan')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->where('detail_pesanan.status', $status)
            ->orderBy('detail_pesanan.id', 'asc')
            ->get();

			$data['title'] = 'List Pesanan';
			$data['data'] = $detail_pesanan->result_array($get);
			$data['status'] = $status;

            view('page.listpesanan', $data);            
		}

        public function siap() {
            $detail_pesanan = new Detail_pesanan;
            $request = new Request;

            // Get id
            $id = $request->post('id');

            // Update status
            $exe = $detail_pesanan->update(['id' => $id], ['status' => 'Sudah Siap']);

            echo json_encode($exe);
        }
	}