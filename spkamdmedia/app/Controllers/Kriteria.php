<?php
namespace App\Controllers;
use App\Models\Kriteriamodel;
class Kriteria extends BaseController{
	
	public function index(){
		$mod = new Kriteriamodel();
		if(session()->get('admin')){
			$data['data'] = $mod->findAll();
			return view('kriteria',$data);
		}else{
			return view('login');	
		}
	}

	public function simpandata(){
		$mod = new Kriteriamodel();
		$db = db_connect();
		if($this->request->getPost('jenis') == 'input'){
			$data = array(
				'kriteria' => $this->request->getPost('kriteria'),
				'kategori' => $this->request->getPost('kategori'),
				'bobot' => $this->request->getPost('bobot'),
				'jenis' => 'input',
				'batas' => $this->request->getPost('batas'),
				'satuan' => $this->request->getPost('satuan'),
				'persentase' => 0
			);
		}else{
			$data = array(
				'kriteria' => $this->request->getPost('kriteria'),
				'kategori' => $this->request->getPost('kategori'),
				'bobot' => $this->request->getPost('bobot'),
				'jenis' => 'indikator',
				'batas' => 0,
				'satuan' => '',
				'persentase' => 0
			);
		}
		$mod->insert($data);

		$total = $db->query("select sum(bobot) as jumlah from kriteria")->getResultArray();
		$data= $mod->findAll();
		foreach ($data as $d) {
			$persen = ($d['bobot'] / $total[0]['jumlah'])*100;
			$mod->updatedata($d['idkriteria'],['persentase' => number_format($persen,2)]);
		}
		
		return redirect()->to(base_url('kriteria'));
	}

	public function ubahdata(){
		$mod = new Kriteriamodel();
		$db = db_connect();
		$id = $this->request->getPost('id');
		if($this->request->getPost('jenis') == 'input'){
			$data = array(
				'kriteria' => $this->request->getPost('kriteria'),
				'kategori' => $this->request->getPost('kategori'),
				'bobot' => $this->request->getPost('bobot'),
				'jenis' => 'input',
				'batas' => $this->request->getPost('batas'),
				'satuan' => $this->request->getPost('satuan')
			);
		}else{
			$data = array(
				'kriteria' => $this->request->getPost('kriteria'),
				'kategori' => $this->request->getPost('kategori'),
				'bobot' => $this->request->getPost('bobot'),
				'jenis' => 'indikator',
				'batas' => 0,
				'satuan' => ''
			);
		}
		$mod->updatedata($id,$data);

		$total = $db->query("select sum(bobot) as jumlah from kriteria")->getResultArray();
		$data= $mod->findAll();
		foreach ($data as $d) {
			$persen = ($d['bobot'] / $total[0]['jumlah'])*100;
			$mod->updatedata($d['idkriteria'],['persentase' => number_format($persen,2)]);
		}

		return redirect()->to(base_url('kriteria'));
	}
}
?>