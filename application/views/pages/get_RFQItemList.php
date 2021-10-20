<?php //print_r($getItemList);

//print_r($getFormat);?><table class="table table-borderless">

                                                              
                                <tr>

                                    <td colspan="4" align="center">

                                        <table class="table table-bordered">

                                            <thead>

                                                <tr style="height: 32px;color: black;background-color: #d1cdcd;font-size: 15px">
													<th><input type="checkbox" name="" value=""></th>
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
														
														<input type="hidden" name="fk_b_id" id="fk_b_id" value="<?php echo isset($item['fk_b_id']) ? $item['fk_b_id'] : ''; ?>">
														
														

														<input type="hidden" name="bw_id" id="bw_id" value="<?php echo isset($item['bw_id']) ? $item['bw_id'] : ''; ?>">
							
                                                            <tr>
																<td><input type="checkbox" name="item_id" value="" ></td>
                                                                <td><?php echo $i?></td>

                                                                <td>
																	<input type="text" name="room_type" id="add_room_type" class="form-control m-input" value="<?php echo isset($item['room_type']) ? $item['room_type'] : ''; ?>" placeholder="Room Type" required="">
																<?php //echo $item['room_type']?></td>

                                                                <td>
																<input type="text" name="item_name" id="add_item_name" class="form-control m-input" placeholder="Item Ref" value="<?php echo isset($item['item_name']) ? $item['item_name'] : ''; ?>" required="">
																<?php //echo $item['item_name']?></td>

                                                                <td>
																<input type="text" name="id_code" id="add_id_code" class="form-control m-input" value="<?php echo isset($item['id_code']) ? $item['id_code'] : ''; ?>" placeholder="ID Code" required="">
																<?php //echo $item['id_code']?></td>

                                                                <td><input type="text" name="item_type" id="add_item_type" class="form-control m-input" value="<?php echo isset($item['item_type']) ? $item['item_type'] : ''; ?>" placeholder="Item Type" required="">
																<?php //echo $item['item_type']?></td>

                                                                <td>
																	<input type="file" name="photo" id="add_photo" value="" class="form-control m-input">
																	
																	<input type="hidden" name="temp_photo" id="temp_photo" value="<?php echo isset($item['photo']) ? $item['photo'] : '';?>" class="form-control m-input">
																	
																<?php if ($item['photo']){?><img height="80" width="80" src="upload/addItemImages/<?php echo $item['photo']?>"><?php } else {echo "N/A";} ?></td>

                                                                <td>
																<input type="text" name="width" id="add_width" value="<?php echo isset($item['width']) ? $item['width'] : '';?>" class="form-control m-input" placeholder="Width">
																<?php //echo $item['width']?></td>

                                                                <td><?php echo $item['depth']?></td>

                                                                <td><?php echo $item['height']?></td>

                                                                <td><?php echo $item['short_height']?></td>

                                                                <td><?php echo $item['technical_description']?></td>

                                                                <td><?php echo $item['quantity']?></td>

                                                                <td><?php echo $item['fabric_quantity']?></td>

                                                                <td><?php echo $item['leather_quantity']?></td>

                                                                <td><?php echo $item['cbm']?></td>

                                                                <td><?php echo $item['note']?></td>
																<td><button type="button" data-type="save_n_close" class="btn btn-primary m-btn" id="WorkSheetBtn" style="font-family: sans-serif, Arial;">Update</button></td>

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