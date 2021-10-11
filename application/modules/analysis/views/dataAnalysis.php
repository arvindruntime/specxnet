<style type="text/css">
    .table td {

        padding: 10px;

    }

    .table th {

        padding: 10px !important;

        font-weight: bold !important;

    }

    .table-bordered th,
    .table-bordered td {

        border: 1px solid #1e1e20;

    }
</style>




<div class="col-lg-3 col-md-3 col-sm-12 padtop4" style="margin-bottom: 12px">

    <label for="street_address">Markup in Percentage(%) <span style="color:red">*</span></label>

    <div class="input-group date">

        <input type="text" class="form-control m-input" id="final_markup" value="0" placeholder="Please Enter markup in %">

    </div>

</div>



<div class="col-md-6 col-sm-6 col-3">

    <label class="m-checkbox m-checkbox--solid m-checkbox--state-brand" style="padding-top: 5px;">

        <input type="checkbox" class="markup_apply" id="final_markup_apply"> <span></span>

    </label>

    <span style="font-size: 15px">Add To Apply</span>

</div>



<form action="analysis/sendProposal/<?php echo $fk_b_id ?>" method="post" name="analysis">

    <div class="row">

        <div class="col-md-12" style="overflow: auto;">

            <table class="table table-striped- table-bordered table-hover table-checkable" id="bid-analysis">

                <tr>

                    <!-- <th>Items ID</th> -->
                    <th>Items</th>

                    <th>Item Type</th>

                    <th>ID Code</th>

                    <th>Quantity</th>

                    <th>Fabric Quantity</th>

                    <th>Leather Quantity</th>

                    <?php

                    if ($check != 'optimal') {

                        for ($i = 1; $i <= $count; $i++) { ?>

                            <th colspan="4" style="text-align: center;"><?php echo 'Supplier ' . $i . $userCompany[$i - 1] ?></th>

                    <?php }
                    } ?>

                    <th colspan="7" style="background-color: yellow;text-align: center;">Optimal Quote</th>

                </tr>

                <?php

                $i = 0;

                $k = 0;

                foreach ($data as $key => $value) {

                    if ($i == 0) {

                ?>

                        <tr>

                            <?php
                            // print_r($value);
                            foreach ($value as $innerkey => $innervalue) {
                                if ($innerkey == 'bwi_id') {
                                    $bwi_id[] = $innervalue;
                                }
                                $string = preg_replace('/[0-9]+/', '', $innerkey);

                                if ($string == 'supplier' && $check != 'optimal') {

                            ?>

                                    <td style="font-size: 10px;">Rate in $</td>

                                    <td style="font-size: 10px;">Exchange Rate</td>

                                    <td style="font-size: 10px;">Rate in AED</td>

                                    <td style="font-size: 10px;">Amount</td>

                                <?php } else if ($string != 'supplier') { ?>

                                    <td></td>

                            <?php }
                            } ?>

                            <td style="font-size: 10px;">Markup</td>

                            <td style="font-size: 10px;">Rate in $</td>

                            <td style="font-size: 10px;">Exchange Rate</td>

                            <td style="font-size: 10px;">Rate in AED</td>

                            <td style="font-size: 10px;">Amount</td>

                            <td style="font-size: 10px;">Supplier Name(s)</td>

                        </tr>

                    <?php }
                    $i++;
                }

                $i = 0;
                $j = 0;
                foreach ($data as $key => $value) {
                    $x = 0; ?>

                    <tr>
                        <?php

                        foreach ($value as $innerkey => $innervalue) {

                            if ($innerkey == 'quantity') {

                                $quantity = $innervalue;
                            }

                            $string = preg_replace('/[0-9]+/', '', $innerkey);

                            if ($string == 'supplier') {

                                $bidArray = explode('_', $innervalue);
                                // echo "<pre>"; print_r($bidArray);
                                $supplierRateValue[] = (int)$bidArray[0];

                                $supplierRateCompany[] = $bidArray[1];

                                if ($check != 'optimal') {

                        ?>

                                    <td><?php echo isset($innervalue) && $innervalue != '' ? $bidArray[0] : 'N/A'; ?></td>

                                    <td><?php echo $conversion_rate; ?></td>

                                    <td><?php echo isset($innervalue) && $innervalue != '' ? ($bidArray[0] * $conversion_rate) : 'N/A'; ?></td>

                                    <td><?php echo isset($innervalue) && $innervalue != '' ? ($bidArray[0] * $conversion_rate * $quantity) : 'N/A'; ?></td>

                                <?php $i++;
                                }
                            } else { ?>

                                <td <?php if ($x == 4) {
                                        echo "class='quantity'";
                                    }
                                    $x++;  ?>><?php echo isset($innervalue) && $innervalue != '' ? $innervalue : 'N/A'; ?></td>

                        <?php }
                        }
                        $arr_filtered = array_values(array_filter($supplierRateValue));
                        if (!empty($arr_filtered)) {
                            $minRate = min($arr_filtered);
                        } else {
                            $minRate = 0;
                        }
                        ?>

                        <td><?php if ($minRate != '0') { ?>
                                <input type="text" class="markup_price_data" data-markup="" name="markup[<?php echo $bw_id[$key]; ?>][<?php echo $bwi_id[$key]; ?>]" value="" onkeyup="markupCal(this.value,<?php echo $minRate; ?>,<?php echo $conversion_rate; ?>,<?php echo $quantity; ?>, <?php echo $bw_id[$key] ?>,this)">
                        </td>
                    <?php  } else {
                                echo 'N/A';
                            } ?>

                    <td class="rateUSD"><?php echo $minRate != '0' ? $minRate : 'N/A'; ?></td>

                    <td class="convertionRate"><?php echo $minRate != '0' ? $conversion_rate : 'N/A'; ?></td>

                    <td class="rateAED"><?php echo $minRate != '0' ? $minRate * $conversion_rate : 'N/A'; ?></td>

                    <td class="totalAmount" id="total_<?php echo $bw_id[$key] ?>"><?php echo $minRate != '0' ? $minRate * $conversion_rate  * $quantity : 'N/A'; ?></td>

                    <td>

                        <?php

                        foreach ($supplierRateValue as $key2 => $value2) {

                            if ($value2 == $minRate) {

                                $company[] = array_search($value2, $supplierRateValue);

                                $company_name[] = $supplierRateCompany[$key2];
                            }
                        }

                        echo implode(' & ', $company_name);

                        ?>

                    </td>

                    </tr>

                <?php unset($supplierRateValue);
                    unset($company_name);
                } ?>

            </table>

        </div>

    </div>
    <div class="col-md-12" style="padding-left: 0px;">

        <?php if ($check == 'optimal') { ?>

            <button type="submit" class="btn btn-info" style="margin-bottom: 10px;">Send Proposal</button>

        <?php } ?>


        <a onclick="exportTableToExcel('bid-analysis');" class="btn btn-primary" style="margin-bottom: 10px;">Export to Excel</a>

         <?php if ($check != 'optimal') { ?>

    <button type="button" onclick="javascript:rebiding(<?php echo $fk_b_id ?>);" class="btn btn-info" style="margin-bottom: 10px;">Re Bid</button>

<?php } ?> 

    </div>

</form>