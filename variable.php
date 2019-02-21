<?php
/**
* Custom Accordions on Variable Products
* @NOTE This file needs to be placed within your WP theme
* under the following directory:
* THEME_NAME/woocommerce/single-product/add-to-cart/variable.php
* --------------------
* @author Complex Digital
* @version 3.5.5 (Tested with WooCommerce Version 3.5.5)
* @package Storefront Child
*/

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
/* Default WooCommerce Action - DO NOT TOUCH */
do_action( 'woocommerce_before_add_to_cart_form' ); ?>

<form class="variations_form cart" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php
		do_action( 'woocommerce_before_variations_form' );
		if ( empty( $available_variations ) && false !== $available_variations ) : ?>
			<p class="stock out-of-stock"><?php esc_html_e( 'This product is currently out of stock and unavailable.', 'woocommerce' ); ?></p>
		<?php else : ?>
			<div id="wc_variations__accordion">
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<button class="accordion" type="button">
						<?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?>
					</button>
					<div class="variation__section">
						<?php
							/* Get WooCommerce Variation Drop Down */
							wc_dropdown_variation_attribute_options( array(
								'options'   => $options,
								'attribute' => $attribute_name,
								'product'   => $product,
							) );
							echo end( $attribute_keys ) === $attribute_name ? wp_kses_post( apply_filters( 'woocommerce_reset_variations_link', '<a class="reset_variations" href="#">' . esc_html__( 'Clear', 'woocommerce' ) . '</a>' ) ) : '';
						?>
					</div><!-- variation__section -->
				<?php endforeach; ?>
			</div><!-- wc_variations__accordion -->
			<div class="single_variation_wrap">
				<?php
					/* Default WooCommerce Actions - DO NOT TOUCH */
					do_action( 'woocommerce_before_single_variation' );
					do_action( 'woocommerce_single_variation' );
					do_action( 'woocommerce_after_single_variation' );
				?>
			</div>
		<?php endif;
		do_action( 'woocommerce_after_variations_form' );
	?>
</form>

<?php
do_action( 'woocommerce_after_add_to_cart_form' );
