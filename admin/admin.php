<?php
if ( !function_exists( 'add_action' ) ) {
    exit;
}

//function start
function DCAS_plugin_dashboard() {

?>

<div class="wrap projectStyle">
	<div id="whiteboxH" class="postbox">
	
	<div class="topHead">
		<h2><?php echo esc_html__("AI Product Recommendations Plugin - Dashboard", "DCAS-plugin") ?></h2>
		<?php settings_errors(); ?>
	</div>
	
	<div class="topHead settingsPanel">  <nav id="nav" class="clearfix">
    <ul class="clearfix">
      <li><a class="hover" href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_dashboard' ) ?>"><?php echo esc_html__("Dashboard", "DCAS-plugin") ?></a></li>
      <li><a href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_editor' ) ?>"><?php echo esc_html__("Shortcode Generator", "DCAS-plugin") ?></a></li>
	  <?php if( get_option("DCAS_advSettings") == 1) { ?>
	  <li><a href="<?php echo admin_url( 'admin.php?page=DCAS_plugin_advSettings' ) ?>"><?php echo esc_html__("Advanced Settings", "DCAS-plugin") ?></a></li>
	  <?php } ?>
    </ul>
  </nav>
	</div>
	<div class="inside">
        <form action="options.php" method="post">
        <?php settings_fields("DCAS_admin_settings") ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="DCAS_start"><?php echo esc_html__("AI Product Recommendations","DCAS-plugin") ?></label></th>
                    <td>
					<label class="button-toggle-wrap">
					  <input <?php if( get_option("DCAS_start") == 1) {echo 'checked="checked"';} ?> value="1" name="DCAS_start" class="toggler" type="checkbox" data-toggle="button-toggle"/>
					  <div class="button-toggle">
						<div class="handle">
						  <div class="bars"></div>
						</div>
					  </div>
					</label>
                        <p class="description" ><?php echo esc_html__("Activate the AI Product Recommendations plugin on the website.","DCAS-plugin") ?></p>
                    </td>
                </tr>  
				
				<?php if( get_option("DCAS_start") == 1) { ?>
                <tr valign="top">
                    <th scope="row"><label for="DCAS_advSettings"><?php echo esc_html__("Advanced Settings","DCAS-plugin") ?></label></th>
                    <td>
					<label class="button-toggle-wrap">
					  <input <?php if( get_option("DCAS_advSettings") == 1) {echo 'checked="checked"';} ?> value="1" name="DCAS_advSettings" class="toggler" type="checkbox" data-toggle="button-toggle"/>
					  <div class="button-toggle">
						<div class="handle">
						  <div class="bars"></div>
						</div>
					  </div>
					</label>
                        <p class="description" ><?php echo esc_html__("Activate the Advanced Settings for the AI Recommendation Algorithm.","DCAS-plugin") ?></p>
						<?php if( get_option("DCAS_advSettings") == 0) { echo "<p class='alertText'>".esc_html__("You are currently using the default settings.","DCAS-plugin")."</p>"; } else { echo "<a href='".admin_url( 'admin.php?page=DCAS_plugin_advSettings' )."'>".esc_html__("Advanced Settings","DCAS-plugin")."</a>";}?>
                    </td>
                </tr> 
				<?php }?>
	
			</table>
         
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
		
		<a target="_blank" href="https://codecanyon.net/item/ai-product-recommendations-for-woocommerce/reviews/24096686" class="sabutton button button-primary boxMarginSet"><?php echo esc_html__("Rate this plugin!", "DCAS-plugin") ?></a>
	</div>
		<?php submit_button() ?>
	</div>
	</div>
</div>
</form>
<?php }

add_action("admin_init","DCAS_admin_register");
function DCAS_admin_register() {

	//register settings
	register_setting("DCAS_admin_settings","DCAS_start");
	register_setting("DCAS_admin_settings","DCAS_advSettings");
	
}