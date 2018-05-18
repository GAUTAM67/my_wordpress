<?php
/**
 * Single Product Price, including microdata for SEO
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;

?>
<div>
<p class="price"><?php echo $product->get_price_html(); ?></p>
</div>
<?php if ($product->is_on_sale() && $product->get_regular_price() && $product->get_price() > 0 && !$product->is_type( 'variable' )) : ?>
    <span class="save_proc_woo">
        <?php   
            $offer_price_calc = (float) $product->get_price();
            $offer_price_old_calc = (float) $product->get_regular_price();
            $sale_proc = 100 - ($offer_price_calc / $offer_price_old_calc) * 100; 
            $sale_proc = round($sale_proc); 
            _e('Save ', 'rehub_framework'); echo $sale_proc; echo '% ';
        ;?>
    </span>
<?php endif ?>