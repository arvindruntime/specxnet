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

<div class="row">
    <div class="col-md-12">
        <table class="table table-striped- table-bordered table-hover table-checkable" id="bid-analysis">
                <tr>
                    <th colspan="3">Title: <?php echo $title;?></th>
                    <th>Released: <?php echo $created_date;?></th>
                    <th colspan="2">
                        Deadline: <?php echo $approval_deadline;?><br/>
                        Approved: <?php echo '--';?>
                    </th>
                </tr>
                <tr>
                    <th>Supplier List</th>
                    <th>Released</th>
                    <th>Submitted</th>
                    <th>Bid Amount</th>
                    <th></th>
                </tr>
                <?php
                //print_r($bid_list);exit;
                foreach ($bid_list as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['full_name'].' - '.$value['company_name']?></td>
                        <td><?php echo $created_date;?></td>
                        <td><?php echo $value['update_at'];?></td>
                        <td><?php echo $value['totalBid'];?></td>
                        <td>
                            <button class="btn btn-success approveRFQ" data-url="<?php echo base_url().'rf/approveRFQ/'.$b_id;?>" data-toggle="modal" data-target="#modal2" data-id="<?php echo $value['totalBid'];?>">Approve</button>
                            <button class="btn btn-danger" style="margin-left: 10px;">Decline</button>
                        </td>
                    </tr>
                <?php }
                ?>
        </table>
    </div>
</div>
