<?PHP
$this->use = new class_loader();

$this->use->use_lib('admin/order_customer_lib_ad');
$this->use->use_lib('admin/customer_lib_ad');
$this->use->use_lib('admin/food_lib_ad');
$this->use->use_lib('admin/country_lib_ad');
$this->use->use_lib('admin/category_lib_ad');
$order_customer = new order_customer_lib_ad();
$customer = new customer_lib_ad();
$food = new food_lib_ad();
$country = new country_lib_ad();
$category = new category_lib_ad();
?>

<script type="text/javascript">
    function tpl_order_customer(value, row) {

        return '<a href=" <?=site_url('admin/order_customer/show/?id=')?>' + row.<?=tpl_order_customer::id() ?> + '">' + value + '</a>';
    }
    function tpl_customer(value, row) {

        return '<a href=" <?=site_url('admin/customer/show/?id=')?>' + row.<?=tpl_customer::id() ?> + '">' + value + '</a>';
    }

    function tpl_food(value, row) {

        return '<a href=" <?=site_url('admin/food/show/?id=')?>' + row.<?=tpl_food::id() ?> + '">' + value + '</a>';
    }

    function tpl_category(value, row) {

        return '<a href=" <?=site_url('admin/category/show/?id=')?>' + row.<?=tpl_category::id() ?> + '">' + value + '</a>';
    }


    function tpl_country(value, row) {

        return '<a href=" <?=site_url('admin/country/show/?id=')?>' + row.<?=tpl_country::id() ?> + '">' + value + '</a>';
    }


</script>
<div class="col-md-10 col-md-offset-2 main">
    <h2 class="page-header">Welcome to restaurant system</h2>

    <div class="row">
        <div class="col-sm-2">
            <a href="<?= site_url('admin/order_customer/') ?>">
                New order : <b class=""><?= $order_customer->count(); ?></b>
            </a>
        </div>
        <div class="col-sm-2">
            <a href="<?= site_url('admin/order_customer') ?>">
                Today order : <b class=""><?= $order_customer->today(); ?></b>
            </a>
        </div>
        <div class="col-sm-2">
            <a href="<?= site_url('admin/customer') ?>">
                # Customer : <b class=""><?= $customer->count() ?></b>
            </a>
        </div>
        <div class="col-sm-2"><a href="<?= site_url('admin/food') ?>">
                # Food : <b class=""><?= $food->count() ?></b>
            </a>
        </div>
        <div class="col-sm-2"><a href="<?= site_url('admin/country') ?>">
                # Country : <b class=""><?= $country->count() ?></b>
            </a>
        </div>
        <div class="col-sm-2"><a href="<?= site_url('admin/category') ?>">
                # Category : <b class=""><?= $category->count() ?></b>
            </a>
        </div>
    </div>
    <div class="row color-page" style="margin-top: 12px">
        <div class="col-sm-8">
            <div class="table-responsive">
                <h4 class="page-header color"> New Order</h4>
                <table id="table" data-toggle="table"
                       data-url="<?= site_url('admin/' . tpl_order_customer::order_customer() . '/new_order_ajax') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_order_customer::id() ?>"
                            data-halign="center"
                            data-sortable="true"
                            data-formatter="tpl_order_customer"> ID
                        </th>
                        <th data-field="<?= tpl_customer::customer() . '_' . tpl_customer::f_name() ?>"
                            data-halign="center" data-sortable="true" data-formatter="tpl_order_customer">Customer
                        </th>
                        <th data-field="<?= tpl_status_order::status_order() . '_' . tpl_status_order::name() ?>"
                            data-halign="center" data-sortable="true" data-formatter="tpl_order_customer"> Status Oder
                        </th>
                        <th data-field="<?= tpl_order_customer::date_delivery() ?>" data-halign="center"
                            data-sortable="true" data-formatter="tpl_order_customer"> Date Delivery
                        </th>

                        <th data-field="<?= tpl_order_customer::time_delivery() ?>" data-halign="center"
                            data-sortable="true" data-formatter="tpl_order_customer"> Time Delivery
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="table-responsive">
                <h4 class="page-header color"> Customers</h4>
                <table id="table" data-toggle="table"
                       data-url="<?= site_url('admin/' . tpl_customer::customer() . '/find_all_ajax') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_customer::id() ?>"
                            data-formatter="tpl_customer" data-halign="center" data-sortable="true"> ID
                        </th>
                        <th data-field="<?= tpl_customer::f_name() ?>"
                            data-halign="center"
                            data-formatter="tpl_customer"
                            data-sortable="true"> Name
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="table-responsive">
                <h4 class="page-header color"> Food</h4>
                <table id="table" data-toggle="table"
                       data-url="<?= site_url('admin/' . tpl_food::food() . '/find_all_ajax') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_food::id() ?>"
                            data-formatter="tpl_food"
                            data-halign="center" data-sortable="true"> ID</th>
                        <th data-field="<?= tpl_food::name() ?>"
                            data-formatter="tpl_food"
                            data-halign="center" data-sortable="true"> Name</th>
                        <th data-field="<?= tpl_food::short_name() ?>"data-formatter="tpl_food" data-halign="center" data-sortable="true"> Short Name</th>
                        <th data-field="<?= tpl_food::description() ?>" data-formatter="tpl_food" data-halign="center" data-sortable="true">  Description</th>
                        <th data-field="<?= tpl_food::price() ?>"data-formatter="tpl_food" data-halign="center" data-sortable="true">  Price</th>
                        <th data-field="<?= tpl_food::food().'_'.tpl_section_food::short_name() ?>" data-formatter="tpl_food" data-halign="center" data-sortable="true">Section Food</th>



                    </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="table-responsive">
                <h4 class="page-header color"> Category</h4>

                <table id="table" data-toggle="table"
                       data-url="<?= site_url('admin/' . tpl_category::category() . '/find_all_ajax') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_category::name() ?>"
                            data-formatter="tpl_category"
                            data-halign="center" data-sortable="true"> Title
                        </th>
                        <th data-field="<?= tpl_category::category() . '_' . tpl_user_site::name() ?>"
                            data-halign="center"
                            data-formatter="tpl_category"
                            data-sortable="true"> Username
                        </th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

        <div class="col-sm-6">
            <div class="table-responsive">
                <h4 class="page-header color"> Country</h4>
                <table id="table" data-toggle="table"
                       data-url="<?= site_url('admin/' . tpl_country::country() . '/find_all_ajax') ?>"
                       data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
                       data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                       data-search="true" data-flat="true" data-toolbar="#toolbar">
                    <thead>
                    <tr>
                        <th data-field="<?= tpl_country::id() ?>" data-formatter="tpl_country" data-halign="center" data-sortable="true"> ID</th>
                        <th data-field="<?= tpl_country::name() ?>" data-formatter="tpl_country" data-halign="center" data-sortable="true"> Name</th>
                        <th data-field="<?= tpl_country::short_name() ?>"  data-formatter="tpl_country" data-halign="center" data-sortable="true"> Short</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
</div>
