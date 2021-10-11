<style type="text/css">
    .table td {
        padding:10px;
    }
    .table th {
        padding:10px !important;
        font-weight: bold !important;
    }
    .table-bordered th, .table-bordered td {
        border: 1px solid #1e1e20;
    }
</style>
<div class="col-md-12" style="padding-left: 0px;">
    <button onclick="exportTableToExcel('bid-analysis');" class="btn btn-primary" style="margin-bottom: 10px;">Export to Excel</button>
</div>
<div class="row">
    <div class="col-md-12">
        <table class="table table-striped- table-bordered table-hover table-checkable" id="bid-analysis">
                <tr>
                    <th>Items</th>
                    <th>Item Type</th>
                    <th>ID Code</th>
                    <th>Quantity</th>
                    <th>Fabric Quantity</th>
                    <th>Leather Quantity</th>
                    <?php for($i = 1; $i <= $count; $i++) { ?>
                        <th><?php echo 'Supplier '.$i?></th>
                    <?php } ?>
                </tr>
                <?php foreach($data as $key => $value) { ?>
                    <tr>
                        <?php foreach($value as $innerkey => $innervalue) { ?>
                            <td><?php echo isset($innervalue)&&$innervalue!=''? $innervalue : 'N/A'; ?></td>
                        <?php } ?>
                    </tr>
                <?php } ?>
        </table>
    </div>
</div>