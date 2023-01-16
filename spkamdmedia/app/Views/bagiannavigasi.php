<?php $request = \Config\Services::request(); ?>
<nav class="navbar navbar-expand-lg main-navbar">
  <form class="form-inline mr-auto">
    <ul class="navbar-nav mr-3">
      <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fa fa-bars"></i></a></li>
    </ul>
  </form>
  <ul class="navbar-nav navbar-right">
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
      <img alt="image" src="<?php echo base_url('/assets/img/logo.png') ?>" class="rounded-circle mr-1">
      <div class="d-sm-none d-lg-inline-block">Hi, Administrator</div></a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?php echo base_url('profile') ?>" class="dropdown-item has-icon">
          <i class="fa fa-cogs"></i> Kelola Akses
        </a>
        <div class="dropdown-divider"></div>
        <a href="<?php echo base_url('getlogout') ?>" class="dropdown-item has-icon text-danger">
          <i class="fa fa-sign-out"></i> Logout
        </a>
      </div>
    </li>
  </ul>
</nav>
<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="<?php echo base_url('') ?>">SPK SAW</a>
    </div>
    <ul class="sidebar-menu">
      <li <?php if($request->uri->getsegment(1) == ''){ ?> class="active" <?php } ?>><a class="nav-link" href="<?php echo base_url('') ?>"><i class="fa fa-table"></i> <span>Dashboard</span></a></li>
      <li <?php if($request->uri->getsegment(1) == 'karyawan'){ ?> class="active" <?php } ?>><a class="nav-link" href="<?php echo base_url('karyawan') ?>"><i class="fa fa-users"></i> <span>Karyawan</span></a></li>
      <li <?php if($request->uri->getsegment(1) == 'kriteria'){ ?> class="active" <?php } ?>><a class="nav-link" href="<?php echo base_url('kriteria') ?>"><i class="fa fa-tag"></i> <span>Kriteria</span></a></li>
      <li <?php if($request->uri->getsegment(1) == 'indikator'){ ?> class="active" <?php } ?>><a class="nav-link" href="<?php echo base_url('indikator') ?>"><i class="fa fa-edit"></i> <span>Indikator</span></a></li>
      <li <?php if($request->uri->getsegment(1) == 'nilai'){ ?> class="active" <?php } ?>><a class="nav-link" href="<?php echo base_url('nilai') ?>"><i class="fa fa-shield"></i> <span>Penilaian</span></a></li>
      <li <?php if($request->uri->getsegment(1) == 'analisa'){ ?> class="active" <?php } ?>><a class="nav-link" href="<?php echo base_url('analisa') ?>"><i class="fa fa-line-chart"></i> <span>Analisa</span></a></li>
    </ul>
  </aside>
</div>