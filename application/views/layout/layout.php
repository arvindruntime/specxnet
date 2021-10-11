<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<?php echo $this->page->getPage('layout/head'); ?>
	</head>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--fixed m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default">
		<!-- begin::Contain -->
		<?php echo $this->page->getPage($contain); ?>
		<!-- end::Contain -->

		<!-- begin::Footer -->
		<?php 
			echo $this->page->getPage('layout/footer');
		?>
		<!-- end::Footer -->
    </body>
	<!-- end::Body -->
</html>