<?php
$db = db_connect();
$bul = [1 => 'Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
$karyawan = $db->query("select * from karyawan")->getResultArray();
$kriteria = $db->query("select * from kriteria")->getResultArray();
$indikator = $db->query("select * from indikator")->getResultArray();
$periode = $bul[(int)date('m')]." ".date('Y');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php echo view('bagianhead') ?>
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      <?php echo view('bagiannavigasi') ?>
      <div class="main-content">
        <section class="section">
          <div class="section-header">
            <h1>Halaman Awal</h1>
          </div>
          <div class="section-body">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-primary">
                    <i class="fa fa-users fa-2x" style="color:white;"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Data Karyawan</h4>
                    </div>
                    <div class="card-body">
                      <?php echo number_format(count($karyawan)) ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-danger">
                    <i class="fa fa-tag fa-2x" style="color:white;"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Data Kriteria</h4>
                    </div>
                    <div class="card-body">
                      <?php echo number_format(count($kriteria)) ?>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                  <div class="card-icon bg-warning">
                    <i class="fa fa-edit fa-2x" style="color:white;"></i>
                  </div>
                  <div class="card-wrap">
                    <div class="card-header">
                      <h4>Data Indikator</h4>
                    </div>
                    <div class="card-body">
                      <?php echo number_format(count($indikator)) ?>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-6 col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Progress Data Nilai <?php echo $periode ?></h4>
                  </div>
                  <div class="card-body">
                    <?php
                    $keterangan = "";
                    $persentase = 0;
                    $total = count($karyawan);
                    $lengkap = 0;
                    foreach ($karyawan as $k) {
                      $cek = $db->query("select count(*) as jumlah from nilai where periode = '".$periode."' and idkaryawan = '".$k['idkaryawan']."'")->getRowArray()['jumlah'];
                      if($cek == count($kriteria)){
                        $lengkap++;
                      }
                    }
                    if($total > 0 && $lengkap > 0){
                      $persentase = number_format(($lengkap/$total)*100,2);
                    }
                    if($persentase == 0){
                      $keterangan = "(Data Belum Tersedia)";
                    }else if($persentase == 100){
                      $keterangan = "(Data Lengkap)";
                    }else{
                      $keterangan = "(".($total - $lengkap)." Karyawan belum melengkapi data penilaian)";
                    }
                    ?>
                    <div class="mb-4">
                      <div class="text-small float-right font-weight-bold text-muted"><?php echo $persentase." % (".number_format($lengkap)." dari ".number_format($total).")"; ?></div>
                      <div class="font-weight-bold mb-1">Data Karyawan <?php echo $keterangan ?></div>
                      <div class="progress" data-height="3">
                        <div class="progress-bar" role="progressbar" data-width="<?php echo $persentase ?>%" aria-valuenow="<?php echo $persentase ?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                    <?php
                    $keterangan = "";
                    $persentase = 0;
                    $total = count($karyawan) * count($kriteria);
                    $lengkap = 0;
                    foreach ($karyawan as $k) {
                      $cek = $db->query("select count(*) as jumlah from nilai where periode = '".$periode."' and idkaryawan = '".$k['idkaryawan']."'")->getRowArray()['jumlah'];
                      $lengkap += $cek;
                    }
                    if($total > 0 && $lengkap > 0){
                      $persentase = number_format(($lengkap/$total)*100,2);
                    }
                    if($persentase == 0){
                      $keterangan = "(Data Belum Tersedia)";
                    }else if($persentase == 100){
                      $keterangan = "(Data Lengkap)";
                    }else{
                      $keterangan = "(".($total - $lengkap)." Indikator Penilaian belum dimasukkan)";
                    }
                    ?>
                    <div class="mb-4">
                      <div class="text-small float-right font-weight-bold text-muted"><?php echo $persentase." % (".number_format($lengkap)." dari ".number_format($total).")"; ?></div>
                      <div class="font-weight-bold mb-1">Data Penilaian <?php echo $keterangan ?></div>
                      <div class="progress" data-height="3">
                        <div class="progress-bar" role="progressbar" data-width="<?php echo $persentase ?>%" aria-valuenow="<?php echo $persentase ?>" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php echo view('bagianfooter') ?>
</div>
</div>
<?php echo view('bagianscript') ?>
</body>
</html>