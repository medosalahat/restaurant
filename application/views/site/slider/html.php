<?PHP
$use = new class_loader();
$use->use_lib('site/slider/class_slider');
$slider = new class_slider();
$data = $slider->find_active();
$active = 1;
$counter = 1;
?>
<header id="intro">
    <div id="carousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            foreach ($data as $slide) {
                if ($active == 1) {
                    $active = 0;
                    ?>

                    <li data-target="#carousel" data-slide-to="<?= $counter ?>" class="active"></li>
                <?php } else { ?>
                    <li data-target="#carousel" data-slide-to="<?= $counter ?>"></li>
                    <?PHP
                }
                $counter++;
            }
            $active = 1;
            ?>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($data as $slide) { ?>
                <?PHP if ($active == 1) {
                    $active = 0; ?>
                    <div class="item active">
                        <img src="<?= site_url($slide[tpl_slider::image_path()]) ?>"
                             alt="<?= $slide[tpl_slider::title()] ?>">

                        <div class="header-text hidden-xs">
                            <div class="col-md-12 text-center">
                                <h2><?= $slide[tpl_slider::title()] ?></h2>
                                <br>

                                <h3><?= $slide[tpl_slider::description()] ?></h3>
                                <br>
                            </div>
                        </div>
                    </div>
                <?php } else { ?>
                    <div class="item">
                        <img src="<?= site_url($slide[tpl_slider::image_path()]) ?>"
                             alt="<?= $slide[tpl_slider::title()] ?>">

                        <div class="header-text hidden-xs">
                            <div class="col-md-12 text-center">
                                <h2><?= $slide[tpl_slider::title()] ?></h2>
                                <br>

                                <h3><?= $slide[tpl_slider::description()] ?></h3>
                                <br>
                            </div>
                        </div>
                    </div>
                <?PHP } ?>
            <?php } ?>
        </div>
        <a class="left carousel-control" href="#carousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
        </a>
        <a class="right carousel-control" href="#carousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
        </a>
    </div>
</header>