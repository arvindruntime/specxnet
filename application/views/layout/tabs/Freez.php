<div class="btn-group">
	<div class="row">
		<div style="padding: 0 10px">
			<label class="m-checkbox" style="margin-top: 6px; margin-bottom: 0">
				<input type="checkbox" name="checkbox" id="freeze" <?php if (isset($freeze)) { echo "checked";}?>> Freeze
				<span></span>
			</label>
		</div>
		<div style="margin-left: 15px">
			<select class="form-control m-input freezeColumn" name="option" aria-describedby="option-error" aria-invalid="false">
				<option value="0">Select</option>
				<option value="1" <?php if (isset($freeze) && ($freeze == 1)) { echo "selected";}?>>1</option>
				<option value="2" <?php if (isset($freeze) && ($freeze == 2)) { echo "selected";}?>>2</option>
				<option value="3" <?php if (isset($freeze) && ($freeze == 3)) { echo "selected";}?>>3</option>
				<option value="4" <?php if (isset($freeze) && ($freeze == 4)) { echo "selected";}?>>4</option>
				<option value="5" <?php if (isset($freeze) && ($freeze == 5)) { echo "selected";}?>>5</option>
			</select>	
		</div>
		<label class="label-format">Columns</label>
	</div>
</div>
