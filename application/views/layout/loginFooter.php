<script>
	window.baseUrl = "<?php echo base_url() ?>";
</script>
<!-- START OF FOOTER JS -->
<?php 
	$footerJs = $this->page->getFooterJs();
	foreach($footerJs as $js) { 
		echo '<script type="text/javascript" src="'.$js.'"></script>';
 	} 

?>
<!-- END OF FOOTER JS -->