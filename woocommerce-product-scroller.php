<?php error_reporting(0);
/*
 * Plugin Name: Responsive Woocommerce Product Scroll Slider
 * Description: The Responsive Woocommerce Scroll slider plugin comes by default with a beautiful, responsive, modern theme. This plugin is designed for users and the UI is very intuitive and easy to use.
 * Author: Raju
 * Author URI: http://wpfreeplugin.couponfortoday.com
 *
*/
/* Setup the plugin. */
add_action( 'plugins_loaded', 'woopss_setup' );
/**
 * Setup function.
 *
 */
function woopss_setup() {
	/* Get the plugin directory URI. */
	define( 'WOOPRODUCTSCROLLER_URI', trailingslashit( plugin_dir_url( __FILE__ ) ) );
	/* Scoll shortcodes. */
	add_action( 'init', 'wocommerce_scroll_shortcode' );
	/* Enqueue the stylesheet. */
	add_action( 'template_redirect', 'woopss_enqueue_stylesheets' );
	/* Enqueue the JavaScript. */
}


/* Enqueue the stylesheet.*/
function woopss_enqueue_stylesheets() {
  wp_enqueue_style( 'woopss-scoll-style1', WOOPRODUCTSCROLLER_URI . 'css/owl.carousel.css', false, 0.1, 'all' ); 
  wp_enqueue_style( 'woopss-scoll-style2', WOOPRODUCTSCROLLER_URI . 'css/owl.theme.css', false, 0.1, 'all' ); 
}


function woopss_add_this_script_footer(){ ?>
<!-- Produst slider script -->
<script src="<?php echo WOOPRODUCTSCROLLER_URI ?>js/owl.carousel.js"></script>
<style>
    #owl-demo .item{
        margin: 6px;
    }
    #owl-demo .item img{
        display: block;
        width: 100%;
        height: auto;
    }
	.item a { text-decoration:none; color:#000000; }
	.item a:hover { text-decoration:underline; }
    </style>
<script>
    jQuery(document).ready(function($) {
     $("#owl-demo").owlCarousel({
        items : 6,
        lazyLoad : true,
        navigation : false
      });
	 });
    </script>

<!-- End Produst slider script -->
<?php }
/* add script to footer */
add_action('wp_footer', 'woopss_add_this_script_footer'); 
/* shortcode */
include('view/productslider.php');
function wocommerce_scroll_shortcode() {
	add_shortcode( 'woopsc', 'woopssfunc' );
	add_shortcode( 'woocommerce scroll slider', 'woopssfunc' );
}

// create custom plugin settings menu
add_action('admin_menu', 'woopss_create_menu');

function woopss_create_menu() {

	//create new top-level menu
	add_menu_page('Woocommerce Scroll Slider Plugin Settings', 'Product Slider', 'administrator', __FILE__, 'woopss_settings_page');

	//call register settings function
	add_action( 'admin_init', 'woopss_register_mysettings' );
}


