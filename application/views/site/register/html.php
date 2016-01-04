<?PHP
$use = new class_loader();
$use->use_lib('db/tpl_customer');
$use->use_lib('system/bootstrap/class_massage');
$use->use_lin('customer', 'arabic');
$use->use_lin('system', 'arabic');

?>
<div class="container register_customer">
    <div class="row">
        <div class="col-lg-6  col-lg-offset-3 form-register">
            <h1><?= lang('customer_register_title') ?></h1>
            <hr>
            <p>
                <small><?= lang('customer_register_welcome') . ' ' . lang('system_name') ?>.</small>
            </p>

            <form action="<?= site_url('site/register') ?>" method="post" id="new_register">

                <div class="form-group">
                    <label><?= lang('customer_register_username') ?></label>
                    <input type="text" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::username() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::username() ?>"/>
                </div>

                <div class="form-group">
                    <label><?= lang('customer_register_email') ?></label>
                    <input type="email" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::email() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::email() ?>"/>
                </div>

                <div class="form-group">
                    <label><?= lang('customer_register_first_name') ?></label>
                    <input type="text" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::f_name() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::f_name() ?>"/>
                </div>

                <div class="form-group">
                    <label><?= lang('customer_register_last_name') ?></label>
                    <input type="text" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::l_name() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::l_name() ?>"/>
                </div>

                <div class="form-group">
                    <label><?= lang('customer_register_phone') ?></label>
                    <input type="text" class="form-control" id="<?= tpl_customer::customer() . tpl_customer::phone() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::phone() ?>"/>
                </div>

                <div class="form-group">
                    <label><?= lang('customer_register_mobile') ?></label>
                    <input type="text" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::mobile() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::mobile() ?>"/>
                </div>
                <div class="form-group">
                    <label><?= lang('customer_register_address') ?></label>
                    <input type="text" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::address() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::address() ?>"/>
                </div>
                <div class="form-group">
                    <label><?= lang('customer_register_full_address') ?></label>
                    <input type="text" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::full_address() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::full_address() ?>"/>
                </div>
                <div class="form-group">
                    <label><?= lang('customer_register_password') ?></label>
                    <input type="password" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::password() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::password() ?>"/>
                </div>
                <div class="form-group">
                    <label><?= lang('customer_register_password_true') ?></label>
                    <input type="password" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::password() . '_t' ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::password() . '_t' ?>"/>
                </div>
                <button type="submit" name="submit" id="submit" class="btn btn-2 btn-sm"><?= lang('customer_register_btn') ?></button>
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
    .register_customer {
        margin-top: 100px;
        margin-bottom: 50px;
    }

    body {

        background: url(<?=site_url('include/img/register/94cb962ce361d221bbba64d2096c39ab.jpg')?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

    .form-register {
        background-color: #fff;
        padding: 20px;
        border-radius: 13px;
    }

    label {
        color: #DA251D;
        font-size: 12px;
    }
    .has-feedback .form-control-feedback {
        position: absolute;
        top: 30px;
        right: 0;
        display: block;
        width: 34px;
        height: 34px;
        line-height: 34px;
        text-align: center;
    }
</style>
<script type="text/javascript">
    $(document).ready(function () {


        $('#new_register').bootstrapValidator({
            message: '<?=lang('customer_register_error_g')?>',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_customer::customer().tpl_customer::username()?>': {
                    validators: {
                        notEmpty:{
                            message: '<?=lang('customer_register_error_username_empty')?>'
                        },     remote: {
                            type: 'POST',
                            url: '<?= site_url('site/customer_check_username/')?>',
                            message: '<?=lang('customer_register_error_username_remote')?>',
                            delay: 100
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::email() ?>': {
                    validators: {
                        notEmpty:{
                            message: '<?=lang('customer_register_error_email_empty')?>'
                        },     remote: {
                            type: 'POST',
                            url: '<?= site_url('site/customer_check_email/')?>',
                            message: '<?=lang('customer_register_error_email_remote')?>',
                            delay: 200
                        }
                    }
                },

                '<?= tpl_customer::customer() . tpl_customer::f_name() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_f_name_empty')?>'

                        }
                    }
                },

                '<?= tpl_customer::customer() . tpl_customer::l_name() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_l_name_empty')?>'
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::phone() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_phone_empty')?>'
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::mobile() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_mobile_empty')?>'
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::address() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_address_empty')?>'
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::full_address() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_full_address_empty')?>'
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::password() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_password_empty')?>'
                        },  identical: {
                            field: '<?= tpl_customer::customer() . tpl_customer::password() . '_t' ?>',
                            message:  '<?=lang('customer_register_error_password_identical')?>'
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::password() . '_t' ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_register_error_password_empty')?>'
                        },  identical: {
                            field: '<?= tpl_customer::customer() . tpl_customer::password()?>',
                            message:  '<?=lang('customer_register_error_password_identical')?>'
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