<!-- BEGIN : LOAD MODEL -->
<div class="modal fade hide" id="modal" role="dialog" aria-labelledby="" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document" style="max-width: 1200px !important;">
        <!-- <form action="<?php echo base_url().'proposal/create/'?>" enctype="multipart/form-data" method="post" id="feedInput" class="m-form m-form--fit m-form--label-align-right"> -->
            <div class="modal-content">
                <div style="padding:0.8rem">
                    <div class="row">
                        
                        
                        <!-- <div class="col-lg-2 col-md-2 col-sm-6" align="right" style="height: 37.5px">
                            <select class="form-control greyborder" name="">
                                <option value="Checked Action" selected="">Import</option>
                                <option value="fluid">Menu 1</option>
                                <option value="boxed">Menu 2</option>
                            </select>
                        </div> -->
                    </div>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="">RFQ Details</h5>
                    <a  id="close" class="close" href="<?php echo base_url().'rfq';?>"><span aria-hidden="true" class="la la-remove"></span></a>
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                    </button>-->
                </div>
                <div class="modal-body">
                </div>
            </div>
        <!-- </form> -->
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