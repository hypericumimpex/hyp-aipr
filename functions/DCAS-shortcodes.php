<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}

if( get_option("DCAS_start") == 1 ) {
	
	//if activated Woocommerce
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		// Add Shortcode
		function DCAS_shortcode_func( $atts , $content = null ) {

			// Attributes
			$atts = shortcode_atts(
				array(
					'rating' => 0,
					'style' => 0,
					'postsperpage' => 5,
					'columns' => 1,
				),
				$atts,
				'DCAS_shortcode'
			);
			
			// Query
			if ($atts['style'] == 0) :
				$das .= '<div class="woocommerce widget_products"><ul class="product_list_widget">';			
				$das .= DCAS_get_suggest_loop($atts['rating'], $atts['style'], $atts['postsperpage']);
				$das .= '</ul></div>';
			elseif ($atts['style'] == 1) :
			ob_start();
				echo '<section class="site-main woocommerce related products"><ul class="products columns-'. esc_attr($atts['columns']) .'">';
				echo DCAS_get_suggest_loop($atts['rating'], $atts['style'], $atts['postsperpage']);
				echo '</ul></section>';
			return ob_get_clean();
			elseif ($atts['style'] == 2) :
				$das .= '<div class="woocommerce widget_products"><ul class="AIPS_list">';			
				$das .= DCAS_get_suggest_loop($atts['rating'], $atts['style'], $atts['postsperpage']);
				$das .= '</ul></div>';
			elseif ($atts['style'] == 3) :
			ob_start();
				echo '<section class="site-main woocommerce related products"><ul class="products columns-'. esc_attr($atts['columns']) .'">';
				echo DCAS_get_suggest_loop($atts['rating'], $atts['style'], $atts['postsperpage']);
				echo '</ul></section>';
			return ob_get_clean();
			endif;
			return $das;
			

		}
		add_shortcode( 'DCAS_shortcode', 'DCAS_shortcode_func' );

	}
	
}
	