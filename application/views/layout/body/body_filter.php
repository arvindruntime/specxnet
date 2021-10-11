<div class="m-accordion__item">
  <div class="m-accordion__item-head collapsed" role="tab" id="m_accordion_7_item_1_head" data-toggle="collapse" href="#m_accordion_7_item_1_body" aria-expanded="false">
     <span class="m-accordion__item-icon"><i class="la la-filter"></i></span>
     <span class="m-accordion__item-title">Filter Your Results</span>
     <span class="m-accordion__item-mode"></span>     
  </div>
  <div class="m-accordion__item-body collapse <?php echo isset($filter)?'in show':''; ?>" id="m_accordion_7_item_1_body" role="tabpanel" aria-labelledby="m_accordion_7_item_1_head" data-parent="#m_accordion_7" style="">
     <div class="m-accordion__item-content">
        <div class="m-portlet__head" style="padding: 0">
           <div class="m-portlet__head-tools">
              <div class="col-lg-12 col-md-12 col-sm-12" align="right" style="padding-top: 10px">
                 <div style="width:194px;">
                    <select class="form-control greyborder" name="">
                       <option value="Checked Action" selected="">Standard Filter</option>
                       <option value="fluid">Menu 1</option>
                       <option value="boxed">Menu 2</option>
                    </select>
                 </div>
              </div>
           </div>
        </div>
        <form method="GET" action="">
          <div class="form-group m-form__group row" style="padding: 1rem; margin-bottom: 0">
             <div class="col-lg-2 col-md-4 col-sm-4">
                <label class="form-control-label">Name</label>
                <input type="text" name="filter[name]" class="form-control m-input" placeholder="" value="<?php echo $filter['name'];?>">
             </div>
             <div class="col-lg-2 col-md-4 col-sm-4">
                <div class="m-portlet__nav-item">
                   <label class="form-control-label">User Status</label>
                   <div>
                      <select class="form-control greyborder" name="filter[status]">
                         <option value="" selected="">Name</option>
                         <option value="fluid">Menu 1</option>
                         <option value="boxed">Menu 2</option>
                      </select>
                   </div>
                </div>
             </div>
             <div class="col-lg-2 col-md-4 col-sm-4">
                <label class="form-control-label">Role</label>
                <div>
                   <select class="form-control greyborder" name="filter[role]">
                      <option value="" selected="">--All Items Selected--</option>
                      <option value="fluid">Menu 1</option>
                      <option value="boxed">Menu 2</option>
                   </select>
                </div>
             </div>
          </div>
          <div class="row" style="padding:0 2rem">
             <div class="m-form__actions">
                <button type="submit" class="btn btn-primary" style="font-family: sans-serif, Arial; !important">Update Results</button>
                <button type="reset" class="btn  m-btn btn-black m-btn--custom grey">Reset</button>
                <button type="submit" class="btn green m-btn m-btn--custom">Save Filter</button>
             </div>
          </div>
        </form>        
     </div>
  </div>
</div>