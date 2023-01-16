<?php
namespace App\Controllers;
use CodeIgniter\Config\Services;
class Admin extends BaseController{
	public function index(){
		if(session()->get('admin')){
			return view('landing');
		}else{
			return view('login');	
		}
	}

	public function tampilprofil(){
		$db = db_connect();
		$data['data'] = $db->query("select * from pengguna limit 1")->getRowArray();
		return view('profil',$data);
	}

	public function ubahprofil(){
		$db = db_connect();
		$username = $this->request->getPost('username');
		$password = $this->request->getPost('password');
		if($password == ''){
			$data = array('username' => $username);
		}else{
			$data = array(
				'username' => $username,
				'password' => md5($password)
			);
		}
		$db->table("pengguna")->set($data)->update();
		return redirect()->to(base_url('profile'));
	}
}
?>