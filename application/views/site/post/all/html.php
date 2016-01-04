<?PHP
$use = new class_loader();

$use->use_lib('site/post/class_posts');
$use->use_lin('post','arabic');
$class = new class_posts();

?>
<div class="container posts">
    <div class="row">
        <div class="col-sm-12"><h1 class="page-header"><?=lang('post')?></h1></div>
    </div>
    <div class="row">
        <?PHP foreach($class->find_active() as $row): ?>
            <div class="col-sm-12">
                <div class="col-sm-3">
                    <img src="<?=site_url($row[tpl_post::image_path()])?>" class="img-responsive img-thumbnail"/>
                </div>
                <div class="col-sm-9">
                    <h2><?=$row[tpl_post::title()]?></h2>
                    <p><?=$row[tpl_post::description()]?></p>
                    <a href="<?=site_url('site/post/?id='.$row[tpl_post::id()])?>" class="btn btn-2 btn-sm"><?=lang('Read_More')?></a>
                </div>

            </div>
            <div class="col-sm-12"><hr></div>
        <?PHP endforeach; ?>

    </div>
</div>
<style type="text/css">
    .posts{
        margin-top: 120px;
        background-color: #fff;
        padding: 20px 20px 20px 20px ;
        margin-bottom: 100px;
    }

    body {

        background: url(<?=site_url('include/img/register/94cb962ce361d221bbba64d2096c39ab.jpg')?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
    }

</style>