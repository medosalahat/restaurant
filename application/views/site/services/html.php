<?PHP
$use = new class_loader();
$use->use_lib('site/post/class_posts');
$use->use_lin('post','arabic');
$post = new class_posts();
?>
<section class="box-content box-1">
    <div class="container">
        <div class="row">
            <?PHP foreach($post->find_service() as $row): ?>
            <div class="col-sm-4 ">
                <div class="service">
                    <a href="<?=site_url('site/service/?id='.$row[tpl_post::id()])?>">
                        <img src="<?=site_url('include/site/images/icon1.png')?>" title="icon-name">
                    </a>
                    <h3><?=$row[tpl_post::title()]?></h3>
                    <p><?=$row[tpl_post::description()]?></p>
                    <a class="btn btn-2 btn-sm" href="<?=site_url('site/service/?id='.$row[tpl_post::id()])?>"><?=lang('Read_More')?></a>
                </div>
            </div>
            <?PHP endforeach; ?>
        </div>
    </div>
</section>