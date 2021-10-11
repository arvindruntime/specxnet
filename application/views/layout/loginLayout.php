<!DOCTYPE html>
<html lang="en" >
	<!-- begin::Head -->
	<head>
		<?php echo $this->page->getPage('layout/loginHead'); ?>
	</head>
	<!-- end::Head -->

	<!-- begin::Body -->
	<body style="background: url('<?php echo base_url();?>images/banner.jpg') no-repeat center">
		<!-- begin::Contain -->
		<?php echo $this->page->getPage($contain); ?>
		<!-- end::Contain -->

		<!-- begin::Footer -->
		<?php echo $this->page->getPage('layout/loginFooter'); ?>
		<!-- end::Footer -->
    </body>
	<!-- end::Body -->
</html>