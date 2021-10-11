<table class="table table-striped- table-bordered table-hover table-checkable table-responsive" id="bidDetails">
    <thead>
        <?php
        $i = 1;
        foreach ($data as $key => $value) {
            if ($i == 1) {
        ?>
                <tr>
                    <td>Room Type</td>
                    <td>Item Name</td>
                    <td>Id Code</td>
                    <td>Item Type</td>
                    <td>W</td>
                    <td>D</td>
                    <td>H</td>
                    <td>SH</td>
                    <td>QTY</td>
                    <td>FABRIC QTY</td>
                    <td>LEATHER QTY</td>
                    <?php if (isset($value['ex_factory_unit_price'])) { ?>
                        <td>UNIT PRICE<br />(Ex Factory)<br /><b>(In $)</b></td>
                    <?php } ?>
                    <?php if (isset($value['ex_factory_markup'])) { ?>
                        <!-- <td>MARK UP<br/>(%)</td> -->
                    <?php } ?>
                    <?php if (isset($value['fabric_price'])) { ?>
                        <td>Fabric Price<br /><b>(In $)</b></td>
                    <?php } ?>
                    <?php if (isset($value['fabric_markup'])) { ?>
                        <!-- <td>MARK UP<br/>(%)</td> -->
                    <?php } ?>
                    <?php if (isset($value['leather_price'])) { ?>
                        <td>Leather Price<br /><b>(In $)</b></td>
                    <?php } ?>
                    <?php if (isset($value['leather_markup'])) { ?>
                        <!-- <td>MARK UP<br/>(%)</td> -->
                    <?php } ?>
                    <?php if (isset($value['unit_total_price_fabric'])) { ?>
                        <td>TOTAL PRICE WITH FABRICS<br />(In $)</td>
                    <?php } ?>
                    <?php if (isset($value['unit_total_price_leather'])) { ?>
                        <td>TOTAL PRICE WITH LEATHER<br />(In $)</td>
                    <?php } ?>
                    <?php if (isset($value['unit_total_price_ex_factory'])) { ?>
                        <td>TOTAL PRICE EX Factory<br />(In $)</td>
                    <?php } ?>
                    <?php if (isset($value['unit_price_fob'])) { ?>
                        <!-- <td>UNIT PRICE FOB<br/><b>(In $)</b></td> -->
                    <?php } ?>
                    <?php if (isset($value['unit_price_cif'])) { ?>
                        <!-- <td>UNIT PRICE CIF<br/><b>(In $)</b></td> -->
                    <?php } ?>
                    <?php if (isset($value['total_price_ex_factory'])) { ?>
                        <!-- <td>TOTAL PRICE EX Factory<br/><b>(In $)</b></td> -->
                    <?php } ?>
                    <?php if (isset($value['total_order_price_ex_factory'])) { ?>
                        <td>TOTAL ORDER PRICE EX Factory<br /><b>(In $)</b></td>
                    <?php } ?>
                    <?php if (isset($value['total_price_markup'])) { ?>
                        <td>MARK UP<br /><b>(%)</b></td>
                    <?php } ?>
                    <!-- <?php if (isset($value['selling_price'])) { ?>
                        <td>Selling Price<br /><b>(%)</b></td>
                    <?php } ?> -->
                    <?php if (isset($value['total_price_fob'])) { ?>
                        <!-- <td>TOTAL PRICE  FOB<br/><b>(In $)</b></td> -->
                    <?php } ?>
                    <?php if (isset($value['total_price_cif'])) { ?>
                        <!-- <td>TOTAL PRICE CIF<br/><b>(In $)</b></td> -->
                    <?php } ?>
                    <?php if (isset($value['cbm'])) { ?>
                        <td>CBM</td>
                    <?php } ?>
                    <?php if (isset($value['note'])) { ?>
                        <td style="padding: 0 70px;">NOTE</td>
                    <?php } ?>
                </tr>
        <?php }
            $i++;
        } ?>
    </thead>

    <tbody>
        <?php foreach ($data as $key => $value) { ?>
            <tr>
                <td><?php echo $value['room_type'] ?></td>
                <td><?php echo $value['item_name'] ?></td>
                <td><?php echo $value['id_code'] ?></td>
                <td><?php echo $value['item_type'] ?></td>
                <td><?php echo $value['w'] ?></td>
                <td><?php echo $value['d'] ?></td>
                <td><?php echo $value['h'] ?></td>
                <td><?php echo $value['sh'] ?></td>
                <td><?php echo $value['qty'] ?></td>
                <td><?php echo $value['fabric_quantity'] ?></td>
                <td><?php echo $value['leather_quantity'] ?></td>
                <?php if (isset($value['ex_factory_unit_price'])) { ?>
                    <td><?php echo $value['ex_factory_unit_price'] ?></td>
                <?php } ?>
                <?php if (isset($value['ex_factory_markup'])) { ?>
                    <!-- <td><?php echo $value['ex_factory_markup'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['fabric_price'])) { ?>
                    <td><?php echo $value['fabric_price'] ?></td>
                <?php } ?>
                <?php if (isset($value['fabric_markup'])) { ?>
                    <!-- <td><?php echo $value['fabric_markup'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['leather_price'])) { ?>
                    <td><?php echo $value['leather_price'] ?></td>
                <?php } ?>
                <?php if (isset($value['leather_markup'])) { ?>
                    <!-- <td><?php echo $value['leather_markup'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['unit_total_price_fabric'])) { ?>
                    <td><?php echo $value['unit_total_price_fabric'] ?></td>
                <?php } ?>
                <?php if (isset($value['unit_total_price_leather'])) { ?>
                    <td><?php echo $value['unit_total_price_leather'] ?></td>
                <?php } ?>
                <?php if (isset($value['unit_total_price_ex_factory'])) { ?>
                    <td><?php echo $value['unit_total_price_ex_factory'] ?></td>
                <?php } ?>
                <?php if (isset($value['unit_price_fob'])) { ?>
                    <!-- <td><?php echo $value['unit_price_fob'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['unit_price_cif'])) { ?>
                    <!-- <td><?php echo $value['unit_price_cif'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['total_price_ex_factory'])) { ?>
                    <!-- <td><?php echo $value['total_price_ex_factory'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['total_order_price_ex_factory'])) { ?>
                    <td><?php echo $value['total_order_price_ex_factory'] ?></td>
                <?php } ?>
                <?php if (isset($value['total_price_markup'])) { ?>
                    <td><?php echo $value['total_price_markup'] ?></td>
                <?php } ?>
                <!-- <?php if (isset($value['selling_price'])) { ?>
                    <td><?php echo $value['selling_price'] ?></td>
                <?php } ?> -->
                <?php if (isset($value['total_price_fob'])) { ?>
                    <!-- <td><?php echo $value['total_price_fob'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['total_price_cif'])) { ?>
                    <!-- <td><?php echo $value['total_price_cif'] ?></td> -->
                <?php } ?>
                <?php if (isset($value['cbm'])) { ?>
                    <td><?php echo $value['cbm'] ?></td>
                <?php } ?>
                <?php if (isset($value['note'])) { ?>
                    <td><?php echo $value['note'] ?></td>
                <?php } ?>
            </tr>
        <?php } ?>
    </tbody>
    <tfoot>
    </tfoot>
</table>
