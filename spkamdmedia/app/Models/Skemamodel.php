<?php
namespace App\Models;
use CodeIgniter\Model;
class Skemamodel extends Model{
	protected $table = 'Skema';
	protected $primmaryKey = 'kodeskema';

	protected $useAutoIncrement = true;
	protected $allowedFields = ['periode','kodekriteria'];
}
?>