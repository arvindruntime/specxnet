<div class="m-portlet__head" style="padding: 0">

    <div class="m-portlet__head-tools">

        <div class="col-lg-12 col-md-12 col-sm-12" align="right" style="padding-top: 10px">

            <div style="width:194px;" class="width-auto">

              <div id="getFilter">

                <select class="form-control greyborder" name="filterList" id="filterListData">

                    <option value=" " selected="">Standard Filter</option>

                    <?php

                        foreach ($savedFilter as $filter) {

                        ?>

                    <option value='<?php echo $filter['filter_id'].",".$filter['filter_values'];?>' <?php if (isset($savedfilterID) && $savedfilterID == $filter['filter_id']) { echo 'selected'; } ?> ><?php echo $filter['filter_name'];?>                     



                    </option>



                    <?php

                        }?>

                </select>

              </div>

            </div>

        </div>

    </div>

</div>



<div class="modal fade" id="mySaveFilterModal" role="dialog" aria-labelledby="" aria-hidden="true" style="display: none;">

   <div class="modal-dialog modal-sm" role="document">

      <div class="modal-content">

         <div class="modal-header">

            <h5 class="modal-title">Save Filter</h5>

            <button type="button" class="close" onclick="closeSaveFilter()" aria-label="Close">

            <span aria-hidden="true" class="la la-remove"></span>

            </button>

         </div>

        <form>

            <div class="modal-body">

                <!--Div for Success/Alert message-->

                <div id="validation_errors_filter_message"></div>

               <div class="form-group m-form__group row m--margin-top-20">

                  <div class="col-lg-12 col-md-12 col-sm-12">

                     <label for="company_name">Filter Name</label>

                     <input type="text" name="filter_name" id="filter_name" class="form-control m-input" placeholder="Filter Name" required>

                  </div>

               </div>

               

               <div class="form-group m-form__group row m--margin-top-20">

                   <div class="col-lg-12 col-md-12 col-sm-12">

                    <button type="button" class="btn btn-success m-btn" style="font-family: sans-serif, Arial;" id="saveMyFilter">Save</button>

                     <button type="button" class="btn btn-brand m-btn" style="font-family: sans-serif, Arial;" onclick="closeSaveFilter()">Close</button>

                  </div>

               </div>

            </div>

         </form>

      </div>

   </div>

</div>