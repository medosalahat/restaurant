<?PHP
$use = new class_loader();
$use->use_lib('site/food/class_cart');
$use->use_lib('db/tpl_image_food');
$use->use_lib('db/tpl_order_items');
$use->use_lin(SYSTEM,'arabic');
$use->use_lin('food','arabic');
$cart = new class_cart();
$data = $cart->show();
$counter=1;
$sum=0;
$sum_prices=0;
?>
<div class="container cart-items">
    <div class="row">
        <div class="col-sm-12 col-xs-12">
            <h4 class="page-header color">
                <span class="glyphicon glyphicon-shopping-cart"></span>
                <?= lang('menu_title_cart_page') ?>
            </h4>
            <?php if (!empty($data)): ?>

                <?php foreach ($data as $row):

                    $image = $row[tpl_image_food::path_image()];
                    if ($row[tpl_image_food::path_image()] == '') {
                        $image = 'include/img/no.png';
                    }
                    $sum = $sum+$row[tpl_order_items::qty()];
                    ?>
                    <div class="row">
                        <div class="col-sm-1">
                            <p class="number-counter"><?=$counter.' - '?></p>
                        </div>
                        <div class="col-sm-2">
                            <img src="<?= site_url($image) ?>" class="img-thumbnail img-responsive"/>
                        </div>
                        <div class="col-sm-3">
                            <p><?= $row[tpl_food::name()] ?></p>
                            <p><?= $row[  tpl_food::price()].' <b>'.lang('system_price').'</b>' ?></p>

                        </div>
                        <div class="col-sm-2">
                            <br>
                            <br>
                            <p><?= $row[  tpl_order_items::qty()].' <b>'.lang('qty').'</b>' ?></p>
                        </div>
                        <div class="col-sm-2">
                            <br>
                            <br>
                            <p><?php $sum_prices = $sum_prices+ ($row[tpl_order_items::qty()]*$row[  tpl_food::price()]);
                               echo  ($row[tpl_order_items::qty()]*$row[  tpl_food::price()]);echo ' <b>'.lang('price_sum_item').'</b>' ?></p>
                        </div>
                        <div class="col-sm-2">
                            <div class="col-md-12 col-xs-12">
                                <br>
                                <input type="number" class="form-control" id="item_<?=$row[tpl_food::id()]?>" value="1"/>
                              <br>
                                <a id="order_now"
                                   data-id="<?=$row[tpl_food::id()]?>"
                                   data-name="<?=$row[tpl_food::name()]?>"
                                   data-qty="#item_<?=$row[tpl_food::id()]?>"
                                   class="btn btn-danger order_now"
                                   role="button"><?=lang('plus_qty')?></a>
                                <br>
                                <br>
                                <a id="remove_item"
                                   class="btn btn-info btn-sm btn-block remove_item"
                                   data-id="<?=$row[tpl_food::id()]?>"><?=lang('food_remove_btn')?></a>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <hr>
                        </div>
                    </div>
                <?php $counter++; endforeach ?>
                <div class="row">
                    <div class="col-sm-3"></div>
                    <div class="col-sm-3"></div>
                    <div class="col-sm-2"><p><?=$sum.' '.lang('qty_sum')?></p></div>
                    <div class="col-sm-2"><p><?=lang('bill_sum_item').'<br>'.$sum_prices.lang('system_price').' '?></p></div>
                    <div class="col-sm-2"><a href="<?=site_url('site/check_out')?>" class="btn btn-2 btn-sm"><?=lang('check_out')?></a></div>
                </div>

            <?php endif ?>
        </div>
        <div class="col-sm-6 col-xs-12">

        </div>
    </div>
</div>
<style type="text/css">
    .number-counter {
        margin-top: 54px;
        font-size: 45px;
    }
    .cart-items{
        margin-top: 100px;
        margin-bottom: 100px;
        background-color: #fff;
    }
    .form-control {
        padding: 3px 12px;
    }

    body {

        background: url(<?=site_url('include/img/background_food/bk1.jpg')?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }
    .color{
        color: #816943;

    }
</style>
<script type="text/javascript">

    (function()
    {
        var bgCounter = 0,
            backgrounds = [
                "<?=site_url('include/img/background_food/bk1.jpg')?>",
                "<?=site_url('include/img/background_food/bk2.jpg')?>",
                "<?=site_url('include/img/background_food/bk3.jpg')?>",
                "<?=site_url('include/img/background_food/bk4.jpg')?>",
                "<?=site_url('include/img/background_food/bk5.jpg')?>",
                "<?=site_url('include/img/background_food/bk6.jpg')?>",
                "<?=site_url('include/img/background_food/bk7.jpg')?>",
                "<?=site_url('include/img/background_food/bk8.jpg')?>",
                "<?=site_url('include/img/background_food/bk9.jpg')?>",
                "<?=site_url('include/img/background_food/bk10.jpg')?>",
                "<?=site_url('include/img/background_food/bk11.jpg')?>",
                "<?=site_url('include/img/background_food/bk12.jpg')?>"

            ];
        function changeBackground()
        {
            bgCounter = (bgCounter+1) % backgrounds.length;
            $('body').css('background', '#000 url('+backgrounds[bgCounter]+') no-repeat');
            setTimeout(changeBackground, 10000);

        }
        changeBackground();
    })();


    $(document).ready(function (e) {
        $(".order_now").click(function() {
            var id = $(this).attr('data-id');
            var name = $(this).attr('data-name');
            var qty = $($(this).attr('data-qty')).val();
            $.post('<?= site_url('functions/add_item_cart')?>',{id_items:id,qty:qty},function (result) {
                location.reload();
            }).fail(function(){

            })
        });

        $(".remove_item").click(function() {
            var id = $(this).attr('data-id');

            $.post('<?= site_url('functions/remove_item_cart')?>',{id_items:id},function (result) {
               location.reload();
            }).fail(function(){

            })
        });
    });
</script>