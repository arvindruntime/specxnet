<div class="btn-group">
	<select class="form-control greyborder gridView" id="gridsort">
		<option value="<?php echo $module_name?>"> Standard View</option>
		<?php
			foreach($gridView as $grid) { ?>
				<option value="<?php echo $grid['grid_id']; ?>"><?php echo $grid['grid_name']?></option>	
		<?php } ?>
	</select>
	<button class="btn-default btn-sm btn" type="button" tabindex="-1" data-provider="bootstrap-markdown" id="myselect3" data-handler="bootstrap-markdown-cmdBold" m-dropdown-toggle="click"> 
					<i class="la la-cog"></i>
					</button>
</div>
