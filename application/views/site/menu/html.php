<?PHP $use = new class_loader();
$use->use_lin('system', 'arabic');
$use->use_lin('menu', 'arabic');
$use->use_lib('site/sessions_customer');
$session = new sessions_customer();

?>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?= site_url() ?>">
                <img src="<?= site_url('include/site/images/logo.png') ?>" class="hidden-xs" alt="">

                <h6 class="visible-xs"><?= lang('system_name') ?></h6>
            </a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="<?=(uri_string() == '' or uri_string() == 'site') ? 'active' : ''; ?>">
                    <a class="page-scroll"
                       href="<?= lang('menu_link_home_page') ?>"><?= lang('menu_title_home_page') ?></a>
                </li>

                <li class="<?=( uri_string() == 'site/food') ? 'active' : ''; ?>">
                    <a class="page-scroll"
                       href="<?= lang('menu_link_food_items_page') ?>"><?= lang('menu_title_food_items_page') ?></a>
                </li>
                <li class="<?=( uri_string() == 'site/services') ? 'active' : ''; ?>">
                    <a class="page-scroll"
                       href="<?= lang('menu_link_services_page') ?>"><?= lang('menu_title_services_page') ?></a>
                </li>

                <li class="<?=( uri_string() == 'site/post') ? 'active' : ''; ?>">
                    <a class="page-scroll"
                       href="<?= lang('menu_link_post_page') ?>"><?= lang('menu_title_post_page') ?></a>
                </li>

                <?PHP if($session->get_login()) {?>
                    <!--<li class="<?=(uri_string() == 'site/me') ? 'active' : ''; ?>">
                        <a class="page-scroll"
                           href="<?= lang('menu_link_me_page') ?>">

                            <?= lang('menu_title_me_page') ?></a>
                    </li>-->

                    <li>
                        <a class="page-scroll"
                           href="<?= lang('menu_link_logout_page') ?>">

                            <?= lang('menu_title_logout_page') ?></a>
                    </li>


                <?PHP }?>
                <?PHP if(!$session->get_login()) { ?>
                <li class="<?=( uri_string() == 'site/register') ? 'active' : ''; ?>">
                    <a class="page-scroll"
                       href="<?= lang('menu_link_register_page') ?>">
                        <span class="glyphicon glyphicon-registration-mark"></span>
                        <?= lang('menu_title_register_page') ?></a>
                </li>

                <li class="<?=( uri_string() == 'site/login') ? 'active' : ''; ?>">
                    <a class="page-scroll" href="<?= lang('menu_link_login_page') ?>">
                        <span class="glyphicon glyphicon-log-in"></span>
                        <?= lang('menu_title_login_page') ?>
                    </a>
                </li>
                <?PHP } ?>
                <li class="<?=( uri_string() == 'site/cart') ? 'active' : ''; ?>">
                    <a class="page-scroll" href="<?= lang('menu_link_cart_page') ?>">
                        <span class="glyphicon glyphicon-shopping-cart"></span>
                        <?= lang('menu_title_cart_page') ?>

                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<style>
    @media (min-width: 768px) {
        .navbar-nav > li {
            float: right;
        }
    }

    @media (max-width: 767px) {
        h6 {
            color: #FFF;
        }

        h6, .h6 {
            margin-top: 0px;
        }

        body {
            font-size: 12px;
        }

        .box-content .heading h2 {
            height: 58px;

            font-size: 30px;
        }
        .box-content.box-5 h3 {
            margin-bottom: 20px;
            font-size: 23px;
            text-align: center;
        }

        p {
            text-align: center;
        }
    }
</style>