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
            <h3><?= lang('customer_login_title') ?></h3>
            <hr>
            <p>
                <small><?= lang('customer_login_welcome') . ' ' . lang('system_name') ?>.</small>
            </p>

            <form action="<?= site_url('site/login') ?>" method="post" id="new_register">

                <div class="form-group">
                    <label><?= lang('customer_login_username') ?></label>
                    <input type="text" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::username() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::username() ?>"/>
                </div>
                <div class="form-group">
                    <label><?= lang('customer_login_password') ?></label>
                    <input type="password" class="form-control"
                           id="<?= tpl_customer::customer() . tpl_customer::password() ?>"
                           name="<?= tpl_customer::customer() . tpl_customer::password() ?>"/>
                </div>

                <button type="submit" name="submit" id="submit" class="btn btn-2 btn-sm"><?= lang('customer_login_btn') ?></button>
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

        background: url(<?=site_url('include/img/customer/a926e3322d13eaa343544bcaf7c7155d.jpg')?>) no-repeat center center fixed;
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
            message: '<?=lang('customer_login_error_g')?>',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_customer::customer().tpl_customer::username()?>': {
                    validators: {
                        notEmpty:{
                            message: '<?=lang('customer_login_error_username_empty')?>'
                        }
                    }
                },
                '<?= tpl_customer::customer() . tpl_customer::password() ?>': {
                    validators: {
                        notEmpty:{
                            message:  '<?=lang('customer_login_error_password_empty')?>'
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
