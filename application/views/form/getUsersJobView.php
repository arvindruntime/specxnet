
<div class="row" style="padding:0 2rem">
	<input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
	<div class="m-form__actions" id="proposalTemplate" style="padding: 0; margin-top: 3px;width: 100%;">
	    <table class="table table-bordered" id="jobTable">
	        
	    </table>
	    <script type="text/javascript">
            var lop_id = $("#user_id").val();
            datastring = {user_id : lop_id};
            table.usersJobTable(datastring);
        </script>
	</div>
</div>

