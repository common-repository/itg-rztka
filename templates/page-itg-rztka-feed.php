<?php

if ( ! defined( 'ABSPATH' ) ) {
	die;
}

$cats_n_products = itg_rztka_get_cats_n_products();
header("Content-type: text/xml");
echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n"; ?>
<yml_catalog date="<?php echo gmdate('Y-m-d H:i', time() + 10800); ?>">
<shop>
	<name><?php echo get_option('itg_rztka_shop_title'); ?></name>
	<company><?php echo get_option('itg_rztka_shop_description'); ?></company>
	<url><?php echo get_bloginfo('url'); ?></url>
	<currencies>
		<currency rate="1" id="<?php echo get_woocommerce_currency(); ?>"/>
	</currencies>
	<categories>
	<?php echo $cats_n_products['product_cats']; ?></categories>
	<offers><?php echo $cats_n_products['products']; ?>
	
	</offers>
</shop>
</yml_catalog>