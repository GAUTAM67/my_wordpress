<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php global $product; global $post;?>
<?php if (empty( $product ) || ! $product->is_visible() ) {return;}?>
<?php $classes = array('product', 'col_item', 'offer_grid', 'mobile_compact_grid', 'offer_grid_com', 'thumb_enabled_col');?>
<?php if (rehub_option('woo_btn_disable') == '1'){$classes[] = 'no_btn_enabled';}?>
<?php $woolinktype = (isset($woolinktype)) ? $woolinktype : '';?>
<?php $woolink = ($woolinktype == 'aff' && $product->get_type() =='external') ? $product->add_to_cart_url() : get_post_permalink($post->ID) ;?>
<?php $wootarget = ($woolinktype == 'aff' && $product->get_type() =='external') ? ' target="_blank" rel="nofollow"' : '' ;?>
<?php $offer_coupon = get_post_meta( $post->ID, 'rehub_woo_coupon_code', true ) ?>
<?php $offer_coupon_date = get_post_meta( $post->ID, 'rehub_woo_coupon_date', true ) ?>
<?php $offer_coupon_mask = '1' ?>
<?php $offer_url = esc_url( $product->add_to_cart_url() ); ?>
<?php $custom_img_width = (isset($custom_img_width)) ? $custom_img_width : '';?>
<?php $custom_img_height = (isset($custom_img_height)) ? $custom_img_height : '';?>
<?php $custom_col = (isset($custom_col)) ? $custom_col : '';?>
<?php $coupon_style = $expired = ''; if(!empty($offer_coupon_date)) : ?>
    <?php 
    $timestamp1 = strtotime($offer_coupon_date); 
    $seconds = $timestamp1 - (int)current_time('timestamp',0); 
    $days = floor($seconds / 86400);
    $seconds %= 86400;
    if ($days > 0) {
      $coupon_text = $days.' '.__('days left', 'rehub_framework');
      $coupon_style = '';
    }
    elseif ($days == 0){
      $coupon_text = __('Last day', 'rehub_framework');
      $coupon_style = '';
    }
    else {
        $coupon_text = __('Expired', 'rehub_framework');
        $coupon_style = ' expired_coupon';
        $expired = '1';
    }                 
    ?>
