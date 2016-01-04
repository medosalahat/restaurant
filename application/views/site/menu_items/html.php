<?PHP
$use = new class_loader();
$use->use_lin('food', 'arabic');
$use->use_lib('site/food/class_country');
$use->use_lib('site/food/class_section_food');
$country = new class_country();
$section_food = new class_section_food();
?>
<section class="box-content box-2 box-style" id="menu">
    <div class="container">
        <div class="row heading">
            <div class="col-lg-12">
                <h2><?= lang('menu') ?></h2>

                <div class="intro"><h3><?= lang('info_menu') ?></h3></div>
            </div>
        </div>
        <div class="row <?=tpl_country::country()?>">
            <?PHP foreach ($country->find_active() as $row): ?>
                <div class="col-sm-3 col-xs-12 text-center">
                    <h1><?= $row[tpl_country::name()] ?></h1>
                    <p><?= $row[tpl_country::description()] ?></p>
                    <hr>
                   <?PHP
                   foreach($section_food->find_active($row[tpl_country::id()]) as $section):?>
                       <p><a href="<?=site_url('site/food/?id='.$section[tpl_section_food::id()])?>"><?=$section[tpl_section_food::short_name()]?></a></p>
                   <?php endforeach; ?>
                    <a href="<?=site_url('site/food/?id='.$row[tpl_country::id()])?>" class="btn btn-2 btn-sm"><?=lang('food_btn')?></a>
                </div>
            <?PHP endforeach; ?>
        </div>
    </div>
</section>
<style>
    .row.country {
        text-align: center;
    }
</style>