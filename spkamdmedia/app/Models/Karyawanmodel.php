<?php
namespace App\Models;
use CodeIgniter\Model;
class Karyawanmodel extends Model{
	protected $table = 'karyawan';
	protected $primmaryKey = 'idkaryawan';

	protected $useAutoIncrement = true;
	protected $allowedFields = ['nik','nama','jekel','alamat','telepon'];

	public function updatedata($id,$data){
		$this->db->table('karyawan')->where(['idkaryawan' => $id])->set($data)->update();
	}
}
?>