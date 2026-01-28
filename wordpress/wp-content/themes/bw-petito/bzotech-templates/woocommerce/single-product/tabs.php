<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$tab_style = bzotech_get_value_by_id('product_tab_detail');
if(empty($tab_style))$tab_style='tab-product-horizontal';
$get_style_woo_single = bzotech_get_value_by_id('sv_style_woo_single');

$key_check_style = array();
if($get_style_woo_single == 'sticky-style3'){
	$key_check_style = array('description'); //check remover tab by style product
}
if ( ! empty( $tabs ) ) :
    switch ($tab_style){
        case 'tab-product-accordion': ?>
            <div class="detail-product-tabs <?php echo esc_attr($tab_style)?>">
                <div class="tab-product-accordion-js" data-active="1">
                    <?php
                    $i = 1;
                    foreach ( $tabs as $key => $tab ) :
                    	if(in_array($key,$key_check_style)) continue;
                        if($i == 1) $active = 'active';
                        else $active = '';
                        $i++;
                       
                        ?>
                        <h3 class="<?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>">
                            <a class="font-title title16 color-title text-uppercase" href="#tab-<?php echo esc_attr( $key ); ?>" data-target="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="tab" aria-expanded="false">
                                <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                            </a>
                        </h3>
                        <div id="tab-<?php echo esc_attr( $key ); ?>" class="item-accordion">
                            <div class="detail-tab-desc">
                                <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php
            break;
        case 'tab-product-vertical': ?>
            <div class="detail-product-tabs <?php echo esc_attr($tab_style)?>">
                <div class="product-tab-title">
                    <ul class="list-none" role="tablist">
                        <?php
                        $i = 1;
                        foreach ( $tabs as $key => $tab ) :
                        	if(in_array($key,$key_check_style)) continue;
                            if($i == 1) $active = 'active';
                            else $active = '';
                            $i++;

                            ?>
                            <li class="<?php echo esc_attr($active)?> <?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>">
                                <a class="font-title title14 color-title font-bold text-uppercase" href="#tab-<?php echo esc_attr( $key ); ?>" data-target="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="tab" aria-expanded="false">
                                    <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="product-tab-content">
                    <div class="tab-content">
                        <?php
                        $i = 1;
                        foreach ( $tabs as $key => $tab ) :
                        	if(in_array($key,$key_check_style)) continue;
                            $active = 'active';
                            ?>
                            <div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane <?php echo esc_attr($active)?>">
                                <div class="detail-tab-desc">
                                    <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
            break;
        default: ?>
            <div class="detail-product-tabs <?php echo esc_attr($tab_style)?>">
                <div class="product-tab-title">
                    <ul class="list-none" role="tablist">
                        <?php
                        $i = 1;
                        foreach ( $tabs as $key => $tab ) :
                        	if(in_array($key,$key_check_style)) continue;
                            if($i == 1) $active = 'active';
                            else $active = '';
                            $i++;
                            ?>
                            <li class="<?php echo esc_attr($active)?> <?php echo esc_attr( $key ); ?>_tab" id="tab-title-<?php echo esc_attr( $key ); ?>">
                                <a class="font-title title18 font-bold text-uppercase color-body" href="#tab-<?php echo esc_attr( $key ); ?>" data-target="#tab-<?php echo esc_attr( $key ); ?>" data-toggle="tab" aria-expanded="false">
                                    <?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $tab['title'] ), $key ); ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="product-tab-content">
                    <div class="tab-content">
                        <?php
                        $i = 1;
                        foreach ( $tabs as $key => $tab ) :
                        	if(in_array($key,$key_check_style)) continue;
                            $active = 'active';
                            ?>
                            <div id="tab-<?php echo esc_attr( $key ); ?>" class="tab-pane <?php echo esc_attr($active)?>">
                                <div class="detail-tab-desc">
                                    <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <?php
            break;
    }

endif;
