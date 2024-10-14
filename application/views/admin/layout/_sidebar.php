<aside id="sidebar" class="sidebar">
<!-- <h4><i class="bi bi-person-circle"></i> <?= $this->session->userdata('nama') ?></h4>
		<span class=""><?= $this->session->userdata('level') ?></span> -->
<ul class="sidebar-nav" id="sidebar-nav">
<?php $menu = $this->uri->segment(2); ?>
  <li class="nav-item">
	<a class="nav-link <?php if($menu == 'dashboard'){echo '';}else{echo 'collapsed'; } ?>" href="<?= base_url('admin/dashboard') ?>">
	  <i class="bi bi-grid"></i>
	  <span>Dashboard</span>
	</a>
  </li><!-- End Dashboard Nav -->

  <li class="nav-item">
	<a class="nav-link <?php if($menu == 'kategori'){echo '';}else{echo 'collapsed'; } ?>"  href="<?= base_url('admin/kategori') ?>">
	  <i class="bi bi-menu-button-wide"></i><span>Kategori</span></i>
	</a>
  </li><!-- End Components Nav -->

  <li class="nav-item">
	<a class="nav-link <?php if($menu == 'buku'){echo '';}else{echo 'collapsed'; } ?>" href="<?= base_url('admin/buku') ?>">
	  <i class="bi bi-journal-text"></i><span>Buku</span></i>
	</a>
  </li><!-- End Forms Nav -->

  <li class="nav-item">
	<a class="nav-link <?php if($menu == 'denda'){echo '';}else{echo 'collapsed'; } ?>"  href="<?= base_url('admin/denda') ?>">
	  <i class="bi bi-layout-text-window-reverse"></i><span>Denda</span></i>
	</a>
  </li><!-- End Tables Nav -->

  <li class="nav-item">
	<a class="nav-link <?php if($menu == 'peminjaman'){echo '';}else{echo 'collapsed'; } ?>"  href="<?= base_url('admin/peminjaman') ?>">
	  <i class="bi bi-bar-chart"></i><span>Peminjaman</span></i>
	</a>
  </li><!-- End Charts Nav -->

  
  <li class="nav-item">
	<a class="nav-link <?php if($menu == 'pengembalian'){echo '';}else{echo 'collapsed'; } ?>"  href="<?= base_url('admin/pengembalian') ?>">
	  <i class="bi bi-bar-chart"></i><span>Pengembalian</span></i>
	</a>
  </li><!-- End Charts Nav -->
<?php if($this->session->userdata('level') == 'ADMIN'){ ?>
  <li class="nav-item">
	<a class="nav-link <?php if($menu == 'user'){echo '';}else{echo 'collapsed'; } ?>"  href="<?= base_url('admin/user') ?>">
	  <i class="bi bi-gem"></i><span>User</span></i>
	</a>
  </li><!-- End Icons Nav -->
  <?php } ?>

  <li class="nav-heading">Pages</li>

</ul>

</aside><!-- End Sidebar-->
