<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}

//function start
function DCAS_plugin_editor() {
?>

<div class="wrap projectStyle">
	<div id="whiteboxH" class="postbox">
	
	<div class="topHead">
		<h2><?php echo __("AI Product Recommendations Plugin - Shortcode Generator", "DCAS-plugin") ?></h2>
	</div>
	
	<div class="topHead settingsPanel">  <nav id="nav" class="clearfix">
    <ul class="clearfix">
      <li><a href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_dashboard' ) ?>"><?php echo esc_html__("Dashboard", "DCAS-plugin") ?></a></li>
      <li><a class="hover" href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_editor' ) ?>"><?php echo esc_html__("Shortcode Generator", "DCAS-plugin") ?></a></li>
	  <?php if( get_option("DCAS_advSettings") == 1) { ?>
	  <li><a href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_advSettings' ) ?>"><?php echo esc_html__("Advanced Settings", "DCAS-plugin") ?></a></li>
	  <?php } ?>
    </ul>
  </nav>
	</div>
	<div class="inside"><?php if( get_option("DCAS_start") == 1) { ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for="dcas-style"><?php echo esc_html__("Product Style","DCAS-plugin") ?></label></th>
				<td>
				<select id="dcas-style">
					<option value="0" ><?php echo esc_html__("Default Widget Theme","DCAS-plugin") ?></option>
					<option value="1" ><?php echo esc_html__("Default Theme","DCAS-plugin") ?></option>
					<option value="2" ><?php echo esc_html__("AIPR Widget Theme","DCAS-plugin") ?></option>
					<option value="3" ><?php echo esc_html__("AIPR Theme","DCAS-plugin") ?></option>
				</select>
					<p><?php echo esc_html__("Choose the style of product recommendations.","DCAS-plugin"); ?></p>
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row"><label for="dcas-rating"><?php echo esc_html__("Ratings","DCAS-plugin") ?></label></th>
				<td>
				<input type="checkbox" id="dcas-rating" value="1" />
				<p><?php echo esc_html__("Show user ratings on Product Recommendations","DCAS-plugin"); ?></p>
				</td>
			</tr>			
			
			<tr valign="top">
				<th scope="row"><label for="dcas-number"><?php echo esc_html__("Number of Recommendations","DCAS-plugin") ?></label></th>
				<td>
				<label>
				<input id="dcas-number" type="number" value="" />
				</label>
					<p><?php echo esc_html__("Set the number of recommended products to display.","DCAS-plugin"); ?></p>
					<p><i><strong><?php echo esc_html__("Default: 5 (Recommended between 5-10)","DCAS-plugin") ?></strong></i></p>
				</td>
			</tr>
			
			<tr valign="top">
				<th scope="row"><label for="dcas-columns"><?php echo esc_html__("Columns","DCAS-plugin") ?></label></th>
				<td>
				<label>
				<input id="dcas-columns" type="number" value="" />
				</label>
					<p><?php echo esc_html__("Set the number of columns for the products to display.","DCAS-plugin"); ?></p>
					<p><i><strong><?php echo esc_html__("Default: 1 (You don't need to set for the widget style.)","DCAS-plugin") ?></strong></i></p>
				</td>
			</tr>
		</table>
		<span id="dcas-get-shortcode"></span>
						
         <?php } else { ?>
	<p><?php echo esc_html__("Please enable the plugin from the AI Product Recommendations Dashboard page.", "DCAS-plugin") ?></p>
	<?php } ?>
      </div>
	  
	</div>
	
</div>

	<div class="wrap projectStyle" id="whiteboxH">
	<div class="postbox">
	<div class="inside">
	<div class="inlineblockSet">
  
		<div class="contentDoYouLike">
		  <p><?php echo esc_html__("How would you rate this plugin?", "DCAS-plugin") ?></p>
		</div>

		<div class="wrapperDoYouLike">
		  <input type="checkbox" id="st1" value="1" />
		  <label for="st1"></label>
		  <input type="checkbox" id="st2" value="2" />
		  <label for="st2"></label>
		  <input type="checkbox" id="st3" value="3" />
		  <label for="st3"></label>
		  <input type="checkbox" id="st4" value="4" />
		  <label for="st4"></label>
		  <input type="checkbox" id="st5" value="5" />
		  <label for="st5"></label>
		</div>					
		
		<a target="_blank" href="https://codecanyon.net/item/ai-product-recommendations-for-woocommerce/reviews/24096686" class="sabutton button button-primary boxMarginSet"><?php echo __("Rate this plugin!", "DCAS-plugin") ?></a>
		
	</div>
	<?php //translation
	$headText = __("Your Shortcode", "DCAS-plugin");
	$pText = __("You can copy and paste this shortcode into the WordPress pages.", "DCAS-plugin");
	?>
	<p class="submit"><span id="dcas-submit"></span><a onclick="DCAS_getMyShortcode('<?php echo esc_attr($headText) ?>', '<?php echo esc_attr($pText) ?>')" class="button button-primary boxMarginSet"><?php echo esc_html__("Create Shortcode", "DCAS-plugin") ?></a></p>
	</div>
	</div>
</div>
<?php 
wp_enqueue_script('DCAS-Shortcode-Script', DCAS_URL.'admin/assets/js/script.js');
}
