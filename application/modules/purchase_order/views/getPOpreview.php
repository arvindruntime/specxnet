<button type="button" class="btn btn-success active" onclick="printDiv()" style="height: 30px;padding: .45rem 1.15rem;float: right;">Print</button>
<div class="form-group m-form__group" id="printdiv" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
    <h1 style="text-align:center;"><strong>Purchase Order </strong></h1>
    <hr width="100%" size="8" align="center">


    <table class="table table-borderless">

        <tr>

            <td width="50%" align="left">

            </td>

            <td width="50%" align="right">

                <div><strong>PO No.: </strong><?php echo $PO['po_no']; ?></div>
                <div><strong>Date: </strong><?php echo date("d-M-Y", strtotime($PO['created_date'])); ?></div>
            </td>
        </tr>
        <tr>

            <td width="50%" align="left">

                <strong>FROM: </strong>
            </td>

            <td width="50%" align="left">

                <strong>To: </strong>
            </td>
        </tr>
        <tr>
            <td width="50%" align="left">

                <img src="<?php echo base_url() . 'upload/company_logo/' . $PO['cc_logo']; ?>" style="height:80px">
                <!-- <img src="<?php echo base_url() . $PO['cc_logo'];  ?>"> -->
            </td>
            <td style="width:80px" align="left">

                <img src="<?php echo base_url() . 'upload/company_logo/' . $PO['vc_logo']; ?>" style="height:80px">
                <!-- <img src="<?php echo base_url() . $PO['vc_logo']; ?>"> -->
            </td>
        </tr>
        <tr>
            <td width="50%" align="left">

                <h3><strong>Company Name: </strong><?php echo $PO['cc_name'] ?></h3>
            </td>
            <td width="50%" align="left">

                <h3><strong>Vendor Name: </strong><?php echo $PO['vc_name']; ?></h3>
            </td>
        </tr>
        <tr>
            <td width="50%" align="left">

                <strong>Contact Person: </strong><?php echo $PO['cc_contact_person'] ?>

            </td>
            <td width="50%" align="left">

                <strong>Contact Person: </strong><?php echo $PO['vc_contact_person'] ?>

            </td>
        </tr>
        <tr>
            <td width="50%" align="left">

                <strong>Business Contact: </strong><?php echo $PO['cc_business_contact'];  ?>

            </td>
            <td width="50%" align="left">

                <strong>Business Contact: </strong><?php echo $PO['cc_business_contact']; ?>

            </td>
        </tr>
        <tr>

            <td width="50%" align="left">

                    <strong>Email-ID: </strong><?php echo $PO['cc_email'];  ?>
            </td>
            <td width="50%" align="left">

                    <strong>Email-ID: </strong><?php echo $PO['vc_email'];  ?>
            </td>

        </tr>
        <tr>

            <td width="50%" align="left">

                <strong>Address: </strong><?php echo $PO['cc_address'];  ?>
            </td>
            <td width="50%" align="left">

                <strong>Address: </strong><?php echo $PO['vc_address'];  ?>
            </td>


        </tr>

        <tr>

            <td colspan="4">

                <div><span style="color: rgb(39, 39, 39); font-family: Lato, sans-serif; font-size: 15px; font-weight: bold;">

                        <?php echo isset($getFormat[0]['format_header']) ? $getFormat[0]['format_header'] : ''; ?>

                    </span><br></div>

            </td>

        </tr>
    </table>

    <table class="table table-bordered">

        <thead>

            <tr style="height: 32px;color: black;background-color: #d1cdcd;font-size: 15px">

                <th>Sr No</th>

                <th>Room Type</th>

                <th>Item Name</th>

                <th>Item Code</th>

                <th>Item Type</th>

                <th>Quantity</th>

                <th>Rate in USD</th>

                <th>Exchange Rate</th>
                <th>Rate in AED</th>
                <th>Total Amount</th>

            </tr>

        </thead>

        <tbody>

            <?php

            if (isset($getItemList)) {

                $i = 1;
                $total = 0;
                foreach ($getItemList as $item) {

                    if ($item['item_name'] != '') {

            ?>

                        <tr>

                            <td><?php echo $i ?></td>

                            <td><?php echo $item['room_type'] ?></td>

                            <td><?php echo $item['item_name'] ?></td>

                            <td><?php echo $item['id_code'] ?></td>

                            <td><?php echo $item['item_type'] ?></td>

                            <td><?php echo $item['quantity'] ?></td>
                            <td><?php if (!empty($item['rate_USD'])) {
                                    echo $item['rate_USD'];
                                } else {
                                    echo "N/A";
                                } ?></td>
                            <td><?php if (!empty($item['exchange_rate'])) {
                                    echo $item['exchange_rate'];
                                } else {
                                    echo "N/A";
                                } ?></td>
                            <td><?php if (!empty($item['rate_AED'])) {
                                    echo $item['rate_AED'];
                                } else {
                                    echo "N/A";
                                } ?></td>
                            <td><?php if (!empty($item['total_amount'])) {
                                    echo $item['total_amount'];
                                } else {
                                    echo "N/A";
                                } ?></td>
                        </tr>

                <?php
                        $total += $item['total_amount'];
                        $i++;
                    }
                } ?>
                <tr>
                    <td colspan="9" align="right"><strong>Total Amount</strong></td>
                    <td><?php echo $total; ?></td>
                <?php } else { ?>

                <tr>

                    <td colspan="3">No Data Available</td>

                </tr>

            <?php }

            ?>
        </tbody>

    </table>



    <div><span style="color: rgb(39, 39, 39); font-family: Lato, sans-serif; font-size: 15px; font-weight: bold;">

            <?php echo isset($getFormat[0]['format_footer']) ? $getFormat[0]['format_footer'] : ''; ?>

        </span><br></div>


</div>