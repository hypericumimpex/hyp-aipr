<?php	

	global $product;
	
	if ( ! is_a( $product, 'WC_Product' ) ) {
		return;
	}
	
?>
<span class="AIPS_theme">
	<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
	<?php echo $product->get_image(); ?>

	<span class="product-title"><?php echo wp_kses_post( $product->get_name() ); ?></span>
	</a>
	
	<?php
	if ( $getRate == 1) :
		echo wc_get_rating_html( $product->get_average_rating() );
	endif;
	?>
	
	<?php echo $product->get_price_html(); ?>
</span>