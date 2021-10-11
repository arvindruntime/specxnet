<button type="button" class="btn btn-success active" onclick="printDiv()" style="height: 30px;padding: .45rem 1.15rem;float: right;">Print</button>
<div class="form-group m-form__group" id="printdiv" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px; width: 100%; overflow-x: auto">
    <h1>
        <center> <img align="center" src="<?php echo base_url() . 'upload/company_logo/' . $invoice['vc_logo']; ?>" style="height:100px"></center>
    </h1>
    <h6 style="text-align:center"><?php echo $invoice['vc_address']; ?></h6>
    <h6>
        <center><?php echo "PhNo: " . $invoice['vc_business_contact'];  ?></center>
    </h6>
    <hr width="100%" size="8" align="center">
    <h1 style="text-align:center;"><strong>INVOICE</strong></h1>
    <table class="table table-borderless">

        <tr>

            <td width="50%" align="left">
                Invoiced To:
            </td>


        </tr>
        <tr>
            <td width="50%" align="left">

                <img src="<?php echo base_url() . 'upload/company_logo/' . $invoice['cc_logo']; ?>" style="height:70px">
            </td>
            <td width="50%" align="right">

                <div><strong>Invoice No.: </strong><?php echo $invoice['invoice_no']; ?></div>
                <div><strong>Invoice Date: </strong><?php echo date("d-M-Y", strtotime($invoice['created_date'])); ?></div>
            </td>
        </tr>
        <tr>
            <td width="50%" align="left">

                <h5><strong>Company Name: </strong><?php echo $invoice['cc_name']; ?></h5>
            </td>

        </tr>
        <tr>
            <td width="50%" align="left">

                <strong>Contact Person: </strong><?php echo $invoice['cc_contact_person'] ?>

            </td>

        </tr>
        <tr>
            <td width="50%" align="left">

                <strong>Business Contact: </strong><?php echo $invoice['cc_business_contact']; ?>

            </td>

        </tr>
        <tr>

            <td width="50%" align="left">

                <strong>Email-ID: </strong><?php echo $invoice['cc_email'];  ?>
            </td>

        </tr>
        <tr>

            <td width="50%" align="left">

                <strong>Address: </strong><?php echo $invoice['cc_address'];  ?>
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
                <tr style="background-color:lightgray">
                    <td colspan="9" align="right"><strong>Final Amount</strong></td>
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