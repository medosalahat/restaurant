<?PHP
$use = new class_loader();
$use->use_lib('site/category/class_category');
$use->use_lib('site/partners/class_partners');
$use->use_lib('site/partners/class_partners');
$use->use_lin('category', 'arabic');
$use->use_lin('about', 'arabic');
$use->use_lin('partners', 'arabic');
$use->use_lin('copyright', 'arabic');
$category = new class_category();
$partners = new class_partners();
$counter = 0;
?>
<footer>
    <div class="wrap-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-footer footer-1">
                    <div class="footer-heading"><h4><?= lang('partners_title') ?></h4></div>
                    <div class="content">
                        <?PHP foreach ($partners->find_active() as $row) { ?>
                            <div class="col-md-6 partners_<?= $row[tpl_partners::id()] ?>">
                                <a href="<?= $row[tpl_partners::url()] ?>" target="_blank"
                                   title="<?= $row[tpl_partners::name()] ?>"> <img
                                        src="<?= site_url($row[tpl_partners::image_path()]) ?>"/></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-4 col-footer footer-2">
                    <div class="footer-heading"><h4><?= lang('about_us_title') ?></h4></div>
                    <div class="content">
                        <p><?= lang('about_us_main_page') ?></p>
                    </div>
                </div>
                <div class="col-md-4 col-footer footer-3">
                    <div class="footer-heading"><h4><?= lang('category') ?></h4></div>
                    <div class="content">
                        <ul>
                            <?PHP foreach ($category->find_active() as $data_category) { ?>
                                <li>
                                    <a href="<?= site_url('site/category/?id=' . $data_category[tpl_category::id()]) ?>"><?= $data_category[tpl_category::name()] ?></a>
                                </li>
                            <?PHP } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</footer>
<div class="coppy-right">
    <div class="wrap-footer">
        <div class="clearfix">
            <div class="col-md-6 col-md-offset-3">
                <?= lang('copyright_title') ?>
            </div>
        </div>
    </div>
</div>