<?php
namespace App\Models;
use CodeIgniter\Model;
class Kriteriamodel extends Model{
	protected $table = 'kriteria';
	protected $primmaryKey = 'idkriteria';

	protected $useAutoIncrement = true;
	protected $allowedFields = ['kriteria','kategori','bobot','jenis','batas','satuan','persentase'];

	public function updatedata($id,$data){
		$this->db->table('kriteria')->where(['idkriteria' => $id])->set($data)->update();
	}
}
?>