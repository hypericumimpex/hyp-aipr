<?php	

	global $product;

	if ( ! is_a( $product, 'WC_Product' ) ) {
		return;
	}
	
	$content .= '<li>';

	$content .= '<a href="'.esc_url( $product->get_permalink() ).'">';
	$content .= $product->get_image();
	$content .= '<span class="product-title">'.wp_kses_post( $product->get_name() ).'</span>';
	$content .= '</a>';

	if ( $getRate == 1) :
		$content .= wc_get_rating_html( $product->get_average_rating() );
	endif;

	$content .= $product->get_price_html();

	$content .= '</li>';