<?PHP
$use = new class_loader();

$use->use_lib('admin/order_customer_lib_ad');

$use->use_lib('admin/order_items_lib_ad');

$use->use_lib('admin/customer_lib_ad');

$use->use_lib('db/tpl_order_customer');

$use->use_lib('db/tpl_order_items');

$customer = new customer_lib_ad();

$order_customer = new order_customer_lib_ad();

$order_items = new order_items_lib_ad();

$order_customer->set(tpl_order_customer::id(),'get');
$data_order_customer = array_shift($order_customer->find());

$order_items->set(tpl_order_customer::id(),'get');
$data_order_items = ($order_items->find());

$customer->set($data_order_customer[tpl_order_customer::id_customer()],'id');
$data_customer = array_shift($customer->find());

if(empty($data_order_customer)){
    redirect('admin/order_customer');
}

?>


<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="page-header"><?=$data_customer[tpl_customer::f_name()].' '.$data_customer[tpl_customer::l_name()]?>
    <span style="float:right;"># Order : <b><?=$data_order_customer[tpl_order_customer::id()]?></b></span>
    </h2>
    <div class="col-sm-6">
        <h2 class="page-header">Information</h2>
        <table class="table table-bordered table-hover table-condensed">
            <tbody>
            <tr class="active"><td><b>First name</b></td><td><?=$data_customer[tpl_customer::f_name()]?></td></tr>
            <tr class="active"><td><b>Last name</b></td><td><?=$data_customer[tpl_customer::l_name()]?></td></tr>
            <tr class="active"><td><b>Image</b></td>
                <td>
                    <img src="<?=site_url($data_customer[tpl_customer::path_image()])?>" class="img-responsive img-thumbnail"/>
                </td>
            </tr>
            <tr class="active"><td><b>Email</b></td><td><?=$data_customer[tpl_customer::email()]?></td></tr>
            <tr class="active"><td><b>Username</b></td><td><?=$data_customer[tpl_customer::username()]?></td></tr>
            <tr class="active"><td><b>Phone</b></td><td><?=$data_customer[tpl_customer::phone()]?></td></tr>
            <tr class="active"><td><b>Mobile</b></td><td><?=$data_customer[tpl_customer::mobile()]?></td></tr>
            <tr class="active"><td><b>Address</b></td><td><?=$data_customer[tpl_customer::address()]?></td></tr>
            <tr class="active"><td><b>Full address</b></td><td><?=$data_customer[tpl_customer::full_address()]?></td></tr>

            <tr class="active"><td><b>Date in</b></td><td><?=$data_customer[tpl_customer::date_in()]?></td></tr>
            <tr class="active"><td><b>Ip</b></td><td><?=$data_customer[tpl_customer::ip()]?></td></tr>
            <tr class="active"><td><b>Status</b></td><td><?=$data_customer[tpl_customer::status()]?></td></tr>
            </tbody>
        </table>
    </div>
    <div class="col-sm-6">
        <div class="row">
            <h2 class="page-header">information order : </h2>
            <table class="table table-bordered table-hover table-condensed">
                <tbody>
                <tr class="active">
                    <td>
                        <b>Date delivery</b>
                    </td>
                    <td>
                        <?=$data_order_customer[tpl_order_customer::date_delivery()]?>
                    </td>
                </tr>
                <tr class="active">
                    <td>
                        <b>Time delivery</b>
                    </td>
                    <td>
                        <?=$data_order_customer[tpl_order_customer::time_delivery()]?>
                    </td>
                </tr>
                <tr class="active">
                    <td>
                        <b>Status order</b>
                    </td>
                    <td>
                        <?=$data_order_customer[tpl_status_order::status_order() . '_' . tpl_status_order::name()]?>
                    </td>
                </tr>
                <tr class="active">
                    <td>
                        <b>Shipping</b>
                    </td>
                    <td>
                        <?=$data_order_customer[tpl_shipping_type::shipping_type() . '_' . tpl_shipping_type::name()]?>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>
        <div class="row">
            <table class="table table-bordered table-hover table-condensed">
                <thead>
                <tr>
                    <td>
                        <b>Food</b>
                    </td>
                    <td>
                        <b>price</b>
                    </td>
                       <td>
                        <b>Qty</b>
                    </td>

                    <td>
                        <b>Sum</b>
                    </td>
                </tr>
                </thead>
                <tbody>
                <?PHP foreach($data_order_items as $data_order_itemss){ ?>
                <tr class="active">

                    <td>
                        <?=$data_order_itemss[tpl_food::food().'_'.tpl_food::name()]?>
                    </td>


                    <td>
                        <?=$data_order_itemss[ tpl_food::food().'_'.tpl_food::price()]?>
                    </td>


                    <td>
                        <?=$data_order_itemss[tpl_order_items::qty()]?>
                    </td>

                    <td>
                        <?=$data_order_itemss[ tpl_food::food().'_'.tpl_food::price()]*$data_order_itemss[tpl_order_items::qty()]?>
                    </td>
                </tr>
                <?PHP } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>