<ul class="nav nav-tabs m-tabs-line m-tabs-line--success m-tabs-line--2x" role="tablist" style="margin-top: 15px">

    <?php

    if ($showOpportunity) {

    ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'lead') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>lead">

                List View

            </a>

        </li>

    <?php }

    if ($showActivity) {

    ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'activity') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>activity">

                Activity View

            </a>

        </li>

    <?php }

    if ($showActivityCalendar) {

    ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'calendar') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>calendar">

                Activity Calendar

            </a>

        </li>

    <?php }

    if ($showRFQ) {

    ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'rfq') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>rfq">

                RFQ

            </a>

        </li>

    <?php }

    if ($access == 'Yes') {

    ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'analysis') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>analysis">

                Data Analysis

            </a>

        </li>

    <?php

    }

    if ($showProposal) {

    ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'proposal') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>proposal">

                Proposals

            </a>

        </li>

    <?php }

    if ($showReleasePO) {

    ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'purchase_order') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>purchase_order">

                Purchase Order(PO)

            </a>

        </li>

        <?php }
    // if ($access == 'Yes') {

        if ($showReleaseInvoice) {

        ?>

            <li class="nav-item m-tabs__item black-height">

                <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'invoice') {
                                                                echo 'active show';
                                                            } ?>" href="<?php echo base_url(); ?>invoice">

                    Invoice

                </a>

            </li>

        <?php }
    // }
    if ($showJobs) {

        ?>

        <li class="nav-item m-tabs__item black-height">

            <a class="nav-link m-tabs__link black-pad <?php if (isset($module_name) && $module_name == 'jobs') {
                                                            echo 'active show';
                                                        } ?>" href="<?php echo base_url(); ?>jobs">

                Projects

            </a>

        </li>

    <?php } ?>

</ul>