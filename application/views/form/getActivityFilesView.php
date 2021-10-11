<div class="m-accordion m-accordion--default m-accordion--solid m-accordion--section  m-accordion--toggle-arrow" id="m_accordion_5" role="tablist">   
<input type="hidden" id="fk_lead_opportunity_id" value="<?php echo $lead_opportunity_id; ?>">

<div class="form-group m-form__group row" id="activityTemplate" style="padding-top: 1rem;margin: 1px;padding-left: 10px;padding-right: 10px;">
    <div id="tableList">
        <table class="table table-bordered" id="activityFilesTable">
       </table>
       <script type="text/javascript">
            var lop_id = $("#fk_lead_opportunity_id").val();
            datastring = {lead_opportunity_id : lop_id};
            table.activityFilesTable(datastring);
        </script>
    </div>
</div>
<!--End Datatable-->


</div>