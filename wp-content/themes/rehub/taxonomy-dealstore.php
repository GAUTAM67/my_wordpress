<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php get_header(); ?>

<!-- CONTENT -->
<div class="rh-container"> 
    <div class="rh-content-wrap clearfix">
        <!-- Main Side -->
        <div class="main-side page clearfix">
            <article class="post"> 
                <?php 
                    $tagid = get_queried_object()->term_id; 
                    $tagobj = get_term_by('id', $tagid, 'dealstore');
                    $tagname = $tagobj->name;
                    $tagslug = $tagobj->slug;
                    $brandimage = get_term_meta( $tagid, 'brandimage', true );
                    $brandseconddesc = get_term_meta( $tagid, 'brand_second_description', true );                              
                    echo '<div class="woo-tax-wrap">';
                    if (!empty ($brandimage)) { 
                        $showbrandimg = new WPSM_image_resizer();
                        $showbrandimg->height = '60';
                        $showbrandimg->src = $brandimage;                                   
                        echo '<div class="woo-tax-logo">';
                        $showbrandimg->show_resized_image();  
                        echo '</div>';
                    }
                    echo '<h3>'.$tagname.'</h3>';
                    echo rehub_get_user_rate('admin', 'tax');                               
                    echo '</div>';                                                  
                ?> 
                <?php
                    $description = term_description();
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
                    'tax_name' => 'dealstore',
                    'tax_slug' => $tagslug,
                    'data_source' => 'cpt',
                    'filterpanel' => $prepare_filter,
                    'show'=> 30,
                    'enable_pagination'=> '1'
                );?>
                <div class="re_filter_instore">
                <?php echo wpsm_offer_list_loop_shortcode($arg_array);?>
                </div>

                <div class="dealstore_tax_second_desc">
                    <?php echo do_shortcode($brandseconddesc);?>
                </div>       
            </article>
        </div>  
        <!-- /Main Side --> 
        <!-- Sidebar -->
        <aside class="sidebar">                 
            <!-- SIDEBAR WIDGET AREA -->
            <?php if ( is_active_sidebar( 'dealstore-sidebar' ) ) : ?>
                <?php dynamic_sidebar( 'dealstore-sidebar' ); ?>
            <?php else : ?>
                <p><?php _e('No widgets added. Add widgets inside Deal store archive sidebar in Appearance - Widgets', 'rehub_framework'); ?></p>
            <?php endif; ?>                                     
        </aside>
        <!-- /Sidebar --> 
    </div>
</div>
<!-- /CONTENT -->     

<!-- FOOTER -->
<?php get_footer(); ?>