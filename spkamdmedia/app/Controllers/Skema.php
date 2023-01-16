<?php
namespace App\Controllers;
use App\Models\Skemamodel;
class Skema extends BaseController{

	public function index(){
		$data['tahun'] = date('Y');
		return view('admin/skema',$data);
	}

	public function tampildata(){
		$data['tahun'] = $this->request->getPost('tahun');
		return view('admin/skema',$data);
	}

	public function simpandata(){
		$db = db_connect();
		$mod = new Skemamodel();
		$kriteria => $this->request->getPost('kriteria');
		for ($i=0; $i < count($kriteria) ; $i++) {
			$cek = $db->query("select ")
		}
		$mod->insert($data);
		return redirect()->to(base_url('skema'));
	}
}
?>