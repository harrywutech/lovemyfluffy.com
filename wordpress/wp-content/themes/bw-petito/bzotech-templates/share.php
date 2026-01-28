<?php
$check_share = bzotech_get_option('post_single_share',array());
$check_share_page = bzotech_get_value_by_id('post_single_page_share');
$post_type = get_post_type();
if((isset($check_share[$post_type]) && $check_share[$post_type] == '1') || $check_share_page == '1'):
	$face_icon ='<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-facebook-1" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-facebook"><title id="at-svg-facebook-1">Facebook</title><g><path d="M22 5.16c-.406-.054-1.806-.16-3.43-.16-3.4 0-5.733 1.825-5.733 5.17v2.882H9v3.913h3.837V27h4.604V16.965h3.823l.587-3.913h-4.41v-2.5c0-1.123.347-1.903 2.198-1.903H22V5.16z" fill-rule="evenodd"></path></g></svg>';
	$envelope_icon ='<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-twitter-2" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-twitter"><title id="at-svg-twitter-2">Twitter</title><g><path d="M27.996 10.116c-.81.36-1.68.602-2.592.71a4.526 4.526 0 0 0 1.984-2.496 9.037 9.037 0 0 1-2.866 1.095 4.513 4.513 0 0 0-7.69 4.116 12.81 12.81 0 0 1-9.3-4.715 4.49 4.49 0 0 0-.612 2.27 4.51 4.51 0 0 0 2.008 3.755 4.495 4.495 0 0 1-2.044-.564v.057a4.515 4.515 0 0 0 3.62 4.425 4.52 4.52 0 0 1-2.04.077 4.517 4.517 0 0 0 4.217 3.134 9.055 9.055 0 0 1-5.604 1.93A9.18 9.18 0 0 1 6 23.85a12.773 12.773 0 0 0 6.918 2.027c8.3 0 12.84-6.876 12.84-12.84 0-.195-.005-.39-.014-.583a9.172 9.172 0 0 0 2.252-2.336" fill-rule="evenodd"></path></g></svg>';
	$twitter_icon ='<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-pinterest_share-3" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-pinterest_share"><title id="at-svg-pinterest_share-3">Pinterest</title><g><path d="M7 13.252c0 1.81.772 4.45 2.895 5.045.074.014.178.04.252.04.49 0 .772-1.27.772-1.63 0-.428-1.174-1.34-1.174-3.123 0-3.705 3.028-6.33 6.947-6.33 3.37 0 5.863 1.782 5.863 5.058 0 2.446-1.054 7.035-4.468 7.035-1.232 0-2.286-.83-2.286-2.018 0-1.742 1.307-3.43 1.307-5.225 0-1.092-.67-1.977-1.916-1.977-1.692 0-2.732 1.77-2.732 3.165 0 .774.104 1.63.476 2.336-.683 2.736-2.08 6.814-2.08 9.633 0 .87.135 1.728.224 2.6l.134.137.207-.07c2.494-3.178 2.405-3.8 3.533-7.96.61 1.077 2.182 1.658 3.43 1.658 5.254 0 7.614-4.77 7.614-9.067C26 7.987 21.755 5 17.094 5 12.017 5 7 8.15 7 13.252z" fill-rule="evenodd"></path></g></svg>';
	$pinterest_icon ='<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" version="1.1" role="img" aria-labelledby="at-svg-telegram-4" style="fill: rgb(255, 255, 255); width: 16px; height: 16px;" class="at-icon at-icon-telegram"><title id="at-svg-telegram-4">Telegram</title><g><g fill-rule="evenodd"></g><path d="M15.02 20.814l9.31-12.48L9.554 17.24l1.92 6.42c.225.63.114.88.767.88l.344-5.22 2.436 1.494z" opacity=".6"></path><path d="M12.24 24.54c.504 0 .727-.234 1.008-.51l2.687-2.655-3.35-2.054-.344 5.22z" opacity=".3"></path><path d="M12.583 19.322l8.12 6.095c.926.52 1.595.25 1.826-.874l3.304-15.825c.338-1.378-.517-2.003-1.403-1.594L5.024 14.727c-1.325.54-1.317 1.29-.24 1.625l4.98 1.58 11.53-7.39c.543-.336 1.043-.156.633.214"></path></g></svg>';
	$list_default = array(
		array(
			'title'  => esc_html__('Total','bw-petito'),
		    'social' => 'total',
		    'number' => '1',
			),
		array(
			'title'  => esc_html__('Facebook','bw-petito'),
		    'social' => 'facebook',
		    'number' => '1',
			),
		array(
			'title'  => esc_html__('Twitter','bw-petito'),
		    'social' => 'twitter',
		    'number' => '1',
			),
		array(
			'title'  => esc_html__('Pinterest','bw-petito'),
		    'social' => 'pinterest"',
		    'number' => '1',
			),
		array(
			'title'  => esc_html__('Linkedin','bw-petito'),
		    'social' => 'Linkedin',
		    'number' => '1',
			),
		array(
			'title'  => esc_html__('Tumblr','bw-petito'),
		    'social' => 'tumblr',
		    'number' => '1',
			),
		array(
			'title'  => esc_html__('Email','bw-petito'),
		    'social' => 'envelope',
		    'number' => '1',
			),
		);
	$list = bzotech_get_option('post_single_share_list',$list_default);
	$html_list='';
	$html_total='';
