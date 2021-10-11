<div class="col-lg-10 col-md-10 lead-bottommargin">
  <div class="m-dropdown m-dropdown--inline m-dropdown--arrow  m-dropdown--align-push" m-dropdown-toggle="click" aria-expanded="true" style="display: block">
    <a href="#" class="m-portlet__nav-link btn green m-btn m-btn--custom new-btn2 dropdown-toggle  m-dropdown__toggle" style="color: #FFF">
      <span>New</span> <?php?>
    </a>
    <div class="m-dropdown__wrapper" style="z-index: 101;">
      <span class="m-dropdown__arrow m-dropdown__arrow--right m-dropdown__arrow--adjust"></span>
      <div class="m-dropdown__inner">
        <div class="m-dropdown__body">
          <div class="m-dropdown__content">
            <ul class="m-nav">
              <?php foreach($newButton as $keyChildren => $valueChildren) { ?>
                <li class="m-menu__item"  m-menu-link-redirect="1" aria-haspopup="true">
                  <?php if(isset($valueChildren['allowAdd'])) { ?>                   
                    <span class="m-menu__link-badge">
                      <span class="m-menu__link-icon call-form" data-url="<?php echo isset($valueChildren['modelUrl'])?base_url().$valueChildren['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $valueChildren['isModel']?>">
                          <?php echo $valueChildren['name']?>
                      </span>
                    </span>
                  <?php } ?>  
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>