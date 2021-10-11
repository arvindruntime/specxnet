<?php //print_r($getItemList);

//print_r($getFormat);
?><table class="table table-borderless">

    <tr>

        <td colspan="4" align="center">

            <img src="<?php echo base_url() . 'upload/SpecXReef_Logo.png' ?>">

        </td>

    </tr>

    <tr>

        <td colspan="4">

            <div><span style="color: rgb(39, 39, 39); font-family: Lato, sans-serif; font-size: 15px; font-weight: bold;">

                    <?php echo isset($getFormat[0]['format_header']) ? $getFormat[0]['format_header'] : ''; ?>

                </span><br></div>

        </td>

    </tr>

    <tr>

        <td colspan="4" align="center">

            <table class="table table-bordered">

                <thead>

                    <tr style="height: 32px;color: black;background-color: #d1cdcd;font-size: 15px">

                        <th>Sr No</th>

                        <th>Room Type</th>

                        <th>Item Name</th>

                        <th>Item Code</th>

                        <th>Item Type</th>

                        <!-- <th>Photo</th> -->

                        <!-- <th>Width</th> -->

                        <!-- <th>Depth</th> -->

                        <!-- <th>Height</th> -->

                        <!-- <th>Short Height</th> -->

                        <!-- <th>Technical Description</th> -->

                        <th>Quantity</th>
                        <!-- <th>Fabric Quantity</th> -->

                        <!-- <th>Leather Quantity</th> -->

                        <!-- <th>Markup in %</th> -->
                        <th>Rate in USD</th>

                        <th>Exchange Rate</th>
                        <th>Rate in AED</th>
                        <th>Total Amount</th>

                        <!-- <th>Fabric Quantity</th> -->

                        <!-- <th>Leather Quantity</th> -->

                        <!-- <th>CBM</th> -->

                        <!-- <th>Note</th> -->

                    </tr>

                </thead>

                <tbody>

                    <?php

                    if (isset($getItemList)) {

                        $i = 1;

                        foreach ($getItemList as $item) {

                            if ($item['item_name'] != '') {

                    ?>

                                <tr>

                                    <td><?php echo $i ?></td>

                                    <td><?php echo $item['room_type'] ?></td>

                                    <td><?php echo $item['item_name'] ?></td>

                                    <td><?php echo $item['id_code'] ?></td>

                                    <td><?php echo $item['item_type'] ?></td>

                                    <!-- <td><?php if ($item['photo']) { ?><img height="80" width="80" src="upload/addItemImages/<?php echo $item['photo'] ?>"><?php } else {
                                                                                                                                                                echo "N/A";
                                                                                                                                                            } ?></td> -->

                                    <!-- <td><?php echo $item['width'] ?></td> -->

                                    <!-- <td><?php echo $item['depth'] ?></td> -->

                                    <!-- <td><?php echo $item['height'] ?></td> -->

                                    <!-- <td><?php echo $item['short_height'] ?></td> -->

                                    <!-- <td><?php echo $item['technical_description'] ?></td> -->

                                    <td><?php echo $item['quantity'] ?></td>
                                    <td><?php if(!empty($item['rate_USD'])){ echo $item['rate_USD']; }else{echo"N/A"; } ?></td>
                                    <td><?php if(!empty($item['exchange_rate'])){ echo $item['exchange_rate']; }else{echo"N/A"; } ?></td>
                                    <td><?php if(!empty($item['rate_AED'])){ echo $item['rate_AED']; }else{echo"N/A"; } ?></td>
                                    <td><?php if(!empty($item['total_amount'])){ echo $item['total_amount']; }else{echo"N/A"; } ?></td>
                                    <!-- <td><?php echo $item['rate_AED'] ?></td> -->
                                    <!-- <td><?php echo $item['total_amount'] ?></td> -->

                                    <!-- <td><?php echo $item['fabric_quantity'] ?></td> -->

                                    <!-- <td><?php echo $item['leather_quantity'] ?></td> -->

                                    <!-- <td><?php echo $item['cbm'] ?></td> -->

                                    <!-- <td><?php echo $item['note'] ?></td> -->

                                </tr>

                        <?php

                                $i++;
                            }
                        }
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

    <tr>

        <td>

            <div><span style="color: rgb(39, 39, 39); font-family: Lato, sans-serif; font-size: 15px; font-weight: bold;">

                    <?php echo isset($getFormat[0]['format_footer']) ? $getFormat[0]['format_footer'] : ''; ?>

                </span><br></div>

        </td>

    </tr>

</table>