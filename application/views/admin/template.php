<!DOCTYPE html>
<html lang="en">
<head>
<?php include('layout/_css.php') ?>
</head>
<body>
  <!-- ======= Header ======= -->
<?php include('layout/_header.php') ?>
  <!-- ======= Sidebar ======= -->
<?php include('layout/_sidebar.php') ?>
  <main id="main" class="main">
	<div class="mb-3 mt-3">
		<?= $this->session->flashdata('alert') ?>
	</div>
	<?= $contents ?>
  </main><!-- End #main -->
<?php include('layout/_js.php') ?>
</body>
</html>
