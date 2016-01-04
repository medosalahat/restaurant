
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();

    $use->use_lib('db/tpl_order_customer');

    $use->use_lib('db/tpl_shipping_type');

    $use->use_lib('db/tpl_status_order');

    $use->use_lib('db/tpl_user_site');

    $use->use_lib('db/tpl_customer');

    $use->use_lib('admin/customer_lib_ad');

    $use->use_lib('admin/shipping_type_lib_ad');

    $use->use_lib('admin/status_order_lib_ad');

    $use->use_lib('system/bootstrap/class_massage');
    ?>
    <h2 class="sub-header"><?= tpl_order_customer::order_customer() ?>s</h2>

    <div class="col-sm-12">
        <p id="status_massage"></p>
    </div>
    <div id="toolbar">
        <button id="add_new_btn" class="btn btn-success btn-xs">New <?= tpl_order_customer::order_customer() ?></button>
        </br>

    </div>
    <div class="table-responsive">
        <table id="table" data-toggle="table"
               data-url="<?= site_url('admin/' . tpl_order_customer::order_customer() . '/find_all_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true" data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="<?= tpl_order_customer::id() ?>" data-halign="center" data-sortable="true"> ID</th>

                <th data-field="<?= tpl_customer::customer().'_'.tpl_customer::f_name() ?>" data-formatter="operate_link"
                    data-halign="center" data-sortable="true">Customer</th>

                <th data-field="<?= tpl_status_order::status_order().'_'.tpl_status_order::name() ?>" data-formatter="operate_link"
                    data-halign="center" data-sortable="true"> Status Oder</th>

                <th data-field="<?= tpl_order_customer::date_delivery()?>" data-halign="center" data-formatter="operate_link"
                    data-sortable="true"> Date Delivery
                </th>

                <th data-field="<?= tpl_order_customer::time_delivery()?>" data-halign="center" data-formatter="operate_link"
                    data-sortable="true"> Time Delivery
                </th>

                <th data-field="<?=tpl_shipping_type::shipping_type().'_'.tpl_shipping_type::name()?>" data-halign="center"
                    data-sortable="true"> Shipping Type
                </th>

                <th data-field="<?= tpl_order_customer::date_in() ?>" data-halign="center" data-sortable="true"> Last Date
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

    function operate_link(value, row) {

        return '<a href="<?=site_url('admin/'.tpl_order_customer::order_customer().'/show/?id=')?>'+row.<?=tpl_customer::id()?>+'">' +value+ '</a>';
    }

    function operate<?= tpl_customer::customer() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_order_customer::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_order_customer::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_order_customer::order_customer().'/update_status')?>',
                {
                    '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id() ?>': id,
                    '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer()?>': value
                }, function (result) {
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                }).fail(function () {
                    alert("Error");
                });
        });
    }
</script>
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
                $.post('<?= site_url('admin/'.tpl_order_customer::order_customer().'/remove')?>', {'<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id()?>': row.<?=tpl_order_customer::id()?>}, function (result) {
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
            $('#<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id().'_update'?>').val(row.<?=tpl_order_customer::id()?>);
            $('#<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer().'_update'?>').val(row.<?=tpl_order_customer::id_customer()?>);
            $('#<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping().'_update'?>').val(row.<?=tpl_order_customer::id_shipping()?>);
            $('#<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder().'_update'?>').val(row.<?=tpl_order_customer::id_status_oder()?>);
            $('#<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::date_delivery().'_update'?>').val(row.<?=tpl_order_customer::date_delivery()?>);
            $('#<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::time_delivery().'_update'?>').val(row.<?=tpl_order_customer::time_delivery()?>);
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
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::time_delivery()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::date_delivery()?>': {
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
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::date_delivery().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::time_delivery().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
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
                <h4>New <?= tpl_order_customer::order_customer() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_order_customer::order_customer() . '/insert') ?>">

                    <div class="form-group">
                        <label for="Edit_NameCategory">Date <?= tpl_order_customer::order_customer() ?>: </label>
                        <input type="date" class="form-control"
                               id="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::date_delivery() ?>"
                               name="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::date_delivery() ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="Edit_NameCategory">Time <?= tpl_order_customer::order_customer() ?>: </label>
                        <input type="time" class="form-control"
                               id="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::time_delivery() ?>"
                               name="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::time_delivery() ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Category <?=tpl_order_customer::order_customer()?> : </label>
                        <select name="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer()?>"
                                id="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer()?>"
                                class="form-control">
                            <?php $new = new customer_lib_ad(); echo $new->select()?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category <?=tpl_order_customer::order_customer()?> : </label>
                        <select name="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping()?>"
                                id="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping()?>"
                                class="form-control">
                            <?php $new = new shipping_type_lib_ad(); echo $new->select()?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category <?=tpl_order_customer::order_customer()?> : </label>
                        <select name="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder()?>"
                                id="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder()?>"
                                class="form-control">
                            <?php $new = new status_order_lib_ad(); echo $new->select()?>
                        </select>
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
                <h4>Update <?= tpl_order_customer::order_customer() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_order_customer::order_customer() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::id() . '_update' ?>"
                               id="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::id() . '_update' ?>" value=""/>
                    </div>

                    <div class="form-group">
                        <label for="">Date <?= tpl_order_customer::order_customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::date_delivery() . '_update' ?>"
                               name="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::date_delivery() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label for="">Time <?= tpl_order_customer::order_customer() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::time_delivery() . '_update' ?>"
                               name="<?= tpl_order_customer::order_customer() . '_' . tpl_order_customer::time_delivery() . '_update' ?>"/>
                    </div>

                    <div class="form-group">
                        <label>Category <?=tpl_order_customer::order_customer()?> : </label>
                        <select name="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer().'_update'?>"
                                id="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_customer().'_update'?>"
                                class="form-control">
                            <?php $new = new customer_lib_ad(); echo $new->select()?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category <?=tpl_order_customer::order_customer()?> : </label>
                        <select name="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping().'_update'?>"
                                id="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_shipping().'_update'?>"
                                class="form-control">
                            <?php $new = new shipping_type_lib_ad(); echo $new->select()?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Category <?=tpl_order_customer::order_customer()?> : </label>
                        <select name="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder().'_update'?>"
                                id="<?=tpl_order_customer::order_customer().'_'.tpl_order_customer::id_status_oder().'_update'?>"
                                class="form-control">
                            <?php $new = new status_order_lib_ad(); echo $new->select()?>
                        </select>
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