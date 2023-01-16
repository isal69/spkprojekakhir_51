<?php
namespace App\Controllers;
use App\Models\Karyawanmodel;
class Karyawan extends BaseController{
	
	public function index(){
		$mod = new Karyawanmodel();
		if(session()->get('admin')){
			$data['data'] = $mod->findAll();
			return view('karyawan',$data);
		}else{
			return view('login');	
		}
	}

	public function simpandata(){
		$mod = new Karyawanmodel();
		$data = array(
			'nama' => $this->request->getPost('nama'),
			'jekel' => $this->request->getPost('jekel'),
			'alamat' => $this->request->getPost('alamat'),
			'telepon' => $this->request->getPost('telepon')
		);
		$mod->insert($data);
		return redirect()->to(base_url('karyawan'));
	}

	public function ubahdata(){
		$mod = new Karyawanmodel();
		$id = $this->request->getPost('id');
		$data = array(
			'nama' => $this->request->getPost('nama'),
			'jekel' => $this->request->getPost('jekel'),
			'alamat' => $this->request->getPost('alamat'),
			'telepon' => $this->request->getPost('telepon')
		);
		$mod->updatedata($id,$data);
		return redirect()->to(base_url('karyawan'));
	}
}
?>