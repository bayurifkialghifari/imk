<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Pembayaran;
	use App\Core\Request;

	Class Laporan extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
            $pembayaran = new Pembayaran;
			
            $data['title'] = 'Laporan';

            // Get daily
            $daily = self::getDailyReport();
            

			view('page.laporan', $data);
		}

        // Daily report
        public function getDailyReport() {
            $pembayaran = new Pembayaran;

            $get = $pembayaran->select('pembayaran.*')
            ->join('pesanan','pesanan.id', 'pembayaran.id_pesanan')
            ->join('user','user.id', 'pembayaran.id_user')
            ->join('user','user.id', 'pembayaran.id_user')
            ->join('meja_pelanggan', 'meja_pelanggan.id', 'pesanan.id_meja_pelanggan')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->where('pembayaran.created_at')
            ;
        }
	}