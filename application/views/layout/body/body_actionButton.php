<div class="m-portlet__head-tools">
   <ul class="nav nav-tabs m-tabs-line m-tabs-line--success m-tabs-line--2x" role="tablist" style="margin-top: 15px">
      <?php
     if (isset($internalPermissions) && $internalPermissions !='') {
     ?>
      <li class="nav-item m-tabs__item black-height">
         <a class="nav-link m-tabs__link black-pad<?php if($userType== 'internal') {?>  active show <?php } ?>" href="<?php echo base_url()?>user/internal">
         <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Internal Users
         </a>
      </li>
      <?php } 
     if (isset($supplierPermissions) && $supplierPermissions !='') {
     ?>
      <li class="nav-item m-tabs__item black-height">
         <a class="nav-link m-tabs__link black-pad<?php if($userType== 'supplier') { ?>  active show <?php } ?>" href="<?php echo base_url()?>user/supplier">
         <i class="fa fa-bar-chart" aria-hidden="true"></i> Suppliers
         </a>
      </li>
      <?php } 
        if (isset($customerPermissions) && $customerPermissions !='') {
        ?>
      <li class="nav-item m-tabs__item black-height">
         <a class="nav-link m-tabs__link black-pad<?php if($userType== 'customer' || $this->uri->segment(3) == 'customer') { ?>  active show <?php } ?>"  href="<?php echo base_url()?>user/customer">
         Customer Contact
         </a>
      </li>
      <?php }?>
   </ul>
</div>