?>
<div class="single-list-social <?php if(!empty($el_class)) echo esc_attr($el_class); ?>" data-id="<?php echo esc_attr(get_the_ID())?>">
	<?php 
		foreach ($list as $value) {

			switch ($value['social']) { 
				case 'facebook': 
					$number = get_post_meta(get_the_ID(),'total_share_'.$value['social'],true);
					if(empty($number)) $number = 0;
					if($value['number'] == '1') $number_html = '<span class="number">'.esc_html($number).'</span>';
					else $number_html = '';
					$html_list .='<li><a target="_blank" data-social="'.esc_attr($value['social']).'" title="'.esc_attr($value['title']).'" href="'.esc_url('http://www.facebook.com/sharer.php?u='.get_the_permalink()).'">
								<span class="share-icon '.esc_attr($value['social']).'-social">'.$face_icon.$number_html.'</span>
							</a></li>';
					break;

				case 'twitter':
					$number = get_post_meta(get_the_ID(),'total_share_'.$value['social'],true);
					if(empty($number)) $number = 0;
					if($value['number'] == '1') $number_html = '<span class="number">'.esc_html($number).'</span>';
					else $number_html = '';
					$html_list .='<li><a target="_blank" data-social="'.esc_attr($value['social']).'" title="'.esc_attr($value['title']).'" href="'.esc_url('http://www.twitter.com/share?url='.get_the_permalink()).'">
								<span class="share-icon '.esc_attr($value['social']).'-social">'.$twitter_icon.$number_html.'</span>
							</a></li>';
					break;

				case 'pinterest':
					$number = get_post_meta(get_the_ID(),'total_share_'.$value['social'],true);
					if(empty($number)) $number = 0;
					if($value['number'] == '1') $number_html = '<span class="number">'.esc_html($number).'</span>';
					else $number_html = '';
					$html_list .='<li><a target="_blank" data-social="'.esc_attr($value['social']).'" title="'.esc_attr($value['title']).'" href="'.esc_url('http://pinterest.com/pin/create/button/?url='.get_the_permalink().'&amp;media='.wp_get_attachment_url(get_post_thumbnail_id())).'">
								<span class="share-icon '.esc_attr($value['social']).'-social">'.$pinterest_icon.$number_html.'</span>
							</a></li>';
					break;

				case 'envelope':
					$number = get_post_meta(get_the_ID(),'total_share_'.$value['social'],true);
					if(empty($number)) $number = 0;
					if($value['number'] == '1') $number_html = '<span class="number">'.esc_html($number).'</span>';
					else $number_html = '';
					$html_list .='<li><a target="_blank" data-social="'.esc_attr($value['social']).'" title="'.esc_attr($value['title']).'" href="mailto:?subject='.esc_attr__("I wanted you to see this site&amp;body=Check out this site",'bw-petito').' '.get_the_permalink().'">
								<span class="share-icon '.esc_attr($value['social']).'-social">'.$envelope_icon.$number_html.'</span>
							</a></li>';
					break;

				case 'linkedin':
					$number = get_post_meta(get_the_ID(),'total_share_'.$value['social'],true);
					if(empty($number)) $number = 0;
					if($value['number'] == '1') $number_html = '<span class="number">'.esc_html($number).'</span>';
					else $number_html = '';
					$html_list .='<li><a target="_blank" data-social="'.esc_attr($value['social']).'" title="'.esc_attr($value['title']).'" href="'.esc_url('https://www.linkedin.com/cws/share?url='.get_the_permalink()).'">
								<span class="share-icon '.esc_attr($value['social']).'-social"><i class="lab la-'.esc_attr($value['social']).'-in" aria-hidden="true"></i>'.$number_html.'</span>
							</a></li>';
					break;

				case 'tumblr':
					$number = get_post_meta(get_the_ID(),'total_share_'.$value['social'],true);
					if(empty($number)) $number = 0;
					if($value['number'] == '1') $number_html = '<span class="number">'.esc_html($number).'</span>';
					else $number_html = '';
					$html_list .='<li><a target="_blank" data-social="'.esc_attr($value['social']).'" title="'.esc_attr($value['title']).'" href="'.esc_url('https://www.tumblr.com/widgets/share/tool?canonicalUrl='.get_the_permalink().'&amp;title='.get_the_title()).'">
								<span class="share-icon '.esc_attr($value['social']).'-social"><i class="lab la-'.esc_attr($value['social']).'" aria-hidden="true"></i>'.$number_html.'</span>
							</a></li>';
					break;
				
				case 'total':
					$number = get_post_meta(get_the_ID(),'total_share',true);
					if(empty($number)) $number = 0;
					if($value['number'] == '1') $number_html = '<span class="number">'.esc_html($number).'</span>';
					else $number_html = '';
					$html_total .= '<span class="share-icon total-share "><i class="las la-share-alt" aria-hidden="true"></i><span class="title18 font-light label-title">'.$value['title'].': </span>'.$number_html.'</span>';
					break;
			}			
		}
	?>
	<?php echo apply_filters('bzotech_output_content', $html_total.'<ul class="list-inline-block">'.$html_list.'</ul>'); ?>
</div>
<?php endif;?>