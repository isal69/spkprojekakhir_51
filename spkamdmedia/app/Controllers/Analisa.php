<?php
namespace App\Controllers;
use App\Models\KriteriaModel;
use App\Models\KaryawanModel;
use App\Libraries\Fpdf\Fpdf;
class Analisa extends BaseController{
	
	public function index(){
		if(session()->get('admin')){
			$mod = new KriteriaModel();
			$mods = new KaryawanModel();
			$data['kriteria'] = $mod->findAll();
			$data['data'] = $mods->findAll();
			$data['bulan'] = date('m');
			$data['tahun'] = date('Y');
			return view('analisa',$data);
		}else{
			return view('login');	
		}
	}

	public function tampildata(){
		$mod = new KriteriaModel();
		$mods = new KaryawanModel();
		$data['kriteria'] = $mod->findAll();
		$data['data'] = $mods->findAll();
		$data['bulan'] = $this->request->getPost('bulan');
		$data['tahun'] = $this->request->getPost('tahun');
		return view('analisa',$data);
	}

	public function prosesdata($x){
		$db = db_connect();
		$mod = new KriteriaModel();
		$mods = new KaryawanModel();
		$bul = [1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		$p = explode("_", $x);
		$x = explode("_", $x);
		$x = $bul[(int)$x[0]]." ".$x[1];
		$karyawan = $db->query("select idkaryawan from nilai where periode = '".$x."' group by idkaryawan asc")->getResultArray();
		$kriteria = $db->query("select kriteria.* from nilai join kriteria on nilai.idkriteria = kriteria.idkriteria where nilai.periode = '".$x."' group by nilai.idkriteria asc")->getResultArray();
		foreach ($karyawan as $kry) {
			$na = 0;
			foreach ($kriteria as $krt) {
				$nn = 0;
				$nx = 0;
				$nmax = 0;
				$nmin = 0;
				$cek = $db->query("select nilai from nilai where periode = '".$x."' and idkriteria = '".$krt['idkriteria']."' and idkaryawan = '".$kry['idkaryawan']."'")->getResultArray();
				if(count($cek) > 0){
					$nx = $db->query("select nilai from nilai where periode = '".$x."' and idkriteria = '".$krt['idkriteria']."' and idkaryawan = '".$kry['idkaryawan']."'")->getRowArray()['nilai'];
					$nilai = $db->query("select max(nilai) as max, min(nilai) as min from nilai where periode = '".$x."' and idkriteria = '".$krt['idkriteria']."'")->getRowArray();
					$nmax = $nilai['max'];
					$nmin = $nilai['min'];
				}
				if($krt['kategori'] == 'Cost' && $nx > 0 && $nmin > 0){
					$nn = ($nmin/$nx) * $krt['persentase']/100;
				}
				if($krt['kategori'] == 'Benefit' && $nx > 0 && $nmax > 0){
					$nn = ($nx/$nmax) * $krt['persentase']/100;
				}
				$na += $nn;
			}
			$na = number_format($na*100,2);
			$cek = $db->query("select idnilai from nilaiakhir where periode = '".$x."' and idkaryawan = '".$kry['idkaryawan']."'")->getResultArray();
			if(count($cek) > 0){
				$kode = $db->query("select idnilai from nilaiakhir where periode = '".$x."' and idkaryawan = '".$kry['idkaryawan']."'")->getRowArray()['idnilai'];
				$db->table("nilaiakhir")->where(["idnilai" => $kode])->set(["na" => $na])->update();
			}else{
				$data = array(
					'idnilai' => null,
					'na' => $na,
					'periode' => $x,
					'idkaryawan' => $kry['idkaryawan']
				);
				$db->table("nilaiakhir")->insert($data);	
			}
		}
		$data['kriteria'] = $mod->findAll();
		$data['data'] = $mods->findAll();
		$data['bulan'] = $p[0];
		$data['tahun'] = $p[1];
		return view('analisa',$data);
	}

	public function cetakdata($x){
		$db = db_connect();
		$bul = [1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
		$x = explode("_", $x);
		$x = $bul[(int)$x[0]]." ".$x[1];
		$karyawan = $db->query("select karyawan.* from nilai join karyawan on nilai.idkaryawan = karyawan.idkaryawan where nilai.periode = '".$x."' group by nilai.idkaryawan asc")->getResultArray();
		$kriteria = $db->query("select kriteria.* from nilai join kriteria on nilai.idkriteria = kriteria.idkriteria where nilai.periode = '".$x."' group by nilai.idkriteria asc")->getResultArray();
		$hasil = $db->query("select karyawan.*, nilaiakhir.na from nilaiakhir join karyawan on nilaiakhir.idkaryawan = karyawan.idkaryawan where nilaiakhir.periode = '".$x."' order by nilaiakhir.na desc")->getResultArray();

		$this->pdf = new fpdf('P','mm','A4');
		$this->pdf->AddPage();
		$this->pdf->SetLineWidth(0.8);
		$this->pdf->Line(10,27,200,27);
		$this->pdf->SetLineWidth(0);
		$this->pdf->SetFont('Arial','B',16);
		$this->pdf->Cell(190,6,'AMD',0,1,'R');
		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,6,'A Million Dreams Creative Rich Media',0,1,'R');
		$this->pdf->SetFont('Arial','',9);
		$this->pdf->Cell(190,4,'Jl. Lestari, Pringlangu, Kec. Pekalongan Bar., Kota Pekalongan, Jawa Tengah 51117, 0857 7373 7670',0,1,'R');
		$this->pdf->Ln(6);
		$this->pdf->SetFont('Arial','BU',11);
		$this->pdf->Cell(190,5,'LAPORAN HASIL ANALISIS KINERJA KARYAWAN',0,1,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(190,5,$x,0,1,'C');
		$this->pdf->Ln(10);

		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,8,'KRITERIA PENILAIAN ANALISIS',0,1,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10,7,'No.',1,0,'C');
		$this->pdf->Cell(120,7,'Kriteria',1,0,'C');
		$this->pdf->Cell(40,7,'Kategori',1,0,'C');
		$this->pdf->Cell(20,7,'Bobot (%)',1,1,'C');

		$this->pdf->SetFont('Arial','',10);
		$n = 1;
		foreach ($kriteria as $k) {
			$this->pdf->Cell(10,6,$n,1,0,'C');
			$this->pdf->Cell(120,6,$k['kriteria'],1,0);
			$this->pdf->Cell(40,6,$k['kategori'],1,0,'C');
			$this->pdf->Cell(20,6,number_format($k['persentase']),1,1,'C');
			$n++;
		}
		$this->pdf->Ln(5);

		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,8,'REKAP PENILAIAN KARYAWAN',0,1,'C');
		$this->pdf->SetFont('Arial','B',10);
		$this->pdf->Cell(10,7,'No.',1,0,'C');
		$this->pdf->Cell(40,7,'Nama',1,0,'C');
		$this->pdf->Cell(15,7,'Jekel',1,0,'C');
		$this->pdf->Cell(100,7,'Alamat',1,0,'C');
		$this->pdf->Cell(25,7,'Telepon',1,1,'C');
		$this->pdf->SetFont('Arial','',9);
		$n = 1;
		foreach ($karyawan as $k) {
			$this->pdf->Cell(10,7,$n,1,0,'C');
			$this->pdf->Cell(40,7,$k['nama'],1,0);
			$this->pdf->Cell(15,7,$k['jekel'],1,0,'C');
			$this->pdf->Cell(100,7,$k['alamat'],1,0);
			$this->pdf->Cell(25,7,$k['telepon'],1,1);
			$n++;
		}
		$this->pdf->Ln(5);

		$a = (int)140/count($kriteria);
		$b = 172 - ($a * count($kriteria));		

		$this->pdf->SetFont('Arial','B',12);
		$this->pdf->Cell(190,8,'NILAI AKHIR ANALISIS',0,1,'C');
		$this->pdf->SetFont('Arial','B',8);
		$this->pdf->Cell(8,7,'No.',1,0,'C');
		$this->pdf->Cell($b,7,'Nama',1,0,'C');
		foreach ($kriteria as $k) {
			$this->pdf->Cell($a,7,$k['kriteria'],1,0,'C');
		}
		$this->pdf->Cell(10,7,'NA',1,1,'C');
		$this->pdf->SetFont('Arial','',7);
		$n = 1;
		foreach ($hasil as $k) {
			$this->pdf->Cell(8,6,$n,1,0,'C');
			$this->pdf->Cell($b,6,$k['nama'],1,0);
			foreach ($kriteria as $kr) {
				$i = $db->query("select indikator from nilai where periode = '".$x."' and idkriteria = '".$kr['idkriteria']."' and idkaryawan = '".$k['idkaryawan']."'")->getRowArray()['indikator'];
				$this->pdf->Cell($a,6,$i,1,0);
			}
			$this->pdf->Cell(10,6,number_format($k['na'],2),1,1,'C');
			$n++;
		}

		$this->pdf->Ln(5);
		$this->pdf->Ln(10);
		$this->pdf->SetFont('Arial','',11);
		$this->pdf->Cell(95,7,'',0,0,'C');
		$this->pdf->Cell(95,7,'Pekalongan, '.$this->tanggal_indo(date('Y-m-d')),0,1,'C');
		$this->pdf->Cell(95,7,'',0,0,'C');
		$this->pdf->Cell(95,7,'Mengetahui',0,1,'C');
		$this->pdf->Ln(20);
		$this->pdf->SetFont('Arial','BU',11);
		$this->pdf->Cell(95,7,'',0,0,'C');
		$this->pdf->Cell(95,7,'Bagian SDM',0,1,'C');

		$this->pdf->Output("Laporan Analisa ".date('dmyHis').".pdf", 'D');
	}

	function tanggal_indo($tanggal, $cetak_hari = false){
		$bulan = array (1 =>   'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember');
		$split    = explode('-', $tanggal);
		$tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
		return $tgl_indo;
	}
}
?>