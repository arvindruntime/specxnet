<div class="row" style="padding:0 2rem">
	<div class="m-form__actions" style="padding: 0; margin-top: 3px;">
		<?php if ($addProposal) { ?>
			<input type="hidden" id="fk_lead_opportunity_id" value="<?php echo $lead_opportunity_id; ?>">
			<button type="button" class="btn green m-btn m-btn--custom" style="font-family: sans-serif, Arial;" id="newProposal">New Proposal</button>
			<input type="hidden" id="statMsg2" value="ShowAdd">
			<span id="oppMsg2" style="margin-left: 29px;color: red;"></span>
<?php } ?>
	</div>
</div>

<div class="row" style="padding:0 2rem">
	<div class="m-form__actions" id="proposalTemplate" style="padding: 0; margin-top: 3px;width: 100%;">
	    <table class="table table-bordered" id="proposalTable">
	        
	    </table>
	    <script type="text/javascript">
            var lop_id = $("#fk_lead_opportunity_id").val();
            datastring = {lead_opportunity_id : lop_id};
            table.leadproposalPopupTable(datastring);
        </script>
	</div>
</div>

