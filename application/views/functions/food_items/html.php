<?PHP
$use = new class_loader();
$use->use_lib(SYSTEM . '/post_get/class_get');
$use->use_lin(SYSTEM, 'arabic');
$use->use_lin('food', 'arabic');
$id = new class_get('id');
if (!$id->validation()) {echo lang('system_error');die();}
$use->use_lib('site/food/class_section_food');
$section = new class_section_food();
if ($section->check_section($id->get_value())) {echo lang('system_error');die();}
$section_info = $section->get_name_section($id->get_value());
$use->use_lib('site/food/class_food');
$use->use_lib('db/tpl_image_food');
$use->use_lib('db/tpl_section_food');
$use->use_lib('db/tpl_food');
$food = new class_food();
?>

    <h4><?=$section_info[tpl_section_food::name()]?></h4>
    <hr>
    <small><?=$section_info[tpl_section_food::description()]?></small>
<hr>

<?php foreach ($food->find($id->get_value()) as $row):
    $image =$row[tpl_image_food::path_image()];
    if($row[tpl_image_food::path_image()] == ''){
        $image='include/img/no.png';
    }
    ?>
        <div class="col-sm-6 col-xs-12 col-md-4">
            <div class="thumbnail">
                <img src="<?= site_url($image) ?>" alt="">
                <p class="price-item"><?=$row[tpl_food::price()]?> <?=lang('system_price')?></p>
                <div class="caption">
                    <h6><a href="<?=site_url('site/food/?id='.$row[tpl_food::id()])?>" class="item-name"><?=$row[tpl_food::name()]?></a></h6>
                    <p><small><?=$row[ tpl_food::description()]?></small></p>
                    <div class="row">
                        <div class="col-md-6 col-xs-12">
                            <input type="number" class="form-control" id="item_<?=$row[tpl_food::id()]?>" value="1"/>
                        </div>
                        <div class="col-md-6 col-xs-12">
                            <a id="order_now"
                               data-id="<?=$row[tpl_food::id()]?>"
                               data-name="<?=$row[tpl_food::name()]?>"
                               data-qty="#item_<?=$row[tpl_food::id()]?>"
                               class="btn btn-danger order_now"
                               role="button"><?=lang('order_now')?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?PHP endforeach; ?>
<style>
    .form-control {
        padding: 3px 12px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function (e) {
        $(".order_now").click(function() {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var qty = $($(this).attr('data-qty')).val();
            $.post('<?= site_url('functions/add_item_cart')?>',{id_items:id,qty:qty},function (result) {

            }).fail(function(){

            })
        });
    });
</script>

