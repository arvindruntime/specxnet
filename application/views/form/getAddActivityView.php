<div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow" id="m_accordion_5" role="tablist">   
<input type="hidden" id="fk_lead_opportunity_id" value="<?php echo $lead_opportunity_id; ?>">

<div class="row" style="padding:0 2rem">
    <div class="m-form__actions" style="padding: 0">
      <!-- <button type="reset" class="btn white m-btn m-btn--custom" style="font-family: sans-serif, Arial;">Log Completed Activity</button> -->
      <?php
      if ($addActivity) {
      ?>
          <button type="button" class="btn green m-btn m-btn--custom" id="newActivity" style="font-family: sans-serif, Arial;margin-top: 13px;">Schedule New Activity</button>
          <input type="hidden" id="statMsg" value="ShowAdd">
          <span id="oppMsg" style="margin-left: 29px;color: red;"></span>
  <?php }?>
    </div>
</div>
<!--end::Item--> 

<!--Begin Datatable-->
<!-- <div class "row" style="width: 100%;">
    <table class="table table-striped- table-bordered table-hover table-checkable" id="activityTable">
                
    </table>
</div> -->
<div class="form-group m-form__group row" id="activityTemplate" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
    <div id="tableList">
        <table class="table table-bordered" id="activityTable">
       </table>
       <script type="text/javascript">
            var lop_id = $("#fk_lead_opportunity_id").val();
            datastring = {lead_opportunity_id : lop_id};
            table.activityPopupTable(datastring);
        </script>
    </div>
</div>
<!--End Datatable-->


</div>