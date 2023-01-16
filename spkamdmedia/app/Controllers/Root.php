<?php
namespace App\Controllers;
use CodeIgniter\Config\Services;
class Root extends BaseController{
	public function index(){
		if(session()->get('admin')){
			return view('landing');
		}else{
			return view('login');	
		}
	}

	public function proseslogin(){
		$db = db_connect();
		$username = $this->request->getPost('username');
		$password = md5($this->request->getPost('password'));
		$cek = $db->query("select * from pengguna where username = '".$username."' and password = '".$password."'")->getResult();
		if(count($cek) > 0){
			session()->set("admin","login");
			return redirect()->to(base_url(''));
		}else{
			session()->setFlashdata('gagal','Kombinasi log in salah!');
			return view('login');
		}
	}

	public function proseslogout(){
		session_unset();
		session()->remove('admin');
		return redirect()->to(base_url(''));
	}
}
?>