<?php
namespace Elementor;
extract($settings);

$wdata->add_render_attribute( 'wrapper', 'class', 'bzoteche-info-box-'.$settings['style'].' flex-align-'.$align.' item-info-box flex-wrapper align-content-center');

?>

<div <?php echo apply_filters('bzotech_output_content', $wdata->get_render_attribute_string('wrapper'));?>>
	<div>
		<?php
		 if(!empty($title)){
			if ( !empty( $link_info['url']) ){ $wdata->add_link_attributes( 'link',$link_info); }
			echo'<h3 class="item-title-e font-title text-uppercase" '.$wdata->get_render_attribute_string( 'link' ).'>'.$title;
			echo'</h3>';
		} 
		 if(!empty($sub_title)){
			echo'<p class="item-subtitle-e item-subtitle-sv3 font-title">'.$sub_title.'</p>';
		}
		if(!empty($date)){
			echo '<div class="bzotech-countdown flex-wrapper align-content-center" data-date="'.$date.'">';
			 echo '<div class="clock day">
			 <strong class="number">%D</strong><sup class="text">'.$day.'</sup>
			 <span class="dots-count">:</span>
			 </div>';
	         echo '<div class="clock hour">
			 <strong class="number">%H</strong><sup class="text">'.$hour.'</sup>
			 <span class="dots-count">:</span>
			 </div>';
	         echo '<div class="clock min">
			 <strong class="number">%M</strong><sup class="text">'.$min.'</sup>
			 <span class="dots-count">:</span>
			 </div>';
	       	 echo '<div class="clock sec">
			 <strong class="number">%S</strong><sup class="text">'.$sec.'</sup>
			 <span class="dots-count">:</span>
			 </div>';
			echo '</div>';
		}
		?>

	</div>
</div>

