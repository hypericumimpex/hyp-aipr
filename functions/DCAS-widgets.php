<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}

if( get_option("DCAS_start") == 1 ) {
	
	//if activated Woocommerce
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
 
class DCAS_Widget extends WP_Widget {
 
    function __construct() {
 
        parent::__construct(
            'dcas-widget',  // Base ID
            __( 'AI Product Recommendations', 'DCAS-plugin' ),   // Name
			array('description' => __( 'Display AI Product Recommendations as a widget.', 'DCAS-plugin' ))
        );
 
        add_action( 'widgets_init', function() {
            register_widget( 'DCAS_Widget' );
        });
 
    }
 
    public $args = array(
        'before_title'  => '<h4 class="widgettitle">',
        'after_title'   => '</h4>'
    );
 
    public function widget( $args, $instance ) {
		if(get_option("DCAS_suggestType") == 2) : $getCookie = @$_COOKIE["DCAS_Tags"]; else: $getCookie = @$_COOKIE["DCAS_Categories"]; endif;
			
			echo '<div class="widget woocommerce widget_products">';
	 
			if ( ! empty( $instance['title'] ) ) {
				echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ) . $args['after_title'];
			}
			
			if($instance['reviews'] == 1) : $Reviewtype = 1; else: $Reviewtype = 0; endif; 
			
			$wStyle = $instance['wStyle'];  
			
			$columnID = $instance['columnID'];  
			
			if(!empty($instance['wPPP'])) : $wPPP = $instance['wPPP']; else: $wPPP = ""; endif; 
			
			if ($wStyle == 0) :
				echo '<ul class="product_list_widget">';			
				echo DCAS_get_suggest_loop($Reviewtype, $wStyle, $wPPP);
				echo '</ul>';
			elseif ($wStyle == 1) :
				echo '<section class="site-main woocommerce related products"><ul class="products columns-'.$columnID.'">';
				echo DCAS_get_suggest_loop($Reviewtype, $wStyle, $wPPP);
				echo '</ul></section>';			
			elseif ($wStyle == 2) :
				echo '<ul class="AIPS_list">';			
				echo DCAS_get_suggest_loop($Reviewtype, $wStyle, $wPPP);
				echo '</ul>';		
			elseif ($wStyle == 3) :
				echo '<section class="site-main woocommerce related products"><ul class="products columns-'.$columnID.'">';
				echo DCAS_get_suggest_loop($Reviewtype, $wStyle, $wPPP);
				echo '</ul></section>';
			endif;
			
			echo '</div>';
 
    }
 
    public function form( $instance ) {
 
        $title = ! empty( $instance['title'] ) ? $instance['title'] : "";
        $wPPP = ! empty( $instance['wPPP'] ) ? $instance['wPPP'] : 5;
        $reviews = ! empty( $instance['reviews'] ) ? $instance['reviews'] : 0;
        $wStyle = ! empty( $instance['wStyle'] ) ? $instance['wStyle'] : 0;
        $columnID = ! empty( $instance['columnID'] ) ? $instance['columnID'] : 1;
        ?>
        <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo esc_html__( 'Title:', 'DCAS-plugin' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
        </p>       
		
		<p>
		
        <label for="<?php echo esc_attr( $this->get_field_id( 'wStyle' ) ); ?>"><?php echo esc_html__( 'Widget Style:', 'DCAS-plugin' ); ?></label>
		<select class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'wStyle' ) ); ?>">
		
			<option value="0" <?php if( $wStyle == 0) {echo 'selected="selected"';} ?>><?php echo esc_html__("Default Widget Theme","DCAS-plugin") ?></option>
			<option value="1" <?php if( $wStyle == 1) {echo 'selected="selected"';} ?>><?php echo esc_html__("Default Theme","DCAS-plugin") ?></option>
			<option value="2" <?php if( $wStyle == 2) {echo 'selected="selected"';} ?>><?php echo esc_html__("AIPR Widget Theme","DCAS-plugin") ?></option>
			<option value="3" <?php if( $wStyle == 3) {echo 'selected="selected"';} ?>><?php echo esc_html__("AIPR Theme","DCAS-plugin") ?></option>
		</select>
		
		</p>
		
		<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'wPPP' ) ); ?>"><?php echo esc_html__( 'Number of products to show:', 'DCAS-plugin' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'wPPP' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'wPPP' ) ); ?>" type="text" value="<?php echo esc_attr( $wPPP ); ?>">
        </p>		
		
		<p>
		<?php if( ($wStyle == 1) || ($wStyle == 3)) { ?>
        <label for="<?php echo esc_attr( $this->get_field_id( 'columnID' ) ); ?>"><?php echo esc_html__( 'Number of Columns:', 'DCAS-plugin' ); ?></label>
            <input class="widefat" min="1" max="6" id="<?php echo esc_attr( $this->get_field_id( 'columnID' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'columnID' ) ); ?>" type="text" value="<?php echo esc_attr( $columnID ); ?>">
        </p>
		<?php } ?>
		
		<p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'reviews' ) ); ?>"><?php echo esc_html__( 'Enable Product Reviews on Widget:', 'DCAS-plugin' ); ?></label>
			<input <?php if( $reviews == 1) {echo 'checked="checked"';} ?> value="1" id="<?php echo esc_attr( $this->get_field_id( 'reviews' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'reviews' ) ); ?>" type="checkbox"/>
        </p>		
        <?php
 
    }
 
    public function update( $new_instance, $old_instance ) {
 
        $instance = array();
 
        $instance['title'] = ( !empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['wStyle'] = ( !empty( $new_instance['wStyle'] ) ) ? strip_tags( $new_instance['wStyle'] ) : '';
        $instance['wPPP'] = ( !empty( $new_instance['wPPP'] ) ) ? strip_tags( $new_instance['wPPP'] ) : '';
        $instance['columnID'] = ( !empty( $new_instance['columnID'] ) ) ? strip_tags( $new_instance['columnID'] ) : '';
        $instance['reviews'] = ( !empty( $new_instance['reviews'] ) ) ? $new_instance['reviews'] : '';
		
        return $instance;
    }
 
}
$my_widget = new DCAS_Widget();
}
	
}
	