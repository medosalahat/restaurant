<?PHP
$use = new class_loader();
$use->use_lin('food', 'arabic');
$use->use_lib('site/food/class_food');
$use->use_lib('site/food/class_image_food');
$food = new class_food();
$image_food = new class_image_food();

?>
<section class="box-content box-4 box-style" id="portfolio">
    <div class="container">
        <div class="row heading">
            <div class="col-lg-12">
                <h2><?=lang('food_title_home_page')?></h2>
                <div class="intro"><?=lang('food_description_home_page')?></div>
            </div>
        </div>
        <div class="row">
           <?PHP foreach($food->find_home_page() as $row): ?>
            <div class="col-sm-3">
                <div class="portfolio-img">
                    <?php $image = $image_food->find_Image($row[tpl_food::id()])?>
                    <?PHP if(isset($image[0][tpl_image_food::path_image()]) && !empty($image[0][tpl_image_food::path_image()])){?>


                    <a href="#food_<?=$row[tpl_food::id()]?>" class="play-icon popup-with-zoom-anim">

                        <img src="<?=site_url($image[0][tpl_image_food::path_image()])?>" alt="" /></a>
                    <div id="food_<?=$row[tpl_food::id()]?>" class="mfp-hide">
                        <div class="portfolio-items">
                            <img src="<?=site_url($image[0][tpl_image_food::path_image()])?>" alt="" class="img-responsive img-thumbnail" style="width: 30%"/>
                            <h4><?=$row[tpl_food::name()]?></h4>
                            <hr>
                            <p><?=$row[tpl_food::description()]?></p>
                            <P id="order_food_<?=$row[tpl_food::id()]?>" class="btn btn-2 btn-sm order_now"><?=lang('order_now')?>
                                  <input type="number" id="num_order_food_<?=$row[tpl_food::id()]?>" class=""/></p>
                        </div>
                    </div>
                    <?PHP } ?>
                </div>
            </div>
            <?PHP endforeach; ?>
        </div>
    </div>
</section>
<style>
    .mfp-auto-cursor .mfp-content {
        cursor: auto;
        background-color: #fff;
        direction: rtl;
        padding: 30px;
    }
    .portfolio-items p {
        text-align: center;
    }
</style>