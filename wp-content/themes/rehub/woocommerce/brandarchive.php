<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$tagid = get_queried_object()->term_id; 
$tagobj = get_term_by('id', $tagid, 'store');
$tagname = $tagobj->name;
$tagslug = $tagobj->slug;
$brandimage = get_term_meta( $tagid, 'brandimage', true );
$brandseconddesc = get_term_meta( $tagid, 'brand_second_description', true );
?>

<!-- CONTENT -->
<div class="rh-container"> 
    <div class="rh-content-wrap clearfix">
        <!-- Main Side -->
        <div class="main-side woocommerce page clearfix">
            <article class="post" id="page-<?php the_ID(); ?>">  
                <div class="woo-tax-wrap">
                    <?php                              
                    if (!empty ($brandimage)) { 
                        $showbrandimg = new WPSM_image_resizer();
                        $showbrandimg->height = '60';
                        $showbrandimg->src = $brandimage;                                   
                        echo '<div class="woo-tax-logo">';
                        $showbrandimg->show_resized_image();  
                        echo '</div>';
                    }?>
                    <h3><?php echo $tagname;?></h3>
                    <?php echo rehub_get_user_rate('admin', 'tax'); ?>                              
                </div>                                                 
                <?php
                    $description = wc_format_content( term_description() );
                    if ( $description && !is_paged() ) {
                        echo '<div class="term-description">' . $description . '</div>';
                    }
                ?>
                <?php $prepare_filter = array();?>
                <?php 
                    $prepare_filter[] = array (
                        'filtertitle' => __('All', 'rehub_framework'),
                        'filtertype' => 'all',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );
                    $prepare_filter[] = array (
                        'filtertitle' => __('Deals', 'rehub_framework'),
                        'filtertype' => 'deals',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );                     
                    $prepare_filter[] = array (
                        'filtertitle' => __('Coupons', 'rehub_framework'),
                        'filtertype' => 'coupons',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    ); 
                    $prepare_filter[] = array (
                        'filtertitle' => __('Sales', 'rehub_framework'),
                        'filtertype' => 'sales',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    ); 
                    $prepare_filter[] = array (
                        'filtertitle' => __('Expired', 'rehub_framework'),
                        'filtertype' => 'expired',
                        'filterorderby' => 'date',
                        'filterorder'=> 'DESC', 
                        'filterdate' => 'all',                        
                    );  
                    $prepare_filter = urlencode(json_encode($prepare_filter));             
                ?>
                <?php $arg_array = array(
                    'tax_name' => 'store',
                    'tax_slug' => $tagslug,
                    'filterpanel' => $prepare_filter,
                    'show'=> 30
                );?>
                <div class="re_filter_instore">
                <?php echo wpsm_woolist_shortcode($arg_array);?>
                </div>

                <div class="woostore_tax_second_desc">
                    <?php echo do_shortcode($brandseconddesc);?>
                </div>

                <?php
                    /**
                     * woocommerce_after_main_content hook.
                     *
                     * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
                     */
                    do_action( 'woocommerce_after_main_content' );
                ?> 

            </article>
        </div>
    <!-- /Main Side --> 

    <!-- Sidebar -->
    <aside class="sidebar">                 
        <!-- SIDEBAR WIDGET AREA -->
        <?php if ( is_active_sidebar( 'woostore-sidebar' ) ) : ?>
            <?php dynamic_sidebar( 'woostore-sidebar' ); ?>
        <?php else : ?>
            <p><?php _e('No widgets added. Add widgets inside Woo brand archive sidebar in Appearance - Widgets', 'rehub_framework'); ?></p>
        <?php endif; ?>                                     
    </aside>
    <!-- /Sidebar --> 

    </div>
</div>
<!-- /CONTENT -->