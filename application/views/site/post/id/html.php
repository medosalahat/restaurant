<?PHP
$use = new class_loader();

$use->use_lib('site/post/class_posts');
$use->use_lin('post', 'arabic');
$use->use_lib('system/post_get/class_get');
$class = new class_posts();
$id = new class_get('id');
if(!$id->validation()){
    redirect('site/post');
}
if($class->search_by_id($id->get_value())){
    redirect('site/post');
}
$data =$class->find_by_id($id->get_value());
?>
<div class="container posts">
    <?PHP foreach ($data as $row): ?>
        <h2><?= $row[tpl_post::title()] ?></h2>
        <hr>
        <div class="col-sm-12">
            <div class="col-sm-6">
                <img src="<?= site_url($row[tpl_post::image_path()]) ?>" class="img-responsive img-thumbnail"/>
            </div>
        </div>
        <div class="col-sm-12">
            <br>
            <br>
            <p><?= $row[tpl_post::description()] ?></p>
        </div>
    <?PHP endforeach; ?>

</div>
</div>
<style type="text/css">
    .posts {
        margin-top: 120px;
        background-color: #fff;
        padding: 20px 20px 20px 20px;
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