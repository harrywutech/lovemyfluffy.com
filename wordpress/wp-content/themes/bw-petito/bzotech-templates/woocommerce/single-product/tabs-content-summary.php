<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
$tabs = apply_filters( 'woocommerce_product_tabs', array() );
$tab_style = bzotech_get_value_by_id('product_tab_detail');
$get_style_woo_single = bzotech_get_value_by_id('sv_style_woo_single');
if ( ! empty( $tabs ) ) : 
        
    if($get_style_woo_single == 'sticky-style3'){ ?>
        <div class="set_offset_top">
            <div class="tab-content-mega tab-style-sticky-style3 <?php echo esc_attr($tab_style)?>">

                    <?php
                    $i = 1;
                    foreach ( $tabs as $key => $tab ) :
                        if($key == 'description') {
                            ?>
                            <div id="tab-<?php echo esc_attr( $key ); ?>" class="item-accordion">
                                <div class="detail-tab-desc">
                                    <?php if ( isset( $tab['callback'] ) ) { call_user_func( $tab['callback'], $key, $tab ); } ?>
                                </div>
                            </div>
                        <?php } endforeach; ?>

            </div>
        </div>
        <?php
    } ?>
    
<?php endif;
