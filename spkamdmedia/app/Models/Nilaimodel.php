<?php
namespace App\Models;
use CodeIgniter\Model;
class Nilaimodel extends Model{
	protected $table = 'nilai';
	protected $primmaryKey = 'idnilai';

	protected $useAutoIncrement = true;
	protected $allowedFields = ['indikator','nilai','periode','idkriteria','idkaryawan'];

	public function updatedata($id,$data){
		$this->db->table('nilai')->where(['idnilai' => $id])->set($data)->update();
	}
}
?>