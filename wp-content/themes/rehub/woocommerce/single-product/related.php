<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0

 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;


if (rehub_option('rehub_wcv_related') == '1'){
	$artist = get_the_author_meta('ID');
	$classes = array();
	if (rehub_option('woo_design') == 'grid') {
		$classes[] = 'grid_woo';
	}
	else{
		$classes[] = 'column_woo';		
	}
	$classes[] = 'rh-flex-eq-height';
	if(rehub_option('woo_single_sidebar') =='1') {
		$posts_per_page = 3;
		$classes[] = 'col_wrap_three';
	}
	else{
		$posts_per_page = 5;
		$classes[] = 'col_wrap_fifth';
	}
	$args = apply_filters('woocommerce_related_products_args', array(
        'post_type' => 'product',
        'ignore_sticky_posts'   => 1,
        'no_found_rows'   => 1,
        'posts_per_page'  => $posts_per_page,
        'author' => $artist,
        'post__not_in' => array($product->get_id())
	) );
	$products = new WP_Query( $args );
	if ( $products->have_posts() ) : 
		echo '<div class="clearfix"></div><h3>'.__( 'Related Products', 'woocommerce' ).'</h3>';
		echo '<div class="products '.implode(' ',$classes).'">';
		while ( $products->have_posts() ) : $products->the_post();
			if (rehub_option('woo_design') == 'grid') {
				include(rh_locate_template('inc/parts/woogridpart.php'));
			}
			else{
				include(rh_locate_template('inc/parts/woocolumnpart.php'));		
			}		
		endwhile; 
		echo '<div>';
	endif;
}
else {
	$related = wc_get_related_products($product->get_id());
	if ( sizeof( $related ) == 0 ) return;
	$posts_per_page  = $columns = 6;
	$related = implode(',',$related);
	echo '<div class="clearfix"></div><h3>'.__( 'Related Products', 'woocommerce' ).'</h3>';
	if(rehub_option('woo_single_sidebar') =='1') {
		if (rehub_option('woo_design') == 'grid') {
			echo wpsm_woogrid_shortcode(array('ids'=>$related, 'columns'=>'3_col', 'data_source'=>'ids', 'show'=> 3, 'show_coupons_only'=>2));	
		}
		else{
			echo wpsm_woocolumns_shortcode(array('ids'=>$related, 'columns'=>'3_col', 'data_source'=>'ids', 'show'=> 3, 'show_coupons_only'=>2));				
		}		
	}
	else{
		if (rehub_option('woo_design') == 'grid') {	
			echo wpsm_woogrid_shortcode(array('ids'=>$related, 'columns'=>'5_col', 'data_source'=>'ids', 'show'=> 5, 'show_coupons_only'=>2));					
		}
		else{
			echo wpsm_woocolumns_shortcode(array('ids'=>$related, 'columns'=>'5_col', 'data_source'=>'ids', 'show'=> 5, 'show_coupons_only'=>2));			
		}			
	}
}