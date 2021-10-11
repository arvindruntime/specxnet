<select class="form-control greyborder" name="filterList" id="filterListData">
    <option value="Checked Action" selected="">Standard Filter</option>
    <?php
        foreach ($filterData as $filter) {
        ?>
    <option value='<?php echo $filter['filter_id'].",".$filter['filter_values'];?>'  ><?php echo $filter['filter_name'];?>                     

    </option>

    <?php
        }?>
</select>