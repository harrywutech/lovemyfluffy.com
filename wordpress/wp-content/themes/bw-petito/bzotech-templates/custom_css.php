<?php
/**
 * Created by Sublime Text 3.
 * User: MBach90
 * Date: 13/08/15
 * Time: 10:20 AM
 */
/*Set style default*/
$main_color = '#00B8D9';
$main_color2 = '#A0A3BD';
$main_color3 = '#FFBE00';

/* Set style for layout 3*/
$text_on_theme_color_3= '#FFFFFF';
/* End set style for layout 3 */

$body_bg = '';
$preload_bg = '#ffbd76';
$container_width = '1470px';
$title_typo = array('font-family'=>'Montserrat');
$body_typo = array('font-family'=>'Source Sans Pro','color'=>'#14142B','font-size'=>'18px','line-height'=>'1.9em');
global $bzotech_demo;
if($bzotech_demo == '3'){
    $title_typo = array('font-family'=>'Oswald');
    $body_typo = array('font-family'=>'Open Sans','color'=>'#777','font-size'=>'14px','line-height'=>'1.6em'); 
}

/*Get style default*/
$get_main_color = bzotech_get_value_by_id('main_color');
$get_main_color2 = bzotech_get_value_by_id('main_color2');
$get_main_color3 = bzotech_get_value_by_id('main_color3');
$get_body_bg = bzotech_get_value_by_id('body_bg');
$get_container_width = bzotech_get_value_by_id('container_width');
$get_preload_bg = bzotech_get_option('preload_bg');



/*var() : var(--bzo-$key-$name_attribute)*/
$body_typography = bzotech_get_css_option_array_type('body_typo',$body_typo);
$title_typography = bzotech_get_css_option_array_type('title_typo',$title_typo);

if(!empty($get_main_color)) $main_color = $get_main_color;
if(!empty($get_main_color2)) $main_color2 = $get_main_color2;
if(!empty($get_main_color3)) $main_color3 = $get_main_color3;
if(!empty($get_body_bg)) $body_bg = $get_body_bg;
if(!empty($get_container_width)) $container_width = $get_container_width;
if(!empty($get_preload_bg)) $preload_bg = $get_preload_bg;
$darken_main_color2 = bzotech_mix_color($main_color2,"#000000",1,0.9);
$darken_main_color1 = bzotech_mix_color($main_color,"#000000",1,0.9);
$darken_main_color80 = bzotech_mix_color($main_color,"#000000",1,0.8);
$darken_main_color3 = bzotech_mix_color($main_color,"#000000",1,0.65);
$light_main_color35 = bzotech_mix_color($main_color,"#ffffff",1,0.35);
$style = '
        :root {
            --bzo-main-color: ' . $main_color . ';
            --bzo-main-color2: ' . $main_color2 . ';
            --bzo-main-color3: ' . $main_color3 . ';
            --bzo-body-background: ' . $body_bg . ';
            --bzo-container-width: ' . $container_width . ';
            --bzo-preload-background: ' . $get_preload_bg . ';
            --bzo-text-on-theme-color-3: ' . $text_on_theme_color_3 . ';
            --bzo-darken-main-color2: ' . $darken_main_color2 . ';
            --bzo-darken-main-color1: ' . $darken_main_color1 . ';
            --bzo-darken-main-color3: ' . $darken_main_color3 . ';
            --bzo-darken-main-color80: ' . $darken_main_color80 . ';
            --bzo-light-main-color35: ' . $light_main_color35. ';
            
            
           '.$body_typography.'
           '.$title_typography.'
           
        }
    ';



if(!empty($style)) echo apply_filters('bzotech_output_root_css',$style);