<?PHP

$use = new class_loader();

$use->use_lib('site/sessions_customer');
$use->use_lib('site/customer/class_customer');
$use->use_lib('system/bootstrap/class_massage');
$use->use_lin('food','arabic');

$session = new sessions_customer();

$valid = false;
if(!empty($session->cart())){

    $valid=true;
}

?>
<div class="container page_check_out">
    <div class="row">
        <div class="col-sm-12">
            <?PHP if($valid){ ?>
            <h3><?=lang('check_out_massage')?></h3>
                <hr>
            <?PHP }else{
                redirect('site/food');
            } ?>
            <form action="<?= site_url('site/check_out_final') ?>" method="post" id="check_out_final">

                <div class="form-group">
                    <label><?= lang('customer_check_out_date_delivery') ?></label>
                    <input type="date" class="form-control"
                           id="<?= tpl_order_customer::order_customer() . tpl_order_customer::date_delivery() ?>"
                           name="<?= tpl_order_customer::order_customer() . tpl_order_customer::date_delivery()  ?>"/>
                </div>
                <div class="form-group">
                    <label><?= lang('customer_check_out_time_delivery') ?></label>
                    <input type="time" class="form-control"
                           id="<?= tpl_order_customer::order_customer() . tpl_order_customer::time_delivery() ?>"
                           name="<?= tpl_order_customer::order_customer() . tpl_order_customer::time_delivery()?>"/>
                </div>

                <div class="form-group">
                    <label><?= lang('customer_check_out_shipping') ?>  : </label>
                    <select name="<?=tpl_order_customer::order_customer().tpl_order_customer::id_shipping()?>"
                            id="<?=tpl_order_customer::order_customer().tpl_order_customer::id_shipping()?>"
                            class="form-control">
                        <?php $new = new class_customer(); echo $new->find_shipping_type()?>
                    </select>
                </div>

                <button type="submit" name="submit" id="submit" class="btn btn-2 btn-sm"><?= lang('customer_check_out_now') ?></button>
            </form>
            <div class="row">
                <div class="col-sm-12">
                    <p id="result_massages_save"></p>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .page_check_out{
        margin-top: 100px;
        margin-bottom: 50px;
        background-color: #fff;
    }

    body {

        background: url(<?=site_url('include/img/customer/a926e3322d13eaa343544bcaf7c7155d.jpg')?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
</style>


<script type="text/javascript">
    $(document).ready(function () {
        $('#check_out_final').bootstrapValidator({
            message: '<?=lang('customer_login_error_g')?>',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_order_customer::order_customer() . tpl_order_customer::date_delivery()?>': {
                    validators: {
                        notEmpty:{
                            message: '<?=lang('customer_check_out_error_date_delivery_empty')?>'
                        }
                    }
                },
                '<?=  tpl_order_customer::order_customer() . tpl_order_customer::time_delivery()?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_check_out_error_time_delivery_empty')?>'
                        }
                    }
                }, '<?=tpl_order_customer::order_customer().tpl_order_customer::id_shipping()?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_check_out_error_id_shipping_empty')?>'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);
                if (data['valid']) {
                    $('#result_massages_save').html(<?=class_massage::info('title','massage')?>);
                    window.setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    $('#result_massages_save').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });
    });
</script>