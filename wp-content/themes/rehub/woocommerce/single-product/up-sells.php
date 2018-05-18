<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	    http://docs.woothemes.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

$upsells = $product->get_upsell_ids();

if ( sizeof( $upsells ) === 0 ) {
	return;
}

$posts_per_page  = $columns = 6;

$upsells = implode(',',$upsells);

echo '<h3>'.__( 'You may also like&hellip;', 'woocommerce' ).'</h3>';
if(rehub_option('woo_single_sidebar') =='1') {
	if (rehub_option('woo_design') == 'grid') {
		echo wpsm_woogrid_shortcode(array('ids'=>$upsells, 'columns'=>'3_col', 'data_source'=>'ids', 'show'=> 3, 'show_coupons_only'=>2));	
	}
	else{
		echo wpsm_woocolumns_shortcode(array('ids'=>$upsells, 'columns'=>'3_col', 'data_source'=>'ids', 'show'=> 3, 'show_coupons_only'=>2));				
	}		
}
else{
	if (rehub_option('woo_design') == 'grid') {	
		echo wpsm_woogrid_shortcode(array('ids'=>$upsells, 'columns'=>'5_col', 'data_source'=>'ids', 'show'=> 5, 'show_coupons_only'=>2));					
	}
	else{
		echo wpsm_woocolumns_shortcode(array('ids'=>$upsells, 'columns'=>'5_col', 'data_source'=>'ids', 'show'=> 5, 'show_coupons_only'=>2));			
	}			
}