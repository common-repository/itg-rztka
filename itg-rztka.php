<?php
/**
 * This is an MVP version of the plugin. It does not have any foolproofing whatsoever.
 *
 * @link              https://itguild.pro
 * @since             1.0.0
 * @package           Itg_Rozetka_Ua
 *
 * @wordpress-plugin
 * Plugin Name: IT Guild Rozetka.ua Integration
 * Description: Integrate your online store with Rozetka.ua marketplace!
 * Version: 1.2
 * Author: Eugene Gorelikov
 * Author URI: https://itguild.pro
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: itg-rztka
 * Domain Path: /languages
 * WC requires at least: 3.0.0
 * WC tested up to: 3.9.0
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

add_action( 'plugins_loaded', 'itg_rztka_init' );
function itg_rztka_init(){
	load_plugin_textdomain( 'itg-rztka', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
}


//create metabox with feed values for products
function itg_rztka_add_meta_boxes ( $post ){
	add_meta_box( 'itg_rztka_product_metabox', __( 'Rozetka.ua integration', 'itg-rztka' ), 'itg_rztka_product_meta_box', 'product', 'normal');
}
add_action( 'add_meta_boxes_product', 'itg_rztka_add_meta_boxes' );


//product metabox output
function itg_rztka_product_meta_box( $post ){
	//nonce
	wp_nonce_field( basename( __FILE__ ), 'itg_rztka_product_nonce' );

	//meta values
	$itg_rztka_adtofeed = get_post_meta($post->ID, 'itg_rztka_adtofeed', true);
	$itg_rztka_description = get_post_meta($post->ID, 'itg_rztka_description', true);
	$itg_rztka_country = get_post_meta($post->ID, 'itg_rztka_country', true);
	$itg_rztka_vendor = get_post_meta($post->ID, 'itg_rztka_vendor', true);
	$itg_rztka_kind = get_post_meta($post->ID, 'itg_rztka_kind', true);
	$itg_rztka_color = get_post_meta($post->ID, 'itg_rztka_color', true);
	$itg_rztka_size = get_post_meta($post->ID, 'itg_rztka_size', true);
	$itg_rztka_lifetime = get_post_meta($post->ID, 'itg_rztka_lifetime', true);
	$itg_rztka_warranty = get_post_meta($post->ID, 'itg_rztka_warranty', true);
	$itg_rztka_payshipping = get_post_meta($post->ID, 'itg_rztka_payshipping', true);
	$disabled = ( get_option( 'itg_rztka_shop_product_attributes' ) == 1 ) ? false : 1;
	?>
	<div class='inside'>
		<h3><?php _e( 'Product XML feed', 'itg-rztka' ); ?></h3>
		<p>
			<input type="checkbox" id="itg_rztka_adtofeed" name="itg_rztka_adtofeed" value="1" <?php echo ($itg_rztka_adtofeed == '1') ? 'checked' : ''; ?>/>
			<label for="itg_rztka_adtofeed" class="description"><?php _e('Add this product into the XML feed for rozetka.ua.', 'itg-rztka'); ?></label>
		</p>
		<h3><?php _e( 'Custom description.', 'itg-rztka' ); ?></h3>
		<p>
			<textarea id="itg_rztka_description" name="itg_rztka_description" style="width:100%;"><?php echo $itg_rztka_description; ?></textarea>
			<span class="description"><?php _e('You can leave this field empty. In this case the default product description will be used.', 'itg-rztka'); ?></span>
		</p>
	<?php if ( empty( $disabled ) ) : ?>
		<p>
			<h4><?php esc_attr_e( 'From the settings page you have opted to user product attributes instead of fields suggested by IT Guild Rozetka Feed.', 'itg-rztka' ); ?></h4>
		</p>
	<?php else :  ?>
		<p>
			<h3><?php _e( 'Vendor', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_vendor" name="itg_rztka_vendor" value="<?php echo $itg_rztka_vendor; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('Specify vendor.', 'itg-rztka'); ?></span>
		</p>
		<p>
			<h3><?php _e( 'Manufacturer country', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_country" name="itg_rztka_country" value="<?php echo $itg_rztka_country; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('Specify the country of manufacturer.', 'itg-rztka'); ?></span>
		</p>
		<p>
			<h3><?php _e( 'Kind', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_kind" name="itg_rztka_kind" value="<?php echo $itg_rztka_kind; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('The "Kind".', 'itg-rztka'); ?></span>
		</p>
		<p>
			<h3><?php _e( 'Color', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_color" name="itg_rztka_color" value="<?php echo $itg_rztka_color; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('Specify item color.', 'itg-rztka'); ?></span>
		</p>
		<p>
			<h3><?php _e( 'Sizes', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_size" name="itg_rztka_size" value="<?php echo $itg_rztka_size; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('Example: "XXXS".', 'itg-rztka'); ?></span>
		</p>
		<p>
			<h3><?php _e( 'Item lifetime', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_lifetime" name="itg_rztka_lifetime" value="<?php echo $itg_rztka_lifetime; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('Example: "Up to 24 month".', 'itg-rztka'); ?></span>
		</p>
		<p>
			<h3><?php _e( 'Warranty', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_warranty" name="itg_rztka_warranty" value="<?php echo $itg_rztka_warranty; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('Example: "1 year limited warranty".', 'itg-rztka'); ?></span>
		</p>
		<p>
			<h3><?php _e( 'Shipping/Payment', 'itg-rztka' ); ?></h3>
			<input type="text" id="itg_rztka_payshipping" name="itg_rztka_payshipping" value="<?php echo $itg_rztka_payshipping; ?>"<?php echo $disabled; ?>></br>
			<span class="description"><?php _e('Shipping and payment terms.', 'itg-rztka'); ?></span>
		</p>
	<?php endif;  ?>
	</div>
	<?php
}

//Save product metabox
function itg_rztka_product_meta_box_save( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['itg_rztka_product_nonce'] ) || !wp_verify_nonce( $_POST['itg_rztka_product_nonce'], basename( __FILE__ ) ) ){
		return;
	}
	
	if ( isset( $_REQUEST['itg_rztka_adtofeed'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_adtofeed', intval( $_POST['itg_rztka_adtofeed'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_adtofeed');
	}
	
	if ( isset( $_REQUEST['itg_rztka_description'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_description', sanitize_text_field( $_POST['itg_rztka_description'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_description');
	}
	
	if ( isset( $_REQUEST['itg_rztka_country'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_country', sanitize_text_field( $_POST['itg_rztka_country'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_country');
	}
	
	if ( isset( $_REQUEST['itg_rztka_vendor'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_vendor', sanitize_text_field( $_POST['itg_rztka_vendor'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_vendor');
	}
	
	if ( isset( $_REQUEST['itg_rztka_kind'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_kind', sanitize_text_field( $_POST['itg_rztka_kind'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_kind');
	}
	
	if ( isset( $_REQUEST['itg_rztka_color'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_color', sanitize_text_field( $_POST['itg_rztka_color'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_color');
	}
	
	if ( isset( $_REQUEST['itg_rztka_size'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_size', sanitize_text_field( $_POST['itg_rztka_size'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_size');
	}
	
	if ( isset( $_REQUEST['itg_rztka_lifetime'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_lifetime', sanitize_text_field( $_POST['itg_rztka_lifetime'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_lifetime');
	}
	
	if ( isset( $_REQUEST['itg_rztka_warranty'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_warranty', sanitize_text_field( $_POST['itg_rztka_warranty'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_warranty');
	}

	if ( isset( $_REQUEST['itg_rztka_payshipping'] ) ) {
		update_post_meta( $post_id, 'itg_rztka_payshipping', sanitize_text_field( $_POST['itg_rztka_payshipping'] ) );
	} else {
		delete_post_meta ($post_id, 'itg_rztka_payshipping');
	}

}
add_action( 'save_post_product', 'itg_rztka_product_meta_box_save' );

//register feed page template
function itg_rztka_add_feed_template ($templates, $wp_theme, $post, $post_type) {
	$templates['page-itg-rztka-feed.php'] = __('Rozetka Feed', 'itg-rztka');
	return $templates;
}
add_filter ( 'theme_page_templates' , 'itg_rztka_add_feed_template' , 10 , 4 );

//create redirect to plugin template directory
function itg_rztka_redirect_feed_template ($template) {
	$post = get_post(); 
	$page_template = get_post_meta( $post->ID, '_wp_page_template', true ); 
	if ('page-amazon-feed.php' == basename ($page_template )){
		$template = WP_PLUGIN_DIR . '/itg-rztka/templates/page-itg-rztka-feed.php';
	}
		
	// for WP < v4.7
	if ('page-itg-rztka-feed.php' == basename ($template)){
		$template = WP_PLUGIN_DIR . '/itg-rztka/templates/page-itg-rztka-feed.php';
	}
	
	return $template;
}
add_filter ('page_template', 'itg_rztka_redirect_feed_template');

function itg_rztka_add_feed_tamplate( $template ){

	if( get_page_template_slug() === 'page-itg-rztka-feed.php'){
		$template = __DIR__ .'/templates/page-itg-rztka-feed.php';
	}

	return $template;
}
add_filter('template_include', 'itg_rztka_add_feed_tamplate');

function itg_rztka_get_cats_n_products (){
	
	if ( ! function_exists ('wc_get_product') ){
		return 'Woocommerce not installed!';
	}
	
	$args = array(
		'post_type' => 'product',
		'post_status' => 'publish',
		'posts_per_page' => -1,
		'meta_query' => array (
			array( //rztka feed checkbox
				'key' => 'itg_rztka_adtofeed',
				'value' => '1',
				'compare' => '='
			),
			
		),
	);
	
	$product_loop = new WP_Query( $args );
	
	$product_cats = array();
	
	if ( $product_loop->have_posts() ) {
		while ( $product_loop->have_posts() ) : 
			$product_loop->the_post();
			//getting product cats
			global $post;
			$current_product_categories = wp_get_post_terms($post->ID, 'product_cat');
			$term_match = false;
			
			foreach ($current_product_categories as $cur_prod_cat){
				foreach ( $product_cats as $existing_cat ) {
					if ( $existing_cat->term_id == $cur_prod_cat->term_id ) {
						$term_match = true;
					}
				}
				
				if ( $term_match == true ) {
					$term_match = false; //resetting the value
					continue;
				} else {
					//do the category concat here
					$product_cats[] = $cur_prod_cat;
					$output_cats .= "\t<category id=\"{$cur_prod_cat->term_id}\">{$cur_prod_cat->name}</category>\n\t";
				}
			}
			
			$product = wc_get_product ($post->ID);
			//var_dump( $product );
			$general_atts = $product->get_attributes();
			//var_dump($general_atts);
			
			$pictures = $product->get_gallery_image_ids();
			$pictures[] = $product->get_image_id();
			
			if( 'simple' === $product->get_type() ){
				// TODO: get all the post meta in a singe query.
				
				$products .= "\n\t\t<offer id=\"" . $post->ID . "\" available=" . ( ( get_post_meta( get_the_ID(), '_stock_status', true ) == 'instock' ) ? "\"true\"" : "\"false\"" ) . ">";
				$products .= "\n\t\t\t<url>" . get_the_permalink() . "</url>";
				$products .= "\n\t\t\t<price>" . get_post_meta( $post->ID, '_regular_price', true) . "</price>";
				if ( ! empty( $sale_price = get_post_meta( $post->ID, '_sale_price', true) ) && $sale_price < get_post_meta( $post->ID, '_regular_price', true) ) {
					$products .= "\n\t\t\t<price_promo>" . $sale_price . "</price_promo>";
				}
				$products .= "\n\t\t\t<currencyId>" . get_woocommerce_currency() . "</currencyId>";
				$products .= "\n\t\t\t<categoryId>" . $current_product_categories[0]->term_id . "</categoryId>"; //pulling the first term only
				
				$pictures_xml = '';
				
				if ( ! empty( $pictures ) ){
					foreach ($pictures as $picture_id ) {
						$pic_src = wp_get_attachment_url( $picture_id );
						if ( $pic_src ) {
							$pictures_xml .= "\n\t\t\t<picture>" . $pic_src . "</picture>";
						}
					}
				}

				$products .= $pictures_xml; //pulling the first term only
				$products .= "\n\t\t\t<name>" . $post->post_title . "</name>"; //pulling the first term only
				
				$products .= "\n\t\t\t<stock_quantity>" . get_post_meta($post->ID, '_stock', true) . "</stock_quantity>"; //pulling the first term only
				$products .= "\n\t\t\t<description><![CDATA[" . get_post_meta($post->ID, 'itg_rztka_description', true) . "]]></description>"; //pulling the first term only
				
				if ( '1' != get_option( 'itg_rztka_shop_product_attributes' ) ) {
					// Гsing inbuilt product attsю
					$products .= "\n\t\t\t<vendor>" . get_post_meta($post->ID, 'itg_rztka_vendor', true) . "</vendor>"; //pulling the first term only
					$products .= "\n\t\t\t<param name=\"Страна-производитель\">" . get_post_meta( $post->ID, 'itg_rztka_country', true) . "</param>";
					$products .= "\n\t\t\t<param name=\"Вид\">" . get_post_meta($post->ID, 'itg_rztka_kind', true) . "</param>";
					$products .= "\n\t\t\t<param name=\"Цвет\">" . $itg_rztka_color = get_post_meta($post->ID, 'itg_rztka_color', true) . "</param>";
					$products .= "\n\t\t\t<param name=\"Размеры\">" . get_post_meta($post->ID, 'itg_rztka_size', true) . "</param>";
					$products .= "\n\t\t\t<param name=\"Срок эксплуатации\">" . get_post_meta($post->ID, 'itg_rztka_lifetime', true) . "</param>";
					$products .= "\n\t\t\t<param name=\"Гарантия\">" . get_post_meta($post->ID, 'itg_rztka_warranty', true) . "</param>";
					$products .= "\n\t\t\t<param name=\"Доставка/Оплата\">" . get_post_meta($post->ID, 'itg_rztka_payshipping', true) . "</param>";
					
				} else {
					//var_dump($general_atts);
					//pulling product attributes
					foreach ( $general_atts as $general_att ) {
						$general_att_array = $general_att->get_data();
						//var_dump($general_att_array);
						if ( true === $general_att_array['variation'] ) {
							continue;
						}
						if ( 1 === $general_att_array['is_taxonomy'] ) {
							$tax_att = get_taxonomy( $general_att_array['name'] );
							if ( ! empty( $tax_att ) ) {
								foreach ( $general_att_array['options'] as $general_att_value ) {
									$att_term = get_term($general_att_value);
									$products .= "\n\t\t\t<param name=\"". $tax_att->labels->singular_name ."\">" . $att_term->name . "</param>";
								}
							}
						} else {
							$products .= "\n\t\t\t<param name=\"". $general_att_array['name'] ."\">" . str_replace( ' | ', ', ', $general_att_array['value'] ) . "</param>";
						}
					}
					
				}
				$products .= "\n\t\t</offer>";

			} elseif( 'variable' === $product->get_type() ) {
				$variations = $product->get_available_variations();
				//var_dump($product);

				$custom_atts = $product->get_variation_attributes();
				
				
				if ( ! empty( $variations ) ){
					foreach ($variations as $variation){
						$variation_obj = wc_get_product( $variation['variation_id'] );
						$title = $post->post_title;
						//var_dump( $variation['attributes'] );
						if ( ! empty( $variation['attributes'] ) ) {
							$title .= " (";
							$last_index = array_key_last( $variation['attributes'] );
							$atts = '';
							foreach ( $variation['attributes'] as $att_index => $attribute ) {
								
								$title .= $attribute;

								if ($att_index != $last_index ) {
									$title .= ", ";
								}
								
								if ( '1' != get_option( 'itg_rztka_shop_product_attributes' ) ) {
									// Using inbuilt product atts.
									$products .= "\n\t\t\t<vendor>" . get_post_meta($post->ID, 'itg_rztka_vendor', true) . "</vendor>"; //pulling the first term only
									$products .= "\n\t\t\t<param name=\"Страна-производитель\">" . get_post_meta( $post->ID, 'itg_rztka_country', true) . "</param>";
									$products .= "\n\t\t\t<param name=\"Вид\">" . get_post_meta($post->ID, 'itg_rztka_kind', true) . "</param>";
									$products .= "\n\t\t\t<param name=\"Цвет\">" . $itg_rztka_color = get_post_meta($post->ID, 'itg_rztka_color', true) . "</param>";
									$products .= "\n\t\t\t<param name=\"Размеры\">" . get_post_meta($post->ID, 'itg_rztka_size', true) . "</param>";
									$products .= "\n\t\t\t<param name=\"Срок эксплуатации\">" . get_post_meta($post->ID, 'itg_rztka_lifetime', true) . "</param>";
									$products .= "\n\t\t\t<param name=\"Гарантия\">" . get_post_meta($post->ID, 'itg_rztka_warranty', true) . "</param>";
									$products .= "\n\t\t\t<param name=\"Доставка/Оплата\">" . get_post_meta($post->ID, 'itg_rztka_payshipping', true) . "</param>";
					
								} else {
								
									foreach ( $custom_atts as $tax => $att ) {
										//echo "\n hello \n";
										//print_r( $variation['attributes'], true );
										//echo $variation['attributes'][ 'attribute_' . urlencode( wc_attribute_taxonomy_slug( $tax ) ) ];
										//echo "\n" . 'attribute_' . urlencode( wc_attribute_taxonomy_slug( $tax ) ) . "\n";
										
										$atts .= "\n\t\t\t<param name=\"". wc_attribute_label( $tax ) ."\">" . $variation['attributes'][ 'attribute_' . strtolower( urlencode( wc_attribute_taxonomy_slug( $tax ) ) ) ]  . "</param>";
									}
									
									foreach ( $general_atts as $general_att ) {

										$general_att_array = $general_att->get_data();
										//var_dump($general_att_array);

										if ( true === $general_att_array['variation'] ) {
											continue;
										}
										
										if ( 1 === $general_att_array['is_taxonomy'] ) {
											$tax_att = get_taxonomy( $general_att_array['name'] );
											if ( ! empty( $tax_att ) ) {
												foreach ( $general_att_array['options'] as $general_att_value ) {
													$att_term = get_term($general_att_value);
													//var_dump($att_name);
													$atts .= "\n\t\t\t<param name=\"". $tax_att->labels->singular_name ."\">" . $att_term->name . "</param>";
												}
												
											}
										} else {
												$atts .= "\n\t\t\t<param name=\"". $general_att_array['name'] ."\">" . str_replace( ' | ', ', ', $general_att_array['value'] ) . "</param>";
										}
										
									}
								}

							}
							$title .= ")";
						}
						
						if ( $variation_obj ) {
							$stock = $variation_obj->get_stock_quantity();
						} else {
							$stock = '';
						}
						
						$products .= "\n\t\t<offer id=\"" . $variation['variation_id'] . "\" available=" . (( $variation['is_in_stock'] === true ) ? '"true"' : '"false"')  . ">";
						$products .= "\n\t\t\t<url>" . get_the_permalink() . "</url>";
						$products .= "\n\t\t\t<price>" . $variation['display_regular_price'] . "</price>";
						if ( ! empty( $variation['display_price'] ) && ( $variation['display_price'] < $variation['display_regular_price'] ) ) {
							$products .= "\n\t\t\t<price_promo>" . $variation['display_price'] . "</price_promo>";
						}
						$products .= "\n\t\t\t<currencyId>" . get_woocommerce_currency() . "</currencyId>";
						$products .= "\n\t\t\t<categoryId>" . $current_product_categories[0]->term_id . "</categoryId>"; //pulling the first term only
						//var_dump($variation['image']);
						
						//$pictures = array( 0 => $variation['image']['full_src'] );
						
						$pictures_xml = '';
				
						if ( ! empty( $pictures ) ){
							foreach ($pictures as $picture_id ) {
								$pic_src = wp_get_attachment_url( $picture_id );
								if ( $pic_src ) {
									$pictures_xml .= "\n\t\t\t<picture>" . $pic_src . "</picture>";
								}
							}
						}

						$products .= $pictures_xml; //pulling the first term only
						
						//$products .= "\n\t\t\t<picture>" . $variation['image']['url'] . "</picture>";
						$products .= "\n\t\t\t<name>" . $title . "</name>";
						$products .= "\n\t\t\t<stock_quantity>" . $stock . "</stock_quantity>"; //pulling the first term only
						$products .= "\n\t\t\t<description><![CDATA[" . get_post_meta($post->ID, 'itg_rztka_description', true) . "]]></description>"; //pulling the first term only
						$products .= $atts;
					}
				}
			}
		endwhile;
	}
	
	wp_reset_postdata();
	
	return array('product_cats' => $output_cats, 'products' => $products );
	
}


//for PHP < 7.3.0

if ( ! function_exists( 'array_key_last' ) ) {
    /**
     * Polyfill for array_key_last() function added in PHP 7.3.
     *
     * Get the last key of the given array without affecting
     * the internal array pointer.
     *
     * @param array $array An array
     *
     * @return mixed The last key of array if the array is not empty; NULL otherwise.
     */
    function array_key_last( $array ) {
        $key = NULL;

        if ( is_array( $array ) ) {

            end( $array );
            $key = key( $array );
        }

        return $key;
    }
}

