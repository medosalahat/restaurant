
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();
    $use->use_lib('db/tpl_post');
    $use->use_lib('db/tpl_user_site');
    $use->use_lib('admin/category_lib_ad');
    $use->use_lib('system/bootstrap/class_massage');
    ?>
    <h2 class="sub-header"><?= tpl_post::post() ?>s</h2>

    <div class="col-sm-12">
        <p id="status_massage"></p>
    </div>
    <div id="toolbar">
        <button id="add_new_btn" class="btn btn-success btn-xs">New <?= tpl_post::post() ?></button>
        </br>

    </div>
    <div class="table-responsive">
        <table id="table" data-toggle="table"
               data-url="<?= site_url('admin/' . tpl_post::post() . '/find_all_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true" data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="<?= tpl_post::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                <th data-field="<?= tpl_post::title() ?>" data-halign="center" data-sortable="true"> Title</th>
                <th data-field="<?= tpl_post::description() ?>" data-halign="center" data-sortable="true"> Description</th>
                <th data-field="<?=              tpl_category::category().'_'.tpl_category::name() ?>" data-halign="center" data-sortable="true"> category</th>
                <th data-field="<?= tpl_user_site::user_site() . '_' . tpl_user_site::name() ?>" data-halign="center"
                    data-sortable="true"> Username
                </th>
                <th data-field="<?= tpl_post::image_path() ?>"
                    data-formatter="operate<?= tpl_post::image_path() ?>"
                    data-events="events<?=tpl_post::image_path() ?>"
                    data-width="10" data-halign="center" data-sortable="true"> Image
                </th>
                <th data-field="<?= tpl_post::status() ?>" data-halign="center" data-sortable="true"
                    data-formatter="operate<?= tpl_post::status() ?>"> Status
                </th>
                <th data-field="<?= tpl_post::service() ?>" data-halign="center" data-sortable="true"
                    data-formatter="operate<?= tpl_post::service() ?>"> service
                </th>
                <th data-field="<?= tpl_post::date_in() ?>" data-halign="center" data-sortable="true"> Last Date
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

<script type="text/javascript">
    function operate<?= tpl_post::image_path() ?>(value, row) {
        return ['<a class="update ml10" href="javascript:void(0)" title="Remove">',
            '<img  src="<?=site_url()?>' + value + '" style="width: 100%" />', '</a>'].join('');
    }
    window.events<?= tpl_post::image_path() ?> = {
        'click .update': function (e, value, row, index) {

            $('#name_students').html(row.<?= tpl_post::title() ?>);
            $('#image_students').attr('src', '<?=site_url()?>' + row.<?=tpl_post::image_path() ?>);
            $('#update_image').modal('show');
            $('#<?=tpl_post::post().'_'.tpl_post::id().'_update_image'?>').val(row.<?=tpl_post::id()?>);
        }
    };

    $(document).ready(function () {
        $("#UploadImage").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?=site_url('admin/post/update_image')?>",
                type: "POST"
                , data: new FormData(this), contentType: false,
                cache: false, processData: false,
                success: function (data) {
                    $w = $('#message_res');
                    $w.html('<div class="alert alert-success alert-dismissable">' +
                        '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' +
                        '<strong>' + data + '</strong></div>');
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                    $('#update_image').modal('hide').delay(2000);

                }
            });


        }));

        $(function () {
            $("#image_update").change(function () {
                $("#message_res").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    $('#image_preview').attr('src', '<?=site_url('include/img/noimage.png')?>');
                    $("#message_res").html(
                        "<p id='error'>Please Select A valid Image File</p>"
                        + "<h4>Note</h4>" +
                        "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                }
                else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
    function imageIsLoaded(e) {
        $("#file").css("color", "green");
        $d2 = $('#image');
        $d = $('#image_preview');
        $d.css("display", "block");
        $d2.css("display", "none");
        $d.attr('src', e.target.result);
        $d.attr('width', '250px');

    }
    ;
</script>
<div class="modal fade" id="update_image" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 id="name_students"></h4>
            </div>
            <div class="modal-body">
                <img src="" id="image" class="img-responsive"
                     style="width: 50%;margin-left: auto;margin-right: auto;"/>
                <img src="" id="image_preview" class="img-responsive"
                     style="width: 50%;margin-left: auto;margin-right: auto; display: none"/>

                <form role="search" class="" id="UploadImage" method="post" enctype="multipart/form-data" action="">
                    <input type="hidden" name="<?=tpl_post::post().'_'.tpl_post::id().'_update_image'?>"
                           id="<?=tpl_post::post().'_'.tpl_post::id().'_update_image'?>"/>

                    <div class="form-group" style=" margin-top: 13px;">
                        <div class="input-group">
                        <span class="btn btn-success-upload-file fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                               <span>Add files </span>
                            <input type="file" name="image_update" id="image_update"
                                   class="fileUpload"/>
                        </span>
                            <span class="input-group-addon">New Image</span>
                        </div>

                    </div>
                    <button type="submit" id="submit_btn_image" class="btn btn-default">Upload New Image</button>
                </form>
                <div id="message_res"></div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    function operate<?= tpl_post::status() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_post::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_post::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_post::post().'/update_status')?>',
                {
                    '<?=tpl_post::post().'_'.tpl_post::id() ?>': id,
                    '<?=tpl_post::post().'_'.tpl_post::status()?>': value
                }, function (result) {
                    var $table = $('#table');
                    $table.bootstrapTable('showLoading');
                    $table.bootstrapTable('refresh');
                }).fail(function () {
                    alert("Error");
                });
        });
    }

    function operate<?= tpl_post::service() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_service(' + row.<?= tpl_post::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_service(' + row.<?=tpl_post::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_service(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_post::post().'/update_service')?>',
                {
                    '<?=tpl_post::post().'_'.tpl_post::id() ?>': id,
                    '<?=tpl_post::post().'_'.tpl_post::service()?>': value
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
                $.post('<?= site_url('admin/'.tpl_post::post().'/remove')?>', {'<?=tpl_post::post().'_'.tpl_post::id()?>': row.<?=tpl_post::id()?>}, function (result) {
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
            $('#<?=tpl_post::post().'_'.tpl_post::id().'_update'?>').val(row.<?=tpl_post::id()?>);
            $('#<?=tpl_post::post().'_'.tpl_post::title().'_update'?>').val(row.<?=tpl_post::title()?>);
            $('#<?=tpl_post::post().'_'.tpl_post::description().'_update'?>').val(row.<?=tpl_post::description()?>);
            $('#<?=tpl_post::post().'_'.tpl_post::id_category().'_update'?>').val(row.<?=tpl_post::id_category()?>);
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
                '<?=tpl_post::post().'_'.tpl_post::title()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                }
                ,
                '<?=tpl_post::post().'_'.tpl_post::description()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_post::post().'_'.tpl_post::id_category()?>': {
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
                '<?=tpl_post::post().'_'.tpl_post::title().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_post::post().'_'.tpl_post::description().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_post::post().'_'.tpl_post::id_category().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_post::post().'_'.tpl_post::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
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
                <h4>New <?= tpl_post::post() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post"
                      action="<?= site_url('admin/' . tpl_post::post() . '/insert') ?>">
                    <div class="form-group">
                        <label for="Edit_NameCategory">Title <?= tpl_post::post() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_post::post() . '_' . tpl_post::title() ?>"
                               name="<?= tpl_post::post() . '_' . tpl_post::title() ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="Edit_NameCategory">Description<?= tpl_post::post() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_post::post() . '_' . tpl_post::description() ?>"
                               name="<?= tpl_post::post() . '_' . tpl_post::description() ?>"/>
                    </div>

                    <div class="form-group">
                        <label>Category <?=tpl_post::post()?> : </label>
                        <select name="<?=tpl_post::post().'_'.tpl_post::id_category()?>"
                                id="<?=tpl_post::post().'_'.tpl_post::id_category()?>"
                                class="form-control">
                            <?php $new = new category_lib_ad(); echo $new->select()?>
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
                <h4>Update <?= tpl_post::post() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_post::post() . '/update') ?>">
                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_post::post() . '_' . tpl_post::id() . '_update' ?>"
                               id="<?= tpl_post::post() . '_' . tpl_post::id() . '_update' ?>" value=""/>
                    </div>
                    <div class="form-group">
                        <label for="">Name <?= tpl_post::post() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_post::post() . '_' . tpl_post::title() . '_update' ?>"
                               name="<?= tpl_post::post() . '_' . tpl_post::title() . '_update' ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="">Description <?= tpl_post::post() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_post::post() . '_' . tpl_post::description() . '_update' ?>"
                               name="<?= tpl_post::post() . '_' . tpl_post::description() . '_update' ?>"/>
                    </div>
                    <div class="form-group">
                        <label>Category <?=tpl_post::post()?> : </label>
                        <select name="<?=tpl_post::post().'_'.tpl_post::id_category().'_update'?>"
                                id="<?=tpl_post::post().'_'.tpl_post::id_category().'_update'?>"
                                class="form-control">
                            <?php $new = new category_lib_ad(); echo $new->select()?>
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