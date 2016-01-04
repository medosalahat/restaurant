<?PHP
$use = new class_loader();

$use->use_lib('admin/section_food_lib_ad');
$use->use_lib('db/tpl_section_food');
$section_food = new section_food_lib_ad();
$section_food->set(tpl_section_food::id(),'get');
$data = $section_food->search_name_by_id();

if(empty($data)){
    redirect('admin/section_food');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
    <h2 class="page-header"><?=$data[tpl_section_food::name()]?></h2>

    <p><b>Short Name : </b><?=$data[tpl_section_food::short_name()]?></p>
    <p><b>Description : </b><?=$data[tpl_section_food::description()]?></p>
    <p><b>Country : </b><?=$data[tpl_country::country().'_'.tpl_country::name()]?></p>
    <p><b>Last Edit by : </b><?=$data[tpl_user_site::user_site().'_'.tpl_user_site::name()]?></p>
    <p><b>Last Edit : </b><?=$data[tpl_section_food::date_in()]?></p>
</div>