add_action('admin_menu', 'itg_rztka_create_menu');

function itg_rztka_create_menu() {

	//create new top-level menu
	add_menu_page('IT Guild Plugins', 'IT Guild Plugins settings', 'administrator', __FILE__, 'itg_rztka_settings_page' );

	//call register settings function
	add_action( 'admin_init', 'register_itg_rztka_settings' );
}


function register_itg_rztka_settings() {
	register_setting( 'itg_rztka-settings-group', 'itg_rztka_shop_title' );
	register_setting( 'itg_rztka-settings-group', 'itg_rztka_shop_description' );
	register_setting( 'itg_rztka-settings-group', 'itg_rztka_shop_product_attributes' );
}


function itg_rztka_settings_page() {
?>
<div class="wrap">
<h1><?php esc_attr_e( 'IT Guild Rozetka.ua Feed settings', 'itg-rztka'); ?></h1>

<form method="post" action="options.php">
    <?php settings_fields( 'itg_rztka-settings-group' ); ?>
    <?php do_settings_sections( 'itg_rztka-settings-group' ); ?>
    <table class="form-table">
        <tr>
        <th scope="row"><?php esc_attr_e( 'Shop Title', 'itg-rztka'); ?></th>
        <td><input type="text" name="itg_rztka_shop_title" value="<?php echo get_option('itg_rztka_shop_title'); ?>" /></td>
        </tr>
        <tr>
        <th scope="row"><?php esc_attr_e( 'Shop Description', 'itg-rztka'); ?></th>
        <td><input type="text" name="itg_rztka_shop_description" value="<?php echo get_option('itg_rztka_shop_description'); ?>" /></td>
        </tr>
		<tr>
        <th scope="row"><?php esc_attr_e( 'Product attributes', 'itg-rztka'); ?></th>
        <td><input type="checkbox" id="itg_rztka_shop_product_attributes" name="itg_rztka_shop_product_attributes" value="1" <?php echo ( get_option( 'itg_rztka_shop_product_attributes' ) != 1 ) ? '0' : 'checked'; ?>/><label for="itg_rztka_shop_product_attributes" class="description"><?php esc_attr_e( 'Feed will use Woocommerce product attributes instead of those suggested in product metabox', 'itg-rztka' ); ?></label></td>
        </tr>
    </table>
    
    <?php submit_button(); ?>

</form>
</div>
<?php }
?>