<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Pembayaran;
	use App\Core\Request;

	Class Laporan extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
            $pembayaran = new Pembayaran;
			
            $data['title'] = 'Laporan';

            // Get daily
            $daily = self::getDailyReport();
            // Get Weekly
            $weekly = self::getWeeklyReport();
            // Get Monthly
            $monthly = self::getMonthlyReport();
            // Get Yearly
            $yearly = self::getYearlyReport();

            // Get data
            $data['daily'] = $daily;
            $data['weekly'] = $weekly;
            $data['monthly'] = $monthly;
            $data['yearly'] = $yearly;
            

			view('page.laporan', $data);
		}

        // Export excel
        public function exportexcel() {
            // Request
            $request = new Request;

            // Get daily
            $daily = self::getDailyReport();
            // Get Weekly
            $weekly = self::getWeeklyReport();
            // Get Monthly
            $monthly = self::getMonthlyReport();
            // Get Yearly
            $yearly = self::getYearlyReport();

            // Get data
            $data['daily'] = $daily;
            $data['weekly'] = $weekly;
            $data['monthly'] = $monthly;
            $data['yearly'] = $yearly;
            $data['type'] = $request->get('type');

            view('excel', $data);
        }

        // Daily report
        public function getDailyReport() {
            $pembayaran = new Pembayaran;

            $get = $pembayaran->select('pembayaran.*, meja.nomor, pelanggan.atas_nama, pembayaran.status, pembayaran.created_at as tanggalpesan')
            ->join('pesanan','pesanan.id', 'pembayaran.id_pesanan')
            ->join('user','user.id', 'pembayaran.id_user')
            ->join('meja_pelanggan', 'meja_pelanggan.id', 'pesanan.id_meja_pelanggan')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->raw(" where DATE(pembayaran.created_at) = '" . date('Y-m-d') . "'")
            ->get();

            return $pembayaran->result_array($get);
        }

        // Weekly report
        public function getWeeklyReport() {
            $pembayaran = new Pembayaran;

            $get = $pembayaran->select('pembayaran.*, meja.nomor, pelanggan.atas_nama, pembayaran.status, pembayaran.created_at as tanggalpesan')
            ->join('pesanan','pesanan.id', 'pembayaran.id_pesanan')
            ->join('user','user.id', 'pembayaran.id_user')
            ->join('meja_pelanggan', 'meja_pelanggan.id', 'pesanan.id_meja_pelanggan')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->raw(" where DATE(pembayaran.created_at) between '" . date('Y-m-d', strtotime('-1 week')) . "' and '".date('Y-m-d')."'  ")
            ->get();

            return $pembayaran->result_array($get);
        }

        // Monthly report
        public function getMonthlyReport() {
            $pembayaran = new Pembayaran;

            $get = $pembayaran->select('pembayaran.*, meja.nomor, pelanggan.atas_nama, pembayaran.status, pembayaran.created_at as tanggalpesan')
            ->join('pesanan','pesanan.id', 'pembayaran.id_pesanan')
            ->join('user','user.id', 'pembayaran.id_user')
            ->join('meja_pelanggan', 'meja_pelanggan.id', 'pesanan.id_meja_pelanggan')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->raw(" where MONTH(pembayaran.created_at) = '" . date('m') . "' ")
            ->get();
            
            return $pembayaran->result_array($get);
        }

        // Yearly report
        public function getYearlyReport() {
            $pembayaran = new Pembayaran;

            $get = $pembayaran->select('pembayaran.*, meja.nomor, pelanggan.atas_nama, pembayaran.status, pembayaran.created_at as tanggalpesan')
            ->join('pesanan','pesanan.id', 'pembayaran.id_pesanan')
            ->join('user','user.id', 'pembayaran.id_user')
            ->join('meja_pelanggan', 'meja_pelanggan.id', 'pesanan.id_meja_pelanggan')
            ->join('meja', 'meja.id', 'meja_pelanggan.id_meja')
            ->join('pelanggan', 'pelanggan.id', 'meja_pelanggan.id_pelanggan')
            ->raw(" where YEAR(pembayaran.created_at) = '" . date('Y') . "' ")
            ->get();
            
            return $pembayaran->result_array($get);
        }
	}