<?php endif ;?>
<?php do_action('woo_change_expired', $expired); //Here we update our expired?>
<?php $classes[] = $coupon_style;?>
<?php $coupon_mask_enabled = (!empty($offer_coupon) && ($offer_coupon_mask =='1' || $offer_coupon_mask =='on') && $expired!='1') ? '1' : ''; ?>
<?php if($coupon_mask_enabled =='1') {$classes[] = 'reveal_enabled';}?>
<div <?php post_class( $classes ); ?>>
    <div class="info_in_dealgrid">
        <figure>
            <a href="<?php echo $woolink ;?>"<?php echo $wootarget ;?>>
                <?php if ( $product->is_featured() ) : ?>
                        <?php echo apply_filters( 'woocommerce_featured_flash', '<span class="onfeatured">' . __( 'Featured!', 'rehub_framework' ) . '</span>', $post, $product ); ?>
                <?php endif; ?>        
                <?php if ( $product->is_on_sale() && !$product->is_type( 'variable' )) : ?>
                    <?php 
                    $percentage=0;
                    $featured = ($product->is_featured()) ? ' onsalefeatured' : '';
                    if ($product->get_regular_price()) {
                        $percentage = round( ( ( $product->get_regular_price() - $product->get_price() ) / $product->get_regular_price() ) * 100 );
                    }
                    if ($percentage && $percentage>0) {
                        $sales_html = apply_filters( 'woocommerce_sale_flash', '<span class="onsale'.$featured.'"><span>- ' . $percentage . '%</span></span>', $post, $product );
                    } else {
                        $sales_html = apply_filters( 'woocommerce_sale_flash', '<span class="onsale'.$featured.'">' . esc_html__( 'Sale!', 'rehub_framework' ) . '</span>', $post, $product );
                    }
                    ?>
                    <?php echo $sales_html; ?>
                <?php endif; ?>
                <?php 
                $showimg = new WPSM_image_resizer();
                $showimg->use_thumb = true; 
                $showimg->no_thumb = rehub_woocommerce_placeholder_img_src('');                                   
                ?>
                <?php if($custom_col) : ?>
                    <?php $showimg->width = (int)$custom_img_width;?>
                    <?php $showimg->height = (int)$custom_img_height;?>             
                <?php elseif($columns == '3_col') : ?>
                    <?php $showimg->width = '224';?>
                <?php elseif($columns == '4_col') : ?>
                    <?php $showimg->width = '156';?>  
                <?php elseif($columns == '5_col') : ?>
                    <?php $showimg->width = '186';?>   
                <?php elseif($columns == '6_col') : ?>
                    <?php $showimg->width = '146';?>                      
                <?php else : ?>
                    <?php $showimg->width = '224';?>                                       
                <?php endif ; ?>            
                <?php $showimg->show_resized_image(); ?>
            </a>
            <div class="yith_float_btns">
                <div class="button_action"> 
                    <?php if ( defined( 'YITH_WCWL' )){ ?> 
                        <?php echo do_shortcode('[yith_wcwl_add_to_wishlist]'); ?> 
                    <?php } ?>                                          
                </div> 
            </div>          
        </figure>
        <div class="grid_desc_and_btn">
            <div class="grid_row_info">
                <div class="price_row_grid">
                    <div class="price_for_grid floatleft">
                        <span class="price_count">
                        <?php wc_get_template( 'loop/price.php' ); ?>
                        </span>
                    </div>
                    <div class="floatright vendor_for_grid">
                        <?php $author_id=$post->post_author;?>
                        <?php $vendor_avatar = rh_show_vendor_avatar( $author_id, 22, 22 );?>
                        <?php if ($vendor_avatar) :?>
                            <img src="<?php echo $vendor_avatar ?>" class="vendor_store_image_single" width=22 height=22 />
                        <?php else:?>
                            <div class="brand_logo_small">       
                                <?php WPSM_Woohelper::re_show_brand_tax('logo'); //show brand logo?>
                            </div>
                        <?php endif;?>
                    </div>
                </div>     
                <?php do_action( 'rehub_woo_after_compact_grid_price' ); ?>        
                <h3 class="eq_height_inpost <?php if(rehub_option('hotmeter_disable') !='1') :?><?php echo getHotIconclass($post->ID); ?><?php endif ;?>"><?php echo rh_expired_or_not($post->ID, 'span');?><a href="<?php echo $woolink;?>"<?php echo $wootarget;?>><?php the_title();?></a></h3> 
                <?php wc_get_template( 'loop/rating.php' );?>
                <?php do_action( 'rehub_woo_after_compact_grid_title' ); ?>
            </div> 
            <?php if (rehub_option('woo_btn_disable') != '1'):?>
                <div class="priced_block clearfix">
                    <?php if ( $product->add_to_cart_url() !='') : ?>
                        <?php  echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                            sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="re_track_btn woo_loop_btn btn_offer_block %s %s product_type_%s"%s>%s</a>',
                            esc_url( $product->add_to_cart_url() ),
                            esc_attr( $product->get_id() ),
                            esc_attr( $product->get_sku() ),
                            $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                            $product->supports( 'ajax_add_to_cart' ) ? 'ajax_add_to_cart' : '',
                            esc_attr( $product->get_type() ),
                            $product->get_type() =='external' ? ' target="_blank"' : '',
                            esc_html( $product->add_to_cart_text() )
                            ),
                    $product );?> 
                    <?php endif; ?>               
                    <?php if ($coupon_mask_enabled =='1') :?>
                        <?php wp_enqueue_script('zeroclipboard'); ?>
                        <a class="woo_loop_btn coupon_btn re_track_btn btn_offer_block rehub_offer_coupon masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>" data-codeid="<?php echo $product->get_id() ?>" data-dest="<?php echo $offer_url ?>"><?php if(rehub_option('rehub_mask_text') !='') :?><?php echo rehub_option('rehub_mask_text') ; ?><?php else :?><?php _e('Reveal coupon', 'rehub_framework') ?><?php endif ;?>
                        </a>
                    <?php else :?>
                        <?php if(!empty($offer_coupon)) : ?>
                            <?php wp_enqueue_script('zeroclipboard'); ?>
                            <div class="rehub_offer_coupon not_masked_coupon <?php if(!empty($offer_coupon_date)) {echo $coupon_style ;} ?>" data-clipboard-text="<?php echo $offer_coupon ?>"><i class="fa fa-scissors fa-rotate-180"></i><span class="coupon_text"><?php echo $offer_coupon ?></span>
                            </div>
                        <?php endif;?>
                    <?php endif;?>
                </div>                     
            <?php endif;?>             
        </div>        
    </div>
    <div class="meta_for_grid">
        <div class="cat_store_for_grid floatleft">
            <div class="cat_for_grid">
                <?php $categories = wp_get_post_terms($post->ID, 'product_cat');  ?>
                <?php if (!empty($categories)) {$first_cat = $categories[0]->term_id; meta_small( false, $first_cat, false, false );} ?>                         
            </div>
            <div class="store_for_grid store_post_meta_item">
                <?php WPSM_Woohelper::re_show_brand_tax(); //show brand taxonomy?>
            </div>            
        </div>
        <div class="date_for_grid floatright">
            <span class="date_ago">
                <i class="fa fa-clock-o"></i><?php printf( __( '%s ago', 'rehub_framework' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
            </span>        
        </div>   
    </div>
    <?php do_action( 'rehub_after_compact_grid_meta' ); ?>
    <div class="re_actions_for_grid <?php if(rehub_option('woo_rhcompare') != true) :?>two_col_btn_for_grid<?php endif;?>">
        <div class="btn_act_for_grid">
            <?php echo getHotThumb($post->ID, false);?>
        </div>
        <?php if(rehub_option('woo_rhcompare') == true) :?>
            <div class="btn_act_for_grid">
                <span class="compare_for_grid">            
                    <?php $cmp_btn_args = array(); $cmp_btn_args['class']= 'comparecompact';?>
                    <?php echo wpsm_comparison_button($cmp_btn_args); ?> 
                </span>
            </div>
        <?php endif;?>         
        <div class="btn_act_for_grid">
            <span class="comm_number_for_grid"><?php echo get_comments_number(); ?></span>
        </div>       
    </div>  

</div>