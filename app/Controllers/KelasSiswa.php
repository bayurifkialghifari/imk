<?php
	
	namespace App\Controllers;

	use App\Core\Controller;
	use App\Liblaries\Sesion;
	use App\Models\Kelas;
	use App\Models\Kelas_siswa;
	use App\Models\Siswa;
	use App\Core\Request;

	Class KelasSiswa extends Controller
	{
		public function __construct() {
			Sesion::cekBelum();
		}

		public function index() {
			$kelas = new Kelas;
            $kelasSiswa = new Kelas_siswa;
			$siswa = new Siswa;
            $request = new Request;
            $data['id'] = $request->get('id');

			$get = $kelasSiswa->select('kelas_siswa.*, kelas.nama as kelas, angkatan.nama as angkatan, siswa.nama as siswa')
			->leftJoin('kelas', 'kelas.id', 'kelas_siswa.kelas_id')
            ->leftJoin('angkatan', 'angkatan.id', 'kelas.angkatan_id')
			->leftJoin('siswa', 'siswa.id', 'kelas_siswa.siswa_id')
            ->where('kelas_siswa.kelas_id', $data['id'])
			->get();

			$data['title'] = 'Kelas Siswa';
			$data['siswa'] = $siswa->result_array($siswa->all());
			$data['data'] = $kelas->result_array($get);
            $data['kelasDetail'] = $kelas->find(['id' => $data['id']])->fetch_assoc();
            
            
			view('page.kelasSiswa', $data);
		}

		public function insert() {
			$kelasSiswa = new Kelas_siswa;
			$request = new Request;

			// Get data post
			$data = $request->post_all();
            $data['kelas_id'] = $request->get('id');
			unset($data['id']);

			// Create data
			$exe = $kelasSiswa->create($data);

			echo json_encode($exe);
		}

		public function update() {
			$kelasSiswa = new Kelas_siswa;
			$request = new Request;	

			// Get data post
			$data = $request->post_all();
            $data['kelas_id'] = $request->get('id');

			// Update data
			$exe = $kelasSiswa->update(['id' => $data['id']], $data);

			echo json_encode($exe);
		}

		public function delete() {
			$kelasSiswa = new Kelas_siswa;
			$request = new Request;	

			// Delete data
			$exe = $kelasSiswa->delete(['id' => $request->post('id')]);

			echo json_encode($exe);
		}
	}