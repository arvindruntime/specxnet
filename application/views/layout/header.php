<style type="text/css">
    .anchor-top {

        display: inline !Important;

        padding: 9px 40px !important;

    }

    .table th,
    .table td {

        vertical-align: middle;

    }
</style>

<?php

$headerArray = HEADER_ARRAY;

$this->load->library(array('Permissions_library' => 'permission'));

?>

<header id="m_header" class="m-grid__item    m-header " m-minimize-offset="200" m-minimize-mobile-offset="200">

    <div class="m-container m-container--fluid m-container--full-height">

        <div class="m-stack m-stack--ver m-stack--desktop">

            <!-- BEGIN: Brand -->

            <div class="m-stack__item m-brand  m-brand--skin-dark ">

                <div class="m-stack m-stack--ver m-stack--general">

                    <div class="m-stack__item m-stack__item--middle m-brand__logo">

                        <a href="#" class="m-brand__logo-wrapper">

                            <img src="<?php echo base_url(); ?>assets/app/media/img/logos/SpecXReef_Logo.png" class="img-responsive">

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

                        <?php foreach ($headerArray as $key => $value) {

                            $permissions = $this->permission->checkUserPermission($value['permission']);

                            if ($permissions) {

                        ?>

                                <li class="m-menu__item  m-menu__item--submenu m-menu__item--rel" m-menu-submenu-toggle="click" m-menu-link-redirect="1" aria-haspopup="true">

                                    <a href="javascript:;" class="m-menu__link m-menu__toggle">

                                        <span class="m-menu__link-text"><?php echo $value['name']; ?></span>

                                        <?php if ($value['children']) { ?>

                                            <i class="m-menu__hor-arrow la la-angle-down"></i>

                                            <i class="m-menu__ver-arrow la la-angle-right"></i>

                                        <?php } ?>

                                    </a>

                                    <?php if ($value['children']) { ?>

                                        <div class="m-menu__submenu m-menu__submenu--classic m-menu__submenu--left">

                                            <span class="m-menu__arrow m-menu__arrow--adjust"></span>

                                            <ul class="m-menu__subnav">

                                                <?php foreach ($value['children'] as $keyChildren => $valueChildren) {

                                                    $childPermissions = $this->permission->checkUserPermission($valueChildren['childPermission']);

                                                    if ($childPermissions) {

                                                ?>

                                                        <li class="m-menu__item" m-menu-link-redirect="1" aria-haspopup="true">



                                                            <a href="<?php echo ($valueChildren['link']) ? base_url() . $valueChildren['link'] : 'javascript:;'; ?>" class="m-menu__link anchor-top" style="padding: 5px 20px!important;">

                                                                <span class="m-menu__link-title">

                                                                    <span class="m-menu__link-wrap">

                                                                        <span class="m-menu__link-text"><?php echo $valueChildren['name'] ?></span>

                                                                    </span>

                                                                </span>

                                                            </a>
                                                            <?php if (isset($valueChildren['allowAdd']) && $valueChildren['allowAdd'] == true) { ?>

                                                                <span class="m-menu__link-badge menu_pad_left">

                                                                    <span class="">

                                                                        <i class="m-menu__link-icon flaticon-add call-form" data-url="<?php echo isset($valueChildren['modelUrl']) ? base_url() . $valueChildren['modelUrl'] : ''; ?>" data-toggle="modal" data-target="<?php echo $valueChildren['isModel'] ?>"></i>

                                                                    </span>

                                                                </span>

                                                            <?php } ?>

                                                        </li>

                                                <?php }
                                                } ?>

                                            </ul>

                                        </div>

                                    <?php } ?>

                                </li>

                        <?php }
                        } ?>

                        <div id="m_header_topbar" class="m-topbar  m-stack m-stack--ver m-stack--general m-stack--fluid">

                            <div class="m-stack__item m-topbar__nav-wrapper">

                                <ul class="m-topbar__nav m-nav m-nav--inline">

                                    <li class="m-nav__item m-topbar__user-profile m-topbar__user-profile--img  m-dropdown m-dropdown--medium m-dropdown--arrow m-dropdown--header-bg-fill m-dropdown--align-right m-dropdown--mobile-full-width m-dropdown--skin-light" m-dropdown-toggle="click">

                                        <a href="#" class="m-nav__link m-dropdown__toggle">

                                            <span class="m-topbar__userpic">

                                                <img src="<?php echo base_url(); ?>assets/app/media/img/users/dummy_image.png" class="m--img-rounded m--marginless" alt="" />

                                            </span>

                                            <span class="m-topbar__username m--hide">Nick</span>

                                        </a>

                                        <div class="m-dropdown__wrapper" style="left: auto !important;">

                                            <span class="m-dropdown__arrow m-dropdown__arrow--left m-dropdown__arrow--adjust" style="left: 270.5px !important;"></span>

                                            <div class="m-dropdown__inner">

                                                <div class="m-dropdown__header m--align-center" style="background: url(<?php echo base_url(); ?>assets/app/media/img/misc/user_profile_bg.jpg); background-size: cover;">

                                                    <div class="m-card-user m-card-user--skin-dark">

                                                        <div class="m-card-user__pic">

                                                            <img src="<?php echo base_url(); ?>assets/app/media/img/users/dummy_image.png" class="m--img-rounded m--marginless" alt="" />

                                                            <!--

                                                        <span class="m-type m-type--lg m--bg-danger"><span class="m--font-light">S<span><span>

                                                        -->

                                                        </div>

                                                        <div class="m-card-user__details">

                                                            <span class="m-card-user__name m--font-weight-300">Welcome</span>

                                                            <span class="m-card-user__name m--font-weight-500"><?php echo $this->session->userdata('user_name'); ?></span>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div class="m-dropdown__body">

                                                    <div class="m-dropdown__content">

                                                        <ul class="m-nav m-nav--skin-light">

                                                            <li class="m-nav__section m--hide">

                                                                <span class="m-nav__section-text">Section</span>

                                                            </li>

                                                            <li class="m-nav__item" style="margin-bottom: 15px;">

                                                                <!-- <a href="indexa80c.html?page=header/profile&amp;demo=default" class="m-nav__link"> -->

                                                                <i class="m-nav__link-icon flaticon-profile-1"></i>

                                                                <span class="m-nav__link-title">

                                                                    <span class="m-nav__link-wrap">

                                                                        <span class="m-nav__link-text"><a href="#" class="my-profile" data-url="<?php echo base_url() ?>company/myprofile/<?php echo $this->session->userdata('user_id'); ?>" data-toggle="modal" data-target="#modal">My Profile</a></span>

                                                                    </span>

                                                                </span>

                                                                <!-- </a> -->

                                                            </li>

                                                            <!-- <li class="m-nav__item">

                                                        <a href="indexa80c.html?page=header/profile&amp;demo=default" class="m-nav__link">

                                                        <i class="m-nav__link-icon flaticon-share"></i>

                                                        <span class="m-nav__link-text">Activity</span>

                                                        </a>

                                                    </li>

                                                    <li class="m-nav__item">

                                                        <a href="indexa80c.html?page=header/profile&amp;demo=default" class="m-nav__link">

                                                        <i class="m-nav__link-icon flaticon-chat-1"></i>

                                                        <span class="m-nav__link-text">Messages</span>

                                                        </a>

                                                    </li>

                                                    <li class="m-nav__separator m-nav__separator--fit">

                                                    </li>

                                                    <li class="m-nav__item">

                                                        <a href="indexa80c.html?page=header/profile&amp;demo=default" class="m-nav__link">

                                                        <i class="m-nav__link-icon flaticon-info"></i>

                                                        <span class="m-nav__link-text">FAQ</span>

                                                        </a>

                                                    </li>

                                                    <li class="m-nav__item">

                                                        <a href="indexa80c.html?page=header/profile&amp;demo=default" class="m-nav__link">

                                                        <i class="m-nav__link-icon flaticon-lifebuoy"></i>

                                                        <span class="m-nav__link-text">Support</span>

                                                        </a>

                                                    </li>

                                                    <li class="m-nav__separator m-nav__separator--fit">

                                                    </li> -->

                                                            <li class="m-nav__item">

                                                                <a type="button" href="<?php echo base_url() . 'login/logout' ?>" class="btn m-btn--pill btn-secondary m-btn m-btn--custom m-btn--label-brand m-btn--bolder" id="logout">Logout</a>

                                                            </li>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </div>

                                        </div>

                                    </li>

                                    <!-- <li class="m-nav__item m-topbar__notifications m-topbar__notifications--img m-dropdown m-dropdown--large m-dropdown--header-bg-fill m-dropdown--arrow m-dropdown--align-right  m-dropdown--mobile-full-width" m-dropdown-toggle="click" m-dropdown-persistent="1">

                                <a href="#" class="m-nav__link m-dropdown__toggle" id="m_topbar_notification_icon">

                                <span class="m-nav__link-badge m-badge m-badge--dot m-badge--dot-small m-badge--danger"></span>

                                <span class="m-nav__link-icon"><i class="flaticon-alarm"></i></span>

                                </a> -->

                                    <!--<div class="m-dropdown__wrapper">

                                    <span class="m-dropdown__arrow m-dropdown__arrow--center"></span>

                                    <div class="m-dropdown__inner">

                                     <div class="m-dropdown__header m--align-center" style="background: url(assets/app/media/img/misc/notification_bg.jpg); background-size: cover;">

                                         <span class="m-dropdown__header-title">9 New</span>

                                         <span class="m-dropdown__header-subtitle">User Notifications</span>

                                     </div>

                                     <div class="m-dropdown__body">              

                                         <div class="m-dropdown__content">

                                             <ul class="nav nav-tabs m-tabs m-tabs-line m-tabs-line--brand" role="tablist">

                                                 <li class="nav-item m-tabs__item">

                                                     <a class="nav-link m-tabs__link active" data-toggle="tab" href="#topbar_notifications_notifications" role="tab">

                                                     Alerts

                                                     </a>

                                                 </li>

                                                 <li class="nav-item m-tabs__item">

                                                     <a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_events" role="tab">Events</a>

                                                 </li>

                                                 <li class="nav-item m-tabs__item">

                                                     <a class="nav-link m-tabs__link" data-toggle="tab" href="#topbar_notifications_logs" role="tab">Logs</a>

                                                 </li>

                                             </ul>

                                             <div class="tab-content">

                                                 <div class="tab-pane active" id="topbar_notifications_notifications" role="tabpanel">

                                                     <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">

                                                         <div class="m-list-timeline m-list-timeline--skin-light">

                                                             <div class="m-list-timeline__items">

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge -m-list-timeline__badge--state-success"></span>

                                                                     <span class="m-list-timeline__text">12 new users registered</span>

                                                                     <span class="m-list-timeline__time">Just now</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge"></span>

                                                                     <span class="m-list-timeline__text">System shutdown <span class="m-badge m-badge--success m-badge--wide">pending</span></span>

                                                                     <span class="m-list-timeline__time">14 mins</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge"></span>

                                                                     <span class="m-list-timeline__text">New invoice received</span>

                                                                     <span class="m-list-timeline__time">20 mins</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge"></span>

                                                                     <span class="m-list-timeline__text">DB overloaded 80% <span class="m-badge m-badge--info m-badge--wide">settled</span></span>

                                                                     <span class="m-list-timeline__time">1 hr</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge"></span>

                                                                     <span class="m-list-timeline__text">System error - <a href="#" class="m-link">Check</a></span>

                                                                     <span class="m-list-timeline__time">2 hrs</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item m-list-timeline__item--read">

                                                                     <span class="m-list-timeline__badge"></span>

                                                                     <span href="#" class="m-list-timeline__text">New order received <span class="m-badge m-badge--danger m-badge--wide">urgent</span></span>

                                                                     <span class="m-list-timeline__time">7 hrs</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item m-list-timeline__item--read">

                                                                     <span class="m-list-timeline__badge"></span>

                                                                     <span class="m-list-timeline__text">Production server down</span>

                                                                     <span class="m-list-timeline__time">3 hrs</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge"></span>

                                                                     <span class="m-list-timeline__text">Production server up</span>

                                                                     <span class="m-list-timeline__time">5 hrs</span>

                                                                 </div>

                                                             </div>

                                                         </div>

                                                     </div>

                                                 </div>

                                                 <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">

                                                     <div class="m-scrollable" data-scrollable="true" data-height="250" data-mobile-height="200">

                                                         <div class="m-list-timeline m-list-timeline--skin-light">

                                                             <div class="m-list-timeline__items">

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>

                                                                     <a href="#" class="m-list-timeline__text">New order received</a>

                                                                     <span class="m-list-timeline__time">Just now</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge m-list-timeline__badge--state1-danger"></span>

                                                                     <a href="#" class="m-list-timeline__text">New invoice received</a>

                                                                     <span class="m-list-timeline__time">20 mins</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge m-list-timeline__badge--state1-success"></span>

                                                                     <a href="#" class="m-list-timeline__text">Production server up</a>

                                                                     <span class="m-list-timeline__time">5 hrs</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>

                                                                     <a href="#" class="m-list-timeline__text">New order received</a>

                                                                     <span class="m-list-timeline__time">7 hrs</span>

                                                                 </div>

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>

                                                                     <a href="#" class="m-list-timeline__text">System shutdown</a>

                                                                     <span class="m-list-timeline__time">11 mins</span>

                                                                 </div>                                      

                                                                 <div class="m-list-timeline__item">

                                                                     <span class="m-list-timeline__badge m-list-timeline__badge--state1-info"></span>

                                                                     <a href="#" class="m-list-timeline__text">Production server down</a>

                                                                     <span class="m-list-timeline__time">3 hrs</span>

                                                                 </div>

                                                             </div>

                                                         </div>

                                                     </div>

                                                 </div>

                                                 <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">

                                                     <div class="m-stack m-stack--ver m-stack--general" style="min-height: 180px;">

                                                         <div class="m-stack__item m-stack__item--center m-stack__item--middle">

                                                             <span class="">All caught up!<br>No new logs.</span>

                                                         </div>

                                                     </div>

                                                 </div>

                                             </div>

                                         </div>

                                     </div>

                                    </div>

                                    </div>-->

                                    <!-- </li>

                            <li class="m-dropdown m-dropdown--inline m-dropdown--arrow m-dropdown--align-right m-dropdown--align-push header-icon" m-dropdown-toggle="hover" aria-expanded="true">

                                <a href="#" class="m-portlet__nav-link btn btn-lg btn-secondary  m-btn m-btn--outline-2x m-btn--air m-btn--icon m-btn--icon-only m-btn--pill  m-dropdown__toggle">

                                <i class="la la-plus m--hide"></i>

                                <i class="la la-cog"></i>

                                </a>

                            </li> -->

                                </ul>

                            </div>

                        </div>

                    </ul>

                </div>
<!--                 <a class="m-subheader__title m-subheader__title--separator" href="#"><img src="<?php echo base_url(); ?>assets/app/media/img/logos/SpecXReef_Logo.png" class="img-responsivev d-img-none" style="width: 300px; height: 75px;"></a> -->

            </div>

        </div>

    </div>

</header>