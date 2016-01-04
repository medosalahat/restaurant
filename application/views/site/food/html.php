<?PHP
$use = new class_loader();
$use->use_lib('db/tpl_food');
$use->use_lib('db/tpl_country');
$use->use_lib('db/tpl_section_food');
$use->use_lib('site/food/class_country');
$use->use_lib('site/food/class_section_food');
$use->use_lib('system/bootstrap/class_massage');
$use->use_lin('customer', 'arabic');
$use->use_lin('food', 'arabic');
$use->use_lin('system', 'arabic');
$country = new class_country();
$section_food = new class_section_food();
?>
<div class="container login_customer">
    <div class="row">
        <div class="col-sm-3 columns-left">

            <h4><?=lang('food_country_title')?></h4>
            <hr>
            <div id="MainMenu">
                <div class="list-group panel">
                    <?PHP foreach($country->find_active() as $row): ?>
                    <a href="#country_<?=$row[tpl_country::id()]?>"
                       data-url="<?=site_url('site/food/?country=true&name='.$row[tpl_country::name()].'&id='.$row[tpl_country::id()])?>"
                       class="list-group-item list-group-item-link strong item_country"
                       data-toggle="collapse"
                       data-parent="#MainMenu">
                        <?=$row[tpl_country::name()]?>
                        <i class="fa fa-caret-down"></i>
                    </a>
                    <div class="collapse" id="country_<?=$row[tpl_country::id()]?>">
                        <?PHP $sections = $section_food->find_active($row[tpl_country::id()]); foreach( $sections as $section):?>
                            <p data-id="<?=$section[tpl_section_food::id()]?>" class="list-group-item item_section_food">
                                <?=$section[tpl_section_food::short_name()]?>
                            </p>
                        <?PHP endforeach;?>

                    </div>
                    <?PHP endforeach; ?>
                </div>
            </div>
        </div>
        <div class="col-sm-9" id="loading_page" style="border-right: 1px solid #DDD;"></div>
    </div>
</div>
<style type="text/css">
    .login_customer {
        margin-top: 63px;
        background-color: #fff;
        margin-bottom: 100px;
        padding-top: 40px;
        padding-bottom: 30px;
    }
    .item_section_food{
        cursor: pointer;
    }

    .list-group.panel > .list-group-item {
        border-bottom-right-radius: 4px;
        border-bottom-left-radius: 4px
    }

    .list-group-submenu {
        margin-left: 20px;
    }
    .strong {
        font-weight: bold;
    }


    body {

        background: url(<?=site_url('include/img/background_food/bk1.jpg')?>) no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
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

        $("#loading_page").load('<?=site_url('functions/items_food/?id='.$sections[0][tpl_section_food::id()])?>',
            function( response, status, xhr ) {
                if ( status == "error" ) {
                    var msg = "Sorry but there was an error: ";
                    $( "#loading_page" ).html( msg + xhr.status + " " + xhr.statusText );
                }
            });

    $(".item_section_food").click(function() {
        $("#loading_page").load('<?=site_url('functions/items_food/?id=')?>'+$(this).attr('data-id'),
            function( response, status, xhr ) {
                if ( status == "error" ) {
                    var msg = "Sorry but there was an error: ";
                    $( "#loading_page" ).html( msg + xhr.status + " " + xhr.statusText );
                }
            });
    });
    });
</script>