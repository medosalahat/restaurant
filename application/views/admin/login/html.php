<?PHP
$use = new class_loader();
$use->use_lib('db/tpl_user_site');
$use->use_lib('system/bootstrap/class_massage');
?>
<link href="<?= site_url('include/css/signin.css') ?>" rel="stylesheet">
<style>

    .box_login{
        background-color: #fff;
        padding: 26px;
        border-radius: 4px;
    }
    body {
        padding-top: 120px;
        padding-bottom: 40px;
        background-color: #eee;
        background-image: url('<?=site_url('include/site/images/4.jpg')?>');
    }
    .title_login{
        text-align: center;
        margin-bottom: 30px;
    }
</style>
<div class="container">
    <div class="col-sm-offset-4 col-sm-4 box_login">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="title_login">Login Admin</h3>
            </div>
        </div>
        <form role="form" action="<?= site_url('admin/home/login_now') ?>" method="post" id="login_admin">
            <div class="row" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Username</label>
                    </div>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="<?=tpl_user_site::user_site().'_'.tpl_user_site::username()?>" name="<?=tpl_user_site::user_site().'_'.tpl_user_site::username()?>"/>
                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="col-sm-3">
                        <label>Password</label>
                    </div>
                    <div class="col-sm-9">

                        <input type="password" class="form-control" id="<?=tpl_user_site::user_site().'_'.tpl_user_site::password()?>" name="<?=tpl_user_site::user_site().'_'.tpl_user_site::password()?>"/>

                    </div>
                </div>
            </div>
            <div class="row" style="margin-bottom: 15px;">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-success btn-block" name="login_now">
                            Login now
                        </button>
                    </div>
                </div>
            </div>

            <div class="row" style="margin-bottom: 15px;">

                <div class="col-sm-12" id="massage">
                </div>

            </div>
        </form>
    </div>
</div> <!-- /container -->


<script type="text/javascript">
    $(document).ready(function () {

        $('#login_admin').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_user_site::user_site().'_'.tpl_user_site::username()?>': {
                    validators: {
                        notEmpty: {
                            message: 'The field is required and can\'t be empty'
                        }
                    }
                },
                '<?=tpl_user_site::user_site().'_'.tpl_user_site::password()?>': {
                    validators: {
                        notEmpty: {
                            message: 'The field is required and can\'t be empty'
                        }
                    }
                }
            }
        })
            .on('success.form.bv', function (e) {
                $('#massage_results').html('');
                e.preventDefault();
                var $form = $(e.target);
                var bv = $form.data('bootstrapValidator');
                $.post($form.attr('action'), $form.serialize(), function (result) {
                    var data = JSON.parse(result);
                    if (data['valid']) {
                        location.reload();
                    }
                    else {
                         $('#massage').html(<?=class_massage::danger('title','massage')?>);
                    }
                }).fail(function () {
                    alert('error');
                });
            });

    });
</script>
<style>
    .glyphicon-ok {
        position: relative;
        top: -25px;
        right: 11px;
        float: right;
    }

    .glyphicon-remove{
        position: relative;
        top: -25px;
        right: 11px;
        float: right;
    }
</style>
