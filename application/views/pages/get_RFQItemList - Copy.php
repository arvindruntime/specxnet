<?php //print_r($getItemList);?>
<table class="table table-borderless">
            
<tr>

<td colspan="4" align="center">

<table class="table table-bordered">

<thead>

    <tr style="height: 32px;color: black;background-color: #d1cdcd;font-size: 15px">
		<th><input type="checkbox" onClick="selectItems(this)"></th>
        <th>Sr No</th>

        <th>Room Type</th>

        <th>Item Name</th>

        <th>Item Code</th>

        <th>Item Type</th>

        <th>Photo</th>

        <th>Width</th>

        <th>Depth</th>

        <th>Height</th>

        <th>Short Height</th>

        <th>Technical Description</th>

        <th>Quantity</th>

        <th>Fabric Quantity</th>

        <th>Leather Quantity</th>

        <th>CBM</th>

        <th>Note</th>
		<th>Action</th>

    </tr>

</thead>

<tbody>

    <?php

        if (isset($getItemList)) {

            $i=1;

            foreach ($getItemList as $item) { 

                if ($item['item_name'] !='') {
            ?>
			<form enctype="multipart/form-data" method="post" class="m-form m-form--fit m-form--label-align-right item-list">

                <tr>
					<td><input type="checkbox" name="items" value="<?php echo isset($item['bw_id']) ? $item['bw_id'] : ''; ?>" >
            <input type="hidden" name="fk_b_id" class="fk_b_id" value="<?php echo isset($item['fk_b_id']) ? $item['fk_b_id'] : ''; ?>">

            <input type="hidden" name="bw_id" class="bw_id" value="<?php echo isset($item['bw_id']) ? $item['bw_id'] : ''; ?>">

                    </td>
                    <td><?php echo $i?></td>

                    <td>
						<input type="text" name="room_type" class="form-control m-input add_room_type" value="<?php echo isset($item['room_type']) ? $item['room_type'] : ''; ?>" placeholder="Room Type" required="">
					<?php //echo $item['room_type']?></td>

                    <td>
					<input type="text" name="item_name" class="form-control m-input add_item_name" placeholder="Item Ref" value="<?php echo isset($item['item_name']) ? $item['item_name'] : ''; ?>" required="">
					<?php //echo $item['item_name']?></td>

                    <td>
					<input type="text" name="id_code" class="form-control m-input add_id_code" value="<?php echo isset($item['id_code']) ? $item['id_code'] : ''; ?>" placeholder="ID Code" required="">
					<?php //echo $item['id_code']?></td>

                    <td><input type="text" name="item_type" class="form-control m-input add_item_type" value="<?php echo isset($item['item_type']) ? $item['item_type'] : ''; ?>" placeholder="Item Type" required="">
					<?php //echo $item['item_type']?></td>

                    <td>
						<input type="file" name="photo" id="add_photo<?php echo isset($item['bw_id']) ? $item['bw_id'] : ''; ?>" class="form-control m-input">
						
					<?php if ($item['photo']){?><img height="80" width="80" src="upload/addItemImages/<?php echo $item['photo']?>"><?php } else {echo "N/A";} ?></td>

                    <td>
					<input type="text" name="width" value="<?php echo isset($item['width']) ? $item['width'] : '';?>" class="form-control m-input add_width" placeholder="Width">
					<?php //echo $item['width']?></td>

                    <td>
                        <input type="text" name="depth" value="<?php echo isset($item['depth']) ? $item['depth'] : '';?>" class="form-control m-input add_depth" placeholder="Depth">
                        <?php //echo $item['depth']?></td>

                    <td>
                        <input type="text" name="height" value="<?php echo isset($item['height']) ? $item['height'] : '';?>" class="form-control m-input add_material" placeholder="Height">
                        <?php //echo $item['height']?></td>

                    <td>
                        <input type="text" name="short_height" value="<?php echo isset($item['short_height']) ? $item['short_height'] : '';?>" class="form-control m-input add_short_height" placeholder="Short Height">

                        <?php //echo $item['short_height']?></td>

                    <td>
                        <textarea name="technical_description" class="form-control m-input add_technical_description" placeholder="Technical Description" rows="3" cols="3"><?php echo isset($item['technical_description']) ? $item['technical_description'] : '';?></textarea>

                        <?php //echo $item['technical_description']?></td>

                    <td>
                        <input type="text" name="quantity" value="<?php echo isset($item['quantity']) ? $item['quantity'] : '';?>" class="form-control m-input add_quantity" placeholder="Quantity">

                        <?php //echo $item['quantity']?></td>

                    <td>
                        <input type="text" name="fabric_quantity" value="<?php echo isset($item['fabric_quantity']) ? $item['fabric_quantity'] : '';?>" class="form-control m-input add_fabric_quantity" placeholder="Quantity">

                        <?php //echo $item['fabric_quantity']?></td>

                    <td>
                        <input type="text" name="leather_quantity" value="<?php echo isset($item['leather_quantity']) ? $item['leather_quantity'] : '';?>" class="form-control m-input add_leather_quantity" placeholder="Quantity">

                        <?php //echo $item['leather_quantity']?></td>

                    <td>
                        <input type="text" class="form-control m-input add_percentage_units" placeholder="CBM" value="<?php echo isset($item['cbm']) ? $item['cbm'] : '';?>" name="cbm" aria-describedby="basic-addon1">

                        <?php //echo $item['cbm']?></td>

                    <td>
                        <textarea class="form-control m-input add_note" placeholder="Note" value="" name="note" aria-describedby="basic-addon1" rows="3" cols="3"><?php echo isset($item['note']) ? $item['note'] : '';?></textarea>

                        <?php //echo $item['note']?></td>
					<td><button type="button" data-type="save_n_close" class="btn btn-primary m-btn" id="WorkSheetBtn" data-toggle="modal" data-target="#addModal" style="font-family: sans-serif, Arial;">Update</button></td>

                </tr>
				</form>
        <?php

            $i++; }}

        } else { ?>

            <tr>

                <td colspan="3">No Data Available</td>

            </tr>

       <?php }

        ?>
</tbody>

</table>

</td>

</tr>

</table>

<script type="text/javascript">
    function selectItems(source) {
    
  checkboxes = document.getElementsByName('items');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>