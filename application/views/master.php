<?PHP
$use = new class_loader();
$use->use_lin('system','arabic');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="<?=lang('system_description')?>" />
    <meta name="author" content="<?=lang('system_author')?>" />
    <title><?=lang('system_name').' - '.$name_page?></title>
    <link href="<?=site_url('include/site/css/bootstrap.min.css')?>" rel="stylesheet" type="text/css">
    <link href="<?=site_url('include/site/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?=site_url('include/site/css/style.css')?>" rel='stylesheet' type='text/css' />
    <link href="<?=site_url('include/site/css/popuo-box.css')?>" rel="stylesheet" type="text/css" media="all"/>
    <link href="<?=site_url('include/site/css/contact-buttons.css')?>" rel="stylesheet">
    <script src="<?=site_url('include/site/js/jquery.min.js')?>"></script>
    <script type="text/javascript" src="<?=site_url('include/site/js/modernizr.custom.min.js')?>"></script>
    <script src="<?=site_url('include/site/js/jquery.magnific-popup.js')?>" type="text/javascript"></script>
    <script>$(document).ready(function() {$('.popup-with-zoom-anim').magnificPopup({type: 'inline', fixedContentPos: false, fixedBgPos: true, overflowY: 'auto', closeBtnInside: true, preloader: false,midClick: true, removalDelay: 300, mainClass: 'my-mfp-zoom-in'});});</script>
    <!--[if lt IE 9]>
    <script src="<?=site_url('include/site/js/html5shiv.js')?>"></script>
    <script src="<?=site_url('include/site/js/respond.min.js')?>"></script>
    <![endif]-->
</head>
<body>
<?=$menu?>
<?=$slider?>
<a id='backTop'>Back To Top</a>
<div id="page-content" class="index-page">
    <?=$services?>
    <?=$menu_items?>
    <?=$home_food?>
    <?=$content?>
</div>
<?=$booking?>
<?=$footer?>
<script src="<?=site_url('include/site/js/bootstrap.min.js')?>"></script>
<script src="<?=site_url('include/site/js/jquery.backTop.min.js')?>"></script>
<script>$(document).ready( function() {$('#backTop').backTop({'position' : 1200, 'speed' : 500, 'color' : 'red'});});</script>
<script src="<?=site_url('include/site/js/jquery.contact-buttons.js')?>"></script>
<script src="<?= site_url('include/form_validation/dist/js/bootstrapValidator.min.js') ?>"></script>
<link href="<?= site_url('include/form_validation/src/css/bootstrapValidator.css') ?>" rel="stylesheet">
</body>
</html>