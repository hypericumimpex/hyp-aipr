<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}

//function start
function DCAS_plugin_advSettings() {
?>

<div class="wrap projectStyle">
	<div id="whiteboxH" class="postbox">
	
	<div class="topHead">
		<h2><?php echo esc_html__("AI Product Recommendations Plugin - Settings", "DCAS-plugin") ?></h2>
		<?php settings_errors(); ?>
	</div>
	
	<div class="topHead settingsPanel">  <nav id="nav" class="clearfix">
		<ul class="clearfix">
		  <li><a href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_dashboard' ) ?>"><?php echo esc_html__("Dashboard", "DCAS-plugin") ?></a></li>
		  <li><a href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_editor' ) ?>"><?php echo esc_html__("Shortcode Generator", "DCAS-plugin") ?></a></li>
		  <?php if( get_option("DCAS_advSettings") == 1) { ?>
		  <li><a class="hover" href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_styles' ) ?>"><?php echo esc_html__("Advanced Settings", "DCAS-plugin") ?></a></li>
		  <?php } ?>
		</ul>
	  </nav>
	</div>
	<div class="inside"><?php if( get_option("DCAS_start") == 1) { ?>
        <form action="options.php" method="post">
        <?php settings_fields("DCAS_adv_settings");?>
            <?php if( get_option("DCAS_advSettings") == 1) { ?>
			<table class="form-table">
				<tr valign="top"><strong><h1 class="h1TextHead"><?php echo esc_html__("Algorithm Settings", "DCAS-plugin") ?></h1></strong><p class="alertText"><?php echo esc_html__("Please make the settings carefully.","DCAS-plugin") ?></p><br></tr>
				
					<tr valign="top">
							<th scope="row"><label for="DCAS_suggestType"><?php echo esc_html__("Recommendation Type","DCAS-plugin") ?></label></th>
							<td>
							<label>
							<select name="DCAS_suggestType">
								<option value="1" <?php selected( get_option("DCAS_suggestType"), 1); ?>><?php echo esc_html__("Categories","DCAS-plugin") ?></option>
								<option value="2" <?php selected( get_option("DCAS_suggestType"), 2); ?>><?php echo esc_html__("Tags","DCAS-plugin") ?></option>
							</select>
							</label>
								<p><?php echo esc_html__("This plugin saves product categories (or tags) according to the products visited. It then shows the product recommendations according to these settings. Select a setting to save.","DCAS-plugin");?></p>
								<p><i><strong><?php echo esc_html__("Default: Categories (The Categories option is recommended.)","DCAS-plugin") ?></strong></i></p>
							</td>
						</tr>					
						
						<tr valign="top">
							<th scope="row"><label for="DCAS_suggestTime"><?php echo esc_html__("Browser Cookies","DCAS-plugin") ?></label></th>
							<td>
							<label>
							<input name="DCAS_suggestTime" type="number" value="<?php echo esc_attr(get_option("DCAS_suggestTime")) ?>" />
							</label>
								<p><?php echo esc_html__("Set the cookie time (seconds) for the user.","DCAS-plugin"); ?></p>
								<p><i><strong><?php echo esc_html__("Default: 2629743 (2629743 seconds = 1 months)","DCAS-plugin") ?></strong></i></p>
							</td>
						</tr>						
						
						<tr valign="top">
							<th scope="row"><label for="DCAS_idLimit"><?php echo esc_html__("ID Limit","DCAS-plugin") ?></label></th>
							<td>
							<label>
							<input name="DCAS_idLimit" type="number" value="<?php echo esc_attr(get_option("DCAS_idLimit")) ?>" />
							</label>
								<p><?php echo esc_html__("Number of categories / tags to save. If you increase the number, the similarity of the recommended products decreases.","DCAS-plugin"); ?></p>
								<p><i><strong><?php echo esc_html__("Default: 10 (Recommended between 5-20)","DCAS-plugin") ?></strong></i></p>
							</td>
						</tr>
						
					<tr>
						<th scope="row"><label for="DCAS_purchProducts"><?php echo esc_html__("Purchased Products","DCAS-plugin") ?></label></th>
						<td>
						<label class="button-toggle-wrap">
						  <input <?php if( get_option("DCAS_purchProducts") == 1) {echo 'checked="checked"';} ?> value="1" name="DCAS_purchProducts" class="toggler" type="checkbox" data-toggle="button-toggle"/>
						  <div class="button-toggle">
							<div class="handle">
							  <div class="bars"></div>
							</div>
						  </div>
						</label>
							<p class="description"><?php echo esc_html__("If the user has previously purchased any products, show them similar products.","DCAS-plugin") ?></p>
							<p><i><strong><?php echo esc_html__("Default: Yes","DCAS-plugin") ?></strong></i></p>
							
						</td>
					</tr>					
					<!-- ADDED 1.1.2 -->
					<tr>
						<th scope="row"><label for="DCAS_cartProducts"><?php echo esc_html__("Products in Cart","DCAS-plugin") ?></label></th>
						<td>
						<label class="button-toggle-wrap">
						  <input <?php if( get_option("DCAS_cartProducts") == 1) {echo 'checked="checked"';} ?> value="1" name="DCAS_cartProducts" class="toggler" type="checkbox" data-toggle="button-toggle"/>
						  <div class="button-toggle">
							<div class="handle">
							  <div class="bars"></div>
							</div>
						  </div>
						</label>
							<p class="description"><?php echo esc_html__("If there are any products in the user's cart, show them similar products.","DCAS-plugin") ?></p>
							<p><i><strong><?php echo esc_html__("Default: Yes","DCAS-plugin") ?></strong></i></p>
							
						</td>
					</tr>
					<!-- ADDED 1.1.2 -->
				
			</table>
			<?php } ?>
    <?php } else { ?>
	<p><?php echo esc_html__("Please enable the plugin from the AI Product Recommendations - Dashboard page.","DCAS-plugin") ?></p>
	<?php } ?></div>
	
	  
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
		
		<a target="_blank" href="https://codecanyon.net/item/ai-product-recommendations-for-woocommerce/reviews/24096686" class="sabutton button button-primary boxMarginSet"><?php echo esc_html__("Rate this plugin!", "DCAS-plugin") ?></a>
	</div>
	<?php submit_button() ?>
	</form>
	</div>
	</div>
</div>
<?php }


add_action("admin_init","DCAS_styles_register");
function DCAS_styles_register() {

	//register settings
	register_setting("DCAS_adv_settings","DCAS_suggestType");
	register_setting("DCAS_adv_settings","DCAS_suggestTime");
	register_setting("DCAS_adv_settings","DCAS_idLimit");
	register_setting("DCAS_adv_settings","DCAS_purchProducts");
	//added 1.1.2
	register_setting("DCAS_adv_settings","DCAS_cartProducts");
	
}