function woopss_register_mysettings() {
	register_setting( 'slider-settings-group', 'wooproductscroller_prodcat' );
	register_setting( 'slider-settings-group', 'wooproductscroller_title' );
	register_setting( 'slider-settings-group', 'wooproductscroller_no_of_products' );
	register_setting( 'slider-settings-group', 'wooproductscroller_orderBy' );	
	register_setting( 'slider-settings-group', 'wooproductscroller_order' );
}
function woopss_settings_page() {
?>
<div class="wrap ms-toggle">
  <h2>Slider Settings</h2>
  <br/>
  <br/>
  <table width="50%" class="widefat">
    
        <tr>
          <th style="width: 100px;" colspan="2"><h3>If this has helped you and saved your time please consider a help to plugin developer to develop new extraordinary plugin. So, Please click on Ad shown below :<div align="center"></div>
</th>
        </tr>
  
    </table>
	<table width="100%"  class="widefat">
	<tr><td width="25%">
  <form method="post" action="options.php">
    <?php settings_fields( 'slider-settings-group' ); ?>
	<table width="100%">
      <thead>
        <tr>
          <th style="width: 100px;" colspan="2"><h3>Slider Setting</h3></th>
        </tr>
      </thead>
      <tbody class="ui-sortable">
	   <tr valign="top">
          <th align="left">Select Product Categories: </th>
          <td><select name="wooproductscroller_prodcat">
              <option value="" <?php if (get_option( 'wooproductscroller_prodcat' ) == '' ) echo 'selected="selected"'; ?>>All</option>
			 <?php  
			  $product_cats = get_terms( 'product_cat', 'orderby=count&hide_empty=0' );
				foreach($product_cats as $product_cat)
				{
					$term_id = $product_cat->term_id;
					$term_name = $product_cat->name;
					 if (get_option('wooproductscroller_prodcat') == $term_id ) { echo $selected = 'selected="selected"'; } else { $selected=''; };
					echo '<option value="'.$term_id.'" '.$selected.' >'.$term_name.'</option>';
				}
			
			?>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th align="left">Display Title: </th>
          <td><select name="wooproductscroller_title">
              <option value="True" <?php if (get_option( 'wooproductscroller_title' ) == 'True' ) echo 'selected="selected"'; ?>>True</option>
              <option value="False" <?php if ( get_option( 'wooproductscroller_title' ) == 'False' ) echo 'selected="selected"'; ?>>False</option>
            </select>
          </td>
        </tr>
        <tr valign="top">
          <th align="left" width="20%">No.of products: </th>
          <td><select name="wooproductscroller_no_of_products">
              <option value="4" <?php if ( get_option( 'wooproductscroller_no_of_products' ) == 4 ) echo 'selected="selected"'; ?>>4</option>
              <option value="8" <?php if ( get_option( 'wooproductscroller_no_of_products' ) == 8 ) echo 'selected="selected"'; ?>>8</option>
              <option value="12" <?php if ( get_option( 'wooproductscroller_no_of_products' ) == 12 ) echo 'selected="selected"'; ?>>12</option>
              <option value="16" <?php if ( get_option( 'wooproductscroller_no_of_products' ) == 16 ) echo 'selected="selected"'; ?>>16</option>
              <option value="20" <?php if ( get_option( 'wooproductscroller_no_of_products' ) == 20 ) echo 'selected="selected"'; ?>>20</option>
              <option value="All" <?php if ( get_option( 'wooproductscroller_no_of_products' ) == 'All' ) echo 'selected="selected"'; ?>>All</option>
            </select></td>
        </tr>
        <tr valign="top">
          <th align="left">Sort Product By: </th>
          <td><select name="wooproductscroller_orderBy" style="width:30%">
              <option value="prod_title" <?php if ( get_option( 'wooproductscroller_orderBy' ) == 'prod_title' ) echo 'selected="selected"'; ?>>Product Title</option>
              <option value="prod_id" <?php if ( get_option( 'wooproductscroller_orderBy' ) == 'prod_id' ) echo 'selected="selected"'; ?>>Product ID</option>
            </select>
           </td>
        </tr>
		 <tr valign="top">
          <th align="left">Sort Order By: </th>
          <td>
            <select name="wooproductscroller_order">
              <option value="ASC" <?php if ( get_option( 'wooproductscroller_order' ) == 'ASC' ) echo 'selected="selected"'; ?>>Ascending</option>
              <option value="DESC" <?php if ( get_option( 'wooproductscroller_order' ) == 'DESC' ) echo 'selected="selected"'; ?>>Descending</option>
            </select></td>
        </tr>
        <tr valign="top">
          <td colspan="2" align="center"><?php submit_button(); ?></td>
        </tr>
		</tbody>
    </table>
  </form>
  </td><td  width="25%"><a href="http://www.Amazon.in/exec/obidos/redirect-home?tag=coup06-21&placement=home_multi.gif&site=amazon">
<img src="http://g-ec2.images-amazon.com/images/G/31/associates/promohub/amazonIN_logo_200_75.jpg?tag-id=coup06-21" border="0" alt="In Association with Amazon.in">
</a></td></tr></table>
</div>
<?php }?>