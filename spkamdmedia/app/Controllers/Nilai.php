<?php
namespace App\Controllers;
use App\Models\Nilaimodel;
use App\Models\Kriteriamodel;
use App\Models\Karyawanmodel;
class Nilai extends BaseController{
	
	public function index(){
		$mods = new Kriteriamodel();
		$modss = new Karyawanmodel();
		if(session()->get('admin')){
			$data['bulan'] = (int) date('m');
			$data['tahun'] = (int) date('Y');
			$data['kriteria'] = $mods->findAll();
			$data['data'] = $modss->findAll();
			return view('nilai',$data);
		}else{
			return view('login');	
		}
	}

	public function tampildata(){
		$mods = new Kriteriamodel();
		$modss = new Karyawanmodel();
		$data['bulan'] = $this->request->getPost('bulan');
		$data['tahun'] = $this->request->getPost('tahun');
		$data['kriteria'] = $mods->findAll();
		$data['data'] = $modss->findAll();
		return view('nilai',$data);
	}

	public function simpandata($x){
		$db = db_connect();
		$mod = new Nilaimodel();
		$nilai = $this->request->getPost('nilai');
		$idkaryawan = $this->request->getPost('idkaryawan');
		$periode = $this->request->getPost('periode');
		$jenis = $db->query("select jenis from kriteria where idkriteria = '".$x."'")->getRowArray()['jenis'];
		$satuan = $db->query("select satuan from kriteria where idkriteria = '".$x."'")->getRowArray()['satuan'];
		if($jenis == 'input'){
			$indikator = $nilai." ".$satuan;
		}else{
			$indikator = $db->query("select indikator from indikator where nilai = '".$nilai."' and idkriteria = '".$x."'")->getRowArray()['indikator'];
		}
		$cek = $db->query("select * from nilai where periode = '".$periode."' and idkriteria = '".$x."' and idkaryawan = '".$idkaryawan."'")->getResultArray();
		if(count($cek) > 0){
			$id = $db->query("select idnilai from nilai where periode = '".$periode."' and idkriteria = '".$x."' and idkaryawan = '".$idkaryawan."'")->getResultArray()[0]['idnilai'];
			$mod->updatedata($id,['nilai' => $nilai, 'indikator' => $indikator]);
		}else{
			$data = array(
				'indikator' => $indikator,
				'nilai' => $nilai,
				'periode' => $periode,
				'idkriteria' => $x,
				'idkaryawan' => $idkaryawan
			);
			$mod->insert($data);
		}

		return redirect()->to(base_url('nilai'));
	}
}
?>