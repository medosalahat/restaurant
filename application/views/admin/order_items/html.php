
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();
    $use->use_lib('db/tpl_order_items');
    $use->use_lib('db/tpl_user_site');
    $use->use_lib('db/tpl_food');
    $use->use_lib('db/tpl_customer');
    $use->use_lib('admin/food_lib_ad');
    $use->use_lib('admin/order_customer_lib_ad');
    $use->use_lib('system/bootstrap/class_massage');
    ?>
    <h2 class="sub-header"><?= tpl_order_items::order_items() ?>s</h2>

    <div class="col-sm-12">
        <p id="status_massage"></p>
    </div>
    <div id="toolbar">
        <button id="add_new_btn" class="btn btn-success btn-xs">New <?= tpl_order_items::order_items() ?></button>
        </br>

    </div>
    <div class="table-responsive">
        <table id="table" data-toggle="table"
               data-url="<?= site_url('admin/' . tpl_order_items::order_items() . '/find_all_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true" data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="<?= tpl_order_items::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                <th data-field="<?= tpl_food::food().'_'.tpl_food::name() ?>" data-halign="center" data-sortable="true"> food</th>
                <th data-field="<?=  tpl_customer::customer().'_'.tpl_customer::f_name() ?>" data-halign="center"
                    data-sortable="true"> f_name
                </th>
                <th data-field="<?= tpl_order_items::qty() ?>" data-halign="center" data-sortable="true"

                    > qty
                </th>
                <th data-field="<?= tpl_order_items::date_in() ?>" data-halign="center" data-sortable="true"> Last Date
                    Update
                </th>
                <th
                    data-field="operate"
                    data-formatter="operateFormatter"
                    data-events="operateEvents"
                    data-align="center"
                    >Action
                </th>

            </tr>
            </thead>
        </table>
    </div>

</div>
</div>
</div>

<script type="text/javascript">
    function operateFormatter(value, row, index) {
        return [
            '<a class="remove ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-remove"></i>',
            '</a>',
            '<a class="update ml10" href="javascript:void(0)" title="Remove">',
            '<i class="glyphicon glyphicon-edit"></i>',
            '</a>'

        ].join('');
    }
    window.operateEvents = {
        'click .remove': function (e, value, row, index) {
            if (confirm("Did you actually want to delete the College!")) {
                $.post('<?= site_url('admin/'.tpl_order_items::order_items().'/remove')?>', {'<?=tpl_order_items::order_items().'_'.tpl_order_items::id()?>': row.<?=tpl_order_items::id()?>}, function (result) {
                    var data = JSON.parse(result);
                    if (data['valid']) {
                        $('#status_massage').html(<?=class_massage::info('title','massage')?>);
                        window.setTimeout(function () {
                            $('#status_massage').html('');
                        }, 2000);
                    } else {
                        $('#status_massage').html(<?=class_massage::danger('title','massage')?>);
                    }
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                });
            }
        },
        'click .update': function (e, value, row, index) {
            $('#update').modal('show');
            $('#<?=tpl_order_items::order_items().'_'.tpl_order_items::id().'_update'?>').val(row.<?=tpl_order_items::id()?>);
            $('#<?=tpl_order_items::order_items().'_'.tpl_order_items::id_food().'_update'?>').val(row.<?=tpl_order_items::id_food()?>);
            $('#<?=tpl_order_items::order_items().'_'.tpl_order_items::id_order().'_update'?>').val(row.<?=tpl_order_items::id_order()?>);
            $('#<?=tpl_order_items::order_items().'_'.tpl_order_items::qty().'_update'?>').val(row.<?=tpl_order_items::qty()?>);
        }
    };

    $(document).ready(function () {

        $('#add_new_btn').click(function () {
            $('#add').modal('show');
        });
        $('#add_new').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_order_items::order_items().'_'.tpl_order_items::id_food()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_items::order_items().'_'.tpl_order_items::id_order()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_items::order_items().'_'.tpl_order_items::qty()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
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
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    window.setTimeout(function () {
                        $('#add').modal('hide');
                    }, 2000);
                } else {
                    $('#result_massages_save').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });

        $('#update_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_order_items::order_items().'_'.tpl_order_items::id_food().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },

                '<?=tpl_order_items::order_items().'_'.tpl_order_items::id_order().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },

                '<?=tpl_order_items::order_items().'_'.tpl_order_items::qty().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_items::order_items().'_'.tpl_order_items::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
            var $form = $(e.target);
            var bv = $form.data('bootstrapValidator');
            $.post($form.attr('action'), $form.serialize(), function (result) {
                var data = JSON.parse(result);

                if (data['valid']) {
                    $('#result_massages_update').html(<?=class_massage::info('title','massage')?>);
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    window.setTimeout(function () {
                        $('#update').modal('hide');
                    }, 2000);
                } else {
                    $('#result_massages_update').html(<?=class_massage::danger('title','massage')?>);
                }
            }).fail(function () {
            });
        });
    });
</script>


<div class="modal fade" id="add" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>New <?= tpl_order_items::order_items() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_order_items::order_items() . '/insert') ?>">
                    <div class="form-group">
                        <label><?=tpl_order_items::order_items()?> : </label>
                        <select name="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_food()?>"
                                id="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_food()?>"
                                class="form-control">
                            <?php $new = new food_lib_ad(); echo $new->select()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label><?=tpl_order_items::order_items()?> : </label>
                        <select name="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_order()?>"
                                id="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_order()?>"
                                class="form-control">
                            <?php $new = new order_customer_lib_ad(); echo $new->select()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="Edit_NameCategory">Title <?= tpl_order_items::order_items() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_order_items::order_items() . '_' . tpl_order_items::qty() ?>"
                               name="<?= tpl_order_items::order_items() . '_' . tpl_order_items::qty() ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success">Save</button>
                </form>
                <div class="" id="result_massages_save"></div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="update" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>Update <?= tpl_order_items::order_items() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_order_items::order_items() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_order_items::order_items() . '_' . tpl_order_items::id() . '_update' ?>"
                               id="<?= tpl_order_items::order_items() . '_' . tpl_order_items::id() . '_update' ?>" value=""/>
                    </div>

                    <div class="form-group">
                        <label> food <?=tpl_order_items::order_items()?> : </label>
                        <select name="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_food().'_update'?>"
                                id="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_food().'_update'?>"
                                class="form-control">
                            <?php $new = new food_lib_ad(); echo $new->select()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>order <?=tpl_order_items::order_items()?> : </label>
                        <select name="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_order().'_update'?>"
                                id="<?=tpl_order_items::order_items().'_'.tpl_order_items::id_order().'_update'?>"
                                class="form-control">
                            <?php $new = new order_customer_lib_ad(); echo $new->select()?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="">Qty <?= tpl_order_items::order_items() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_order_items::order_items() . '_' . tpl_order_items::qty() . '_update' ?>"
                               name="<?= tpl_order_items::order_items() . '_' . tpl_order_items::qty() . '_update' ?>"/>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                <div class="" id="result_massages_update"></div>
            </div>
        </div>
    </div>
</div>

<style>
    .glyphicon-ok {

        color: green;
    }

    .glyphicon-remove {
        color: #B94A48;
    }


    i.form-control-feedback.glyphicon.glyphicon-ok, i.form-control-feedback.glyphicon.glyphicon-remove {
        position: relative;
        top: -25px;
        right: 11px;
        float: right;
    }
</style>