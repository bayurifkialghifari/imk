<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Penjualan as PenjualanTikets;
	use App\Models\Tiket;
	use App\Core\Request;

	Class PenjualanTiket extends Controller
	{
		public function __construct() {
			(new Sesion)->cekBelum();
		}

		public function index() {
			$penjualanTiket = new PenjualanTikets;
            $penjualanTiket = $penjualanTiket->select('
                penjualan.*, 
                film.nama as film, 
                jadwal.tanggal as jadwal, 
                tiket.harga as harga_tiket,
                kursi.no as nomer_kursi,
                pegawai.nama as pegawai
            ')
            ->join('tiket', 'tiket.id', 'penjualan.id_film')
            ->join('pegawai', 'pegawai.id', 'penjualan.id_pegawai')
            ->join('jadwal', 'jadwal.id', 'tiket.id_jadwal')
            ->join('kursi', 'kursi.id', 'tiket.id_kursi')
            ->join('film', 'film.id', 'jadwal.id_film');
			$get = $penjualanTiket->get();

			$data['title'] = 'Penjualan Tiket';
			$data['data'] = $penjualanTiket->result_array($get);
            $data['id_pegawai'] = Request::sess('id');
            $tiket = (new Tiket)->select('tiket.*, jadwal.tanggal as tanggal, film.nama as film, kursi.no as no_kursi')
            ->join('jadwal', 'jadwal.id', 'tiket.id_jadwal')
            ->join('film', 'jadwal.id_film', 'film.id')
            ->join('kursi', 'kursi.id', 'tiket.id_kursi');
            $tiket = $tiket->get();
            $data['tiket'] = $penjualanTiket->result_array($tiket);

			view('page.penjualanTiket', $data);
		}

		public function insert() {
			$penjualanTiket = new PenjualanTikets;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
            $data['input_bayar'] = 0;
            $data['kembalian'] = 0;
			unset($data['id']);

			// Create data
			$exe = $penjualanTiket->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$penjualanTiket = new PenjualanTikets;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();

			// Update data
			$exe = $penjualanTiket->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$penjualanTiket = new PenjualanTikets;
			$request = new Request;	

			// Delete data
			$exe = $penjualanTiket->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}