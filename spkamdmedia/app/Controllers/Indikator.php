<?php
namespace App\Controllers;
use App\Models\Indikatormodel;
use App\Models\Kriteriamodel;
class Indikator extends BaseController{
	
	public function index(){
		$mod = new Indikatormodel();
		$mods = new Kriteriamodel();
		if(session()->get('admin')){
			$data['daftarkriteria'] = $mods->findAll();
			$data['data'] = $mod->findAll();
			return view('indikator',$data);
		}else{
			return view('login');	
		}
	}

	public function simpandata(){
		$mod = new Indikatormodel();
		$data = array(
			'indikator' => $this->request->getPost('indikator'),
			'nilai' => $this->request->getPost('nilai'),
			'idkriteria' => $this->request->getPost('idkriteria')
		);
		$mod->insert($data);
		return redirect()->to(base_url('indikator'));
	}

	public function ubahdata(){
		$mod = new Indikatormodel();
		$id = $this->request->getPost('id');
		$data = array(
			'indikator' => $this->request->getPost('indikator'),
			'nilai' => $this->request->getPost('nilai'),
			'idkriteria' => $this->request->getPost('idkriteria')
		);
		$mod->updatedata($id,$data);
		return redirect()->to(base_url('indikator'));
	}
}
?>