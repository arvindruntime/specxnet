<style type="text/css">
    .table td {
        padding: 10px;
    }
    .table thead {
        padding: 10px !important;
        font-weight: bold !important;
    }
    .table-bordered th,
    .table-bordered td {
        border: 1px solid #bfc2cc;
    }
</style>
<center>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <?php if (!empty($supplier)) { ?>
            <label for="street_address"><strong>Supplier Company Name</strong></label>
            <select class="form-control" id="supplier_id" name="supplier_id" required>
                <option>----Select Supplier----</option>
                <?php foreach ($supplier as $key => $supplierperson) { ?>
                    <option value="<?php echo $supplierperson['user_id']; ?>" <?php echo (isset($value['supplier_id']) && (in_array($supplierperson['user_id'], explode(',', $value['supplier'])))) ? 'selected' : ''; ?>><?php echo $supplierperson['full_name'] . "(" . $supplierperson['company_name'] . ")"; ?></option>
                <?php } ?>
            </select>
            <input type="hidden" id="rfq_id" value="<?php echo $RFQ_id; ?>">
        <?php } else { ?>
            <div class="bs-example">
                <div class="alert alert-warning alert-dismissible fade show">
                    <center><strong>ALERT!</strong> No Supplier bidded on this RFQ.</center>
                </div>
            </div>
        <?php } ?>
    </div>
</center>
<div id="bidTable"></div>
