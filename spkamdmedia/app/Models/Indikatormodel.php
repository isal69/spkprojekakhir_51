<?php
namespace App\Models;
use CodeIgniter\Model;
class Indikatormodel extends Model{
	protected $table = 'indikator';
	protected $primmaryKey = 'idindikator';

	protected $useAutoIncrement = true;
	protected $allowedFields = ['indikator','nilai','idkriteria'];

	public function updatedata($id,$data){
		$this->db->table('indikator')->where(['idindikator' => $id])->set($data)->update();
	}
}
?>