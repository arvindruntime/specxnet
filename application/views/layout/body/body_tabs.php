<style type="text/css">

    .anchor-top

    {

        display: inline!Important;

        padding:9px 40px!important;

    }

    .table th, .table td

    {

        vertical-align: middle;

    }



</style>

<?php 

    $headerArray = HEADER_ARRAY;

?>

<header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200">

	<div class="m-container m-container--fluid m-container--full-height">

		<div class="m-stack m-stack--ver m-stack--desktop">		

			<!-- BEGIN: Brand -->

			<div class="m-stack__item m-brand  m-brand--skin-dark ">

             	<div class="m-stack m-stack--ver m-stack--general">

		            <div class="m-stack__item m-stack__item--middle m-brand__logo">

            			<a href="#" class="m-brand__logo-wrapper">

            			    <img src="<?php echo base_url();?>assets/app/media/img/logos/SpecXReef_Logo.png" class="img-responsive">

            			</a>  

            		</div>

                    <div class="m-stack__item m-stack__item--middle m-brand__tools">

							

				        <!-- BEGIN: Left Aside Minimize Toggle -->		

			            <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">

				           <span></span>

			            </a>

				

				        <!-- BEGIN: Responsive Header Menu Toggler -->

				        <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">

					       <span></span>

				        </a>

				        <!-- END -->

						

            			<!-- BEGIN: Topbar Toggler -->

            			<a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">

            				<i class="flaticon-more"></i>

            			</a>

            			<!-- BEGIN: Topbar Toggler -->

		          </div>

	           </div>

            </div>

            <!-- END: Brand -->

            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">

                <button class="m-aside-header-menu-mobile-close  m-aside-header-menu-mobile-close--skin-dark " id="m_aside_header_menu_mobile_close_btn"><i class="la la-close"></i></button>

                <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark">

                    <ul class="m-menu__nav  m-menu__nav--submenu-arrow ">

                        <?php foreach ($headerArray as $key => $value) { ?>                                

                            <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel"  m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">

                                <a  href="javascript:;" class="m-menu__link m-menu__toggle">

                                    <span class="m-menu__link-text"><?php echo $value['name']; ?></span>

                                    <?php if($value['children']) { ?>

                                        <i class="m-menu__hor-arrow la la-angle-down"></i>

                                        <i class="m-menu__ver-arrow la la-angle-right"></i>

                                    <?php } ?>             

                                </a>

                                <?php if($value['children']) { ?>

                                    <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">

                                        <span class="m-menu__arrow m-menu__arrow--adjust"></span>

                                        <ul class="m-menu__subnav">

                                            <?php foreach($value['children'] as $keyChildren => $valueChildren) { ?>

                                                <li class="m-menu__item"  m-menu-link-redirect="1" aria-haspopup="true">

                                                    <a href="<?php echo ($valueChildren['link'])?base_url().$valueChildren['link']:'javascript:;'; ?>" class="m-menu__link anchor-top">

                                                        <span class="m-menu__link-title"> 

                                                            <span class="m-menu__link-wrap">

                                                                <span class="m-menu__link-text"><?php echo $valueChildren['name']?></span> 

                                                            </span>

                                                        </span>

                                                    </a>

                                                    <?php if(isset($valueChildren['allowAdd'])) { ?>

                                                        <span class="m-menu__link-badge">

                                                            <span class="">

                                                                <i class="m-menu__link-icon flaticon-add call-form" data-url="<?php echo isset($valueChildren['modelUrl'])?base_url().$valueChildren['modelUrl']:''; ?>" data-toggle="modal" data-target="<?php echo $valueChildren['isModel']?>"></i>

                                                            </span>

                                                        </span>

                                                    <?php } ?>  

                                                </li>

                                            <?php } ?>

                                        </ul>

                                    </div>

                                <?php } ?>

                            </li>

                        <?php } ?>

                    </ul>

                </div>

            </div>

        </div>

    </div>

</header>