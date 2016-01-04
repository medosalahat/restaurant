<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <?PHP
    $use = new class_loader();
    $use->use_lib('db/tpl_image_food');
    $use->use_lib('db/tpl_user_site');
    $use->use_lib('admin/food_lib_ad');
    $use->use_lib('db/tpl_food');
    $use->use_lib('system/bootstrap/class_massage');
    ?>
    <h2 class="sub-header"><?= tpl_image_food::image_food() ?>s</h2>

    <div class="col-sm-12">
        <p id="status_massage"></p>
    </div>
    <div id="toolbar">
        <button id="add_new_btn" class="btn btn-success btn-xs">New <?= tpl_image_food::image_food() ?></button>
        </br>

    </div>
    <div class="table-responsive">
        <table id="table" data-toggle="table"
               data-url="<?= site_url('admin/' . tpl_image_food::image_food() . '/find_all_ajax') ?>"
               data-cache="false" data-height="400" data-show-refresh="true" data-show-toggle="true"
               data-show-columns="true" data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
               data-search="true" data-flat="true" data-toolbar="#toolbar">
            <thead>
            <tr>
                <th data-field="<?= tpl_image_food::id() ?>" data-halign="center" data-sortable="true"> ID</th>
                <th data-field="<?= tpl_image_food::title() ?>" data-halign="center" data-sortable="true"> Title</th>
                <th data-field="<?= tpl_image_food::description() ?>" data-halign="center" data-sortable="true">
                    description
                </th>
                <th data-field="<?=   tpl_food::food() . '_' . tpl_food::name() ?>" data-halign="center"
                    data-sortable="true"> food
                </th>
                <th data-field="<?= tpl_image_food::path_image() ?>"
                    data-formatter="operate<?= tpl_user_site::path_image() ?>"
                    data-events="events<?=tpl_user_site::path_image() ?>"   data-width="10"
                    data-halign="center" data-sortable="true"> image
                </th>
                <th data-field="<?= tpl_user_site::user_site() . '_' . tpl_user_site::name() ?>" data-halign="center"
                    data-sortable="true"> Username
                </th>
                <th data-field="<?= tpl_image_food::status() ?>" data-halign="center" data-sortable="true"
                    data-formatter="operate<?= tpl_image_food::status() ?>"
                    > Status
                </th>
                <th data-field="<?= tpl_image_food::date_in() ?>" data-halign="center" data-sortable="true"> Last Date
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

    function operate<?= tpl_image_food::status() ?>(value, row) {
        if (value == 1) {
            return '<input onchange="update_status(' + row.<?= tpl_image_food::id() ?> + ',0)" type="checkbox" checked="true"/>';
        }
        return '<input onchange="update_status(' + row.<?=tpl_image_food::id() ?> + ',1)" type="checkbox"/>';
    }
    function update_status(id, value) {
        $(document).ready(function () {
            $.post('<?= site_url('admin/'.tpl_image_food::image_food().'/update_status')?>',
                {
                    '<?=tpl_image_food::image_food().'_'.tpl_image_food::id() ?>': id,
                    '<?=tpl_image_food::image_food().'_'.tpl_image_food::status()?>': value
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
                $.post('<?= site_url('admin/'.tpl_image_food::image_food().'/remove')?>', {'<?=tpl_image_food::image_food().'_'.tpl_image_food::id()?>': row.<?=tpl_image_food::id()?>}, function (result) {
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
            $('#<?=tpl_image_food::image_food().'_'.tpl_image_food::id().'_update'?>').val(row.<?=tpl_image_food::id()?>);
            $('#<?=tpl_image_food::image_food().'_'.tpl_image_food::title().'_update'?>').val(row.<?=tpl_image_food::title()?>);
            $('#<?=tpl_image_food::image_food().'_'.tpl_image_food::description().'_update'?>').val(row.<?=tpl_image_food::description()?>);
            $('#<?=tpl_image_food::image_food().'_'.tpl_image_food::id_food().'_update'?>').val(row.<?=tpl_image_food::id_food()?>);
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
                '<?=tpl_image_food::image_food().'_'.tpl_image_food::title()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_image_food::image_food().'_'.tpl_image_food::description()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_image_food::image_food().'_'.tpl_image_food::id_food()?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },

                image_new: {
                    validators: {
                        file: {
                            extension: 'jpg',
                            type: 'image/jpeg',
                            message: 'Please choose a MP3 file'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            $("#add_new").on('submit', (function (e) {
                e.preventDefault();
                $.ajax({
                    url: "<?=site_url('admin/image_food/insert')?>",
                    type: "POST"
                    , data: new FormData(this), contentType: false,
                    cache: false, processData: false,
                    success: function (result) {
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
                    }
                });
            }));
        });

        $('#update_form').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                '<?=tpl_image_food::image_food().'_'.tpl_image_food::title().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_image_food::image_food().'_'.tpl_image_food::description().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_image_food::image_food().'_'.tpl_image_food::id_food().'_update'?>': {
                    validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}
                },
                '<?=tpl_image_food::image_food().'_'.tpl_image_food::id().'_update'?>': {validators: {notEmpty: {message: 'The field is required and can\'t be empty'}}}
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
<script type="text/javascript">

    function operate<?= tpl_image_food::path_image() ?>(value, row) {
        return ['<a class="update ml10" href="javascript:void(0)" title="Remove">',
            '<img  src="<?=site_url()?>' + value + '" style="width: 100%" />', '</a>'].join('');
    }
    window.events<?= tpl_user_site::path_image() ?> = {
        'click .update': function (e, value, row, index) {

            $('#name_students').html(row.<?= tpl_image_food::title() ?>);
            $('#image_students').attr('src', '<?=site_url()?>' + row.<?=tpl_image_food::path_image() ?>);
            $('#update_image').modal('show');
            $('#<?=tpl_image_food::image_food().'_'.tpl_image_food::id().'_update_image'?>').val(row.<?=tpl_image_food::id()?>);
        }
    };
    $(document).ready(function () {


        $(function () {
            $("#image_new").change(function () {
                $("#message_res").empty(); // To remove the previous error message
                var file = this.files[0];
                var imagefile = file.type;
                var match = ["image/jpeg", "image/png", "image/jpg"];
                if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2]))) {
                    $('#image_preview_new').attr('src', '<?=site_url('include/img/noimage.png')?>');
                    $("#message_res").html(
                        "<p id='error'>Please Select A valid Image File</p>"
                        + "<h4>Note</h4>" +
                        "<span id='error_message'>Only jpeg, jpg and png Images type allowed</span>");
                    return false;
                }
                else {
                    var reader = new FileReader();
                    reader.onload = imageIsLoaded2;
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    });
    function imageIsLoaded2(e) {
        $("#file").css("color", "green");
        $d2 = $('#image');
        $d = $('#image_preview_new');
        $d.css("display", "block");
        $d2.css("display", "none");
        $d.attr('src', e.target.result);
        $d.attr('width', '250px');

    }
</script>


<div class="modal fade" id="add" style="background-color: rgba(60, 60, 60, 0.81);" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 50%">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4>New <?= tpl_image_food::image_food() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="add_new" method="post" enctype="multipart/form-data"
                      action="">
                    <div class="form-group">
                        <label for="Edit_NameCategory">Title <?= tpl_image_food::image_food() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_image_food::image_food() . '_' . tpl_image_food::title() ?>"
                               name="<?= tpl_image_food::image_food() . '_' . tpl_image_food::title() ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="Edit_NameCategory">Title <?= tpl_image_food::image_food() ?>: </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_image_food::image_food() . '_' . tpl_image_food::description() ?>"
                               name="<?= tpl_image_food::image_food() . '_' . tpl_image_food::description() ?>"/>
                    </div>

                    <div class="form-group">
                        <label> food <?= tpl_image_food::image_food() ?> : </label>
                        <select name="<?= tpl_image_food::image_food() . '_' . tpl_image_food::id_food() ?>"
                                id="<?= tpl_image_food::image_food() . '_' . tpl_image_food::id_food() ?>"
                                class="form-control">
                            <?php $new = new food_lib_ad();
                            echo $new->select() ?>
                        </select>
                    </div>
                    <img src="" class="img-responsive" id="image_preview_new"/>

                    <div class="form-group" style=" margin-top: 13px;">
                        <div class="input-group">
                        <span class="btn btn-success-upload-file fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                               <span>New Image</span>
                            <input type="file" name="image_new" id="image_new"
                                   class="fileUpload"/>
                        </span>
                            <span class="input-group-addon"><i class="glyphicon glyphicon-paperclip"></i></span>
                        </div>

                    </div>
                    <button type="submit" id="submit_btn_image" class="btn btn-success">Save</button>
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
                <h4>Update <?= tpl_image_food::image_food() ?>
                    <small id="TitlePostSmall"></small>
                </h4>
            </div>
            <div class="modal-body">
                <form class="form" id="update_form" method="post"
                      action="<?= site_url('admin/' . tpl_image_food::image_food() . '/update') ?>">

                    <div class="form-group">
                        <input type="hidden"
                               name="<?= tpl_image_food::image_food() . '_' . tpl_image_food::id() . '_update' ?>"
                               id="<?= tpl_image_food::image_food() . '_' . tpl_image_food::id() . '_update' ?>"
                               value=""/>
                    </div>

                    <div class="form-group">
                        <label for="">Name <?= tpl_image_food::image_food() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_image_food::image_food() . '_' . tpl_image_food::title() . '_update' ?>"
                               name="<?= tpl_image_food::image_food() . '_' . tpl_image_food::title() . '_update' ?>"/>
                    </div>
                    <div class="form-group">
                        <label for="">Name <?= tpl_image_food::image_food() ?> : </label>
                        <input type="text" class="form-control"
                               id="<?= tpl_image_food::image_food() . '_' . tpl_image_food::description() . '_update' ?>"
                               name="<?= tpl_image_food::image_food() . '_' . tpl_image_food::description() . '_update' ?>"/>
                    </div>


                    <div class="form-group">
                        <label> food <?= tpl_image_food::image_food() ?> : </label>
                        <select name="<?= tpl_image_food::image_food() . '_' . tpl_image_food::id_food() . '_update' ?>"
                                id="<?= tpl_image_food::image_food() . '_' . tpl_image_food::id_food() . '_update' ?>"
                                class="form-control">
                            <?php $new = new food_lib_ad();
                            echo $new->select() ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success" id="update" name="update">Save</button>
                </form>
                <div class="" id="result_massages_update"></div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript">

    $(document).ready(function () {
        $("#UploadImage").on('submit', (function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?=site_url('admin/image_food/update_image')?>",
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
                    <input type="hidden" name="<?=tpl_image_food::image_food().'_'.tpl_image_food::id().'_update_image'?>"
                           id="<?=tpl_image_food::image_food().'_'.tpl_image_food::id().'_update_image'?>"/>

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