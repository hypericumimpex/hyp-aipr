<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}

if( get_option("DCAS_start") == 1 ) {
	
	//if activated Woocommerce
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

	
	function DCAS_styAdd() {
		wp_enqueue_script( 'DCAS-script', 
                       DCAS_URL."functions/assets/js/dcas-script.js", 
                       array(), 
                       '1.0.0', 
                       true);
		wp_enqueue_style('DCAS-style', DCAS_URL."functions/assets/css/dcas-style.css");
	}	
	
	function DCAS_scriptAdd() {
		//if product page
		if ( is_product() ){
			global $post;
			$postId = $post->ID;
			$terms = (get_option("DCAS_suggestType") == 2) ? wp_get_post_terms($postId, "product_tag", array("fields" => "ids")) : wp_get_post_terms($postId, "product_cat", array("fields" => "ids"));
			$cats = (get_option("DCAS_suggestType") == 2) ? @$_COOKIE["DCAS_Tags"] : @$_COOKIE["DCAS_Categories"];
			$catsName = (get_option("DCAS_suggestType") == 2) ? 2 : 1;
			$cookieTime = (!empty(get_option("DCAS_suggestTime"))) ? get_option("DCAS_suggestTime") : 2629743;
			$DCAS_idLimit = (!empty(get_option("DCAS_idLimit"))) ? get_option("DCAS_idLimit") : 10;

			?>
			<script type="text/javascript">
			document.addEventListener("DOMContentLoaded", function(event) { 
				var IDType = <?php echo esc_js($catsName); ?>;
				var cookieTime = <?php echo esc_js($cookieTime); ?>;
				var idLimit = <?php echo esc_js($DCAS_idLimit); ?>;
				var defaultID = <?php echo json_encode($terms); ?>;
				var readyID = <?php if(!isset($cats)) { echo "undefined"; } else { echo $cats; } ?>;
				categoryRun(IDType, defaultID, readyID, cookieTime, idLimit);
			});</script><?php
		}
	}	
	add_action("wp_footer", "DCAS_scriptAdd");
	add_action( "wp_enqueue_scripts", "DCAS_styAdd" );
	
	
	function DCAS_get_suggest_loop($show_rating, $wStyle, $PPPdata) {
		// Query Arguments
		if (get_option("DCAS_suggestType") == 2) {
			$getCookie = @json_decode($_COOKIE["DCAS_Tags"]); 
			$taxonomy1 = 'product_tag'; 
			$taxonomy2 = 'exclude-from-tag'; 
		} else { 
			$getCookie = @json_decode($_COOKIE["DCAS_Categories"]); 
			$taxonomy1 = 'product_cat'; 
			$taxonomy2 = 'exclude-from-catalog';
		}
		
		//purch check
		if(!empty(get_option("DCAS_purchProducts")))
			$purchCheck = get_option("DCAS_purchProducts");
		else
			$purchCheck = 1;
		
		//purch and cookie check
		if($purchCheck == 1 && !empty(DCAS_pItems()) && !empty($getCookie))
			$getCookie = array_reduce(array($getCookie, DCAS_pItems()), 'array_merge', array());
		
		//cart and cookie check - ADDED 1.1.2
		if($purchCheck == 1 && !empty(DCAS_cItems()) && !empty($getCookie))
			$getCookie = array_reduce(array($getCookie, DCAS_cItems()), 'array_merge', array());
		
		//if not have any cookies
		if(empty($getCookie)) {
			$termArray = false;
		} else {
			$termArray = array(
							array(
								'taxonomy'      => $taxonomy1,
								'field' 		=> 'term_id', //This is optional, as it defaults to 'term_id'
								'terms'         => $getCookie,
								'operator'      => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
							),
							array(
								'taxonomy'      => 'product_visibility',
								'field'         => 'slug',
								'terms'         => $taxonomy2, // Possibly 'exclude-from-search' too
								'operator'      => 'NOT IN'
							)
						);
		}
		
		//rating check
		if(empty($show_rating))
			$getRate = 0;
		else
			$getRate = $show_rating;	
		
		//style check
		if(empty($wStyle))
			$getStyle = 0;
		else
			$getStyle = $wStyle;
		
		// posts per page check
		if(empty($PPPdata))
			$checkPPP = 5;
		else
			$checkPPP = $PPPdata;
		
		
		$args = array(
			'post_type' => "product",
			'post_status' => "publish",
			'posts_per_page' => $checkPPP,
			'order' => 'DESC',
			'orderby' => 'rand',
			'tax_query' => $termArray
		);

		// The Query
		$DCASPost = new WP_Query( $args );

		$content = '';

		// The Query
		if ( $DCASPost->have_posts() ) : while ( $DCASPost->have_posts() ) : $DCASPost->the_post(); 
		//start loop
			//if style 0
			if ($getStyle == 0) :
				
				include(DCAS_DIR."templates/widget-loop.php");
			
			//if style 1
			elseif ($getStyle == 1) :
			
				$classes = wc_get_product_class();
				$removefrom = array ("last", "first");
				$productClass = array_diff($classes, $removefrom);
				
				echo '<li class="'. esc_attr( implode( ' ', $productClass ) ) .'" >';
				include(DCAS_DIR."templates/default-loop.php");
				echo '</li>';
			
			elseif ($getStyle == 2) :
			
				include(DCAS_DIR."templates/aipr-widget-loop.php");			
				
			elseif ($getStyle == 3) :
			
				$classes = wc_get_product_class();
				$removefrom = array ("last", "first");
				$productClass = array_diff($classes, $removefrom);
				
				echo '<li class="'. esc_attr( implode( ' ', $productClass ) ) .'" >';
				include(DCAS_DIR."templates/aipr-default-loop.php");
				echo '</li>';
				
			endif;
			
		//endwhile
		endwhile; 
			wp_reset_postdata();
			return $content;
		endif;
	}

	//Purchased Product
	function DCAS_pItems() {
		if(get_option("DCAS_purchProducts") == 1) {
			// GET CURR USER
			$current_user = wp_get_current_user();
			if ( 0 == $current_user->ID ) return;
		   
			// GET USER ORDERS
			$customer_orders = get_posts( array(
				'numberposts' => -1,
				'meta_key'    => '_customer_user',
				'meta_value'  => $current_user->ID,
				'post_type'   => wc_get_order_types(),
				'post_status' => array_keys( wc_get_is_paid_statuses() ),
			) );
		   
		   //GET Purchased Items IDs
			if ( ! $customer_orders ) return;
			$product_ids = array();
			foreach ( $customer_orders as $customer_order ) {
				$order = wc_get_order( $customer_order->ID );
				$items = $order->get_items();
				foreach ( $items as $item ) {
					$product_postId = $item->get_product_id();
					$product_postIds[] = $product_postId;
					
					foreach ($product_postIds as $product_pId) {
						$product_ids[] = (get_option("DCAS_suggestType") == 2) ? wp_get_post_terms($product_pId, "product_tag", array("fields" => "ids")) : wp_get_post_terms($product_pId, "product_cat", array("fields" => "ids"));
					}
					
				}
			}
			$product_ids = array_values(array_unique(call_user_func_array('array_merge' , $product_ids)));
			return $product_ids;
		   
		}
	}	
	
	//Cart Product
	//ADDED 1.1.2
	function DCAS_cItems() {
		if(get_option("DCAS_cartProducts") == 1) {
		   global $woocommerce;	
	       $items = WC()->cart->get_cart();
		   
		   $product_ids = array();
		   
		   foreach ( $items as $cart_item_key => $values ) {
				$_product = $values['data'];
				$terms = (get_option("DCAS_suggestType") == 2) ? get_the_terms( $_product->id, 'product_tag' ) : get_the_terms( $_product->id, 'product_cat' );
 
				foreach ($terms as $term) {
					$product_ids[] = $term->term_id;
				}
				
			}
			
			return $product_ids;
		   
		}
	}

	
	
}
	
}
	