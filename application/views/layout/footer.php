<!-- BEGIN : LOAD MODEL -->
<div class="modal fade hide" id="modal" role="dialog" aria-labelledby="" aria-hidden="true">
	 <div class="modal-dialog" role="document">
	 	<div class="modal-content">
	 		<div class="modal-header">
                <h5 class="modal-title form-modal-tile">
                	  Loading...
                </h5>
                <button type="button" class="close" onclick="location.reload();" aria-label="Close">
                <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
	 		<div class="modal-body">

			</div>
	 	</div>
	 </div>
</div>

<div class="modal fade hide" id="modal2" role="dialog" aria-labelledby="" aria-hidden="true">
	 <div class="modal-dialog modal-sm" role="document">
	 	<div class="modal-content">
	 		<div class="modal-header">
                <h5 class="modal-title form-modal-tile formTitle">
                	  Loading...
                </h5>
                <button type="button" class="close" onclick="location.reload();" aria-label="Close">
                <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>
	 		<div class="modal-body newBody">

			</div>
	 	</div>
	 </div>
</div>
<!-- END : LOAD MODEL -->



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