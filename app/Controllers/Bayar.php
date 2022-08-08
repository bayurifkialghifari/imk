<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Pembayaran;
    use App\Models\Meja_pelanggan;
    use App\Models\Detail_pesanan;
	use App\Core\Request;

	Class Bayar extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$bayar = new Pembayaran;
            $meja_pelanggan = new Meja_pelanggan;
			$get = $meja_pelanggan->select('meja_pelanggan.*, meja.nomor as nomor, pelanggan.atas_nama as atas_nama, pesanan.created_at as created_at, pesanan.id as pesanan_id')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->join('pesanan', 'pesanan.id_meja_pelanggan', 'meja_pelanggan.id')
            ->where('meja_pelanggan.status', 'Active')
            ->get();

			$data['title'] = 'Bayar';
			$data['data'] = $meja_pelanggan->result_array($get);

			view('page.bayar', $data);
		}

        public function getlistpesanan() {
            $request = new Request;
            $detail_pesanan = new Detail_pesanan;

            // Get pesanan_id
            $id = $request->get('pesanan');

            // Get data pesanan
            $get = $detail_pesanan->select('meja.nomor as nomor, menu.nama as menu, menu.harga as harga, pelanggan.atas_nama as pelanggan, detail_pesanan.*')
            ->join('menu', 'menu.id', 'detail_pesanan.id_menu')
            ->join('pesanan', 'pesanan.id', 'detail_pesanan.id_pesanan')
            ->join('meja_pelanggan', 'meja_pelanggan.id', 'pesanan.id_meja_pelanggan')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->where('detail_pesanan.id_pesanan', $id)
            ->orderBy('detail_pesanan.id', 'asc')
            ->get();

            echo json_encode($detail_pesanan->result_array($get));
        }

		public function insert() {
			$bayar = new Pembayaran;
            $meja_pelanggan = new Meja_pelanggan;
			$request = new Request;

			// Get data post
			$data = $request->post_all();

            // Update status meja pelanggan
            $update = $meja_pelanggan->update(['id' => $data['id']], [
                'status' => 'Not Active'
            ]);

            // Create Pembayaran
            $exe = $bayar->create([
                'id_pesanan' => $data['id_pesanan'],
                'id_user' => $request->sess('id'),
                'total' => $data['total'],
                'status' => 'Dibayar',
                'bukti' => '',
            ]);
            
            // Set message
            alert('Berhasil dibayar');

			redirect_back();
		}
	}