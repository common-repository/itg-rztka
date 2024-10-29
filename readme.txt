=== IT Guild Rozetka.ua Woocommerce Integration ===
Contributors: itguild
Tags: rozetka, feed, rozetka.ua, woocommerce
Requires at least: 4.0
Tested up to: 5.2
Requires PHP: 5.4
Stable tag: 1.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Integrate your Woocommerce-based online store with Rozetka.ua marketplace within minutes


== Description ==

Easily create the product feed in order to integrate your Woocommerce online store with Rozetka.ua marketplace. This plugin will create the product feed structure as Required by Rozetka.ua out of products that you select.

= How to use =
* Install and activate
* Create a blank page with a permalink of your choice.
* Go to template settings of the newly created page and assign "Rozetka Feed" template to it. This page's permalink will be your feed URL.
* Go to the Woocommerce products that you want to add to the feed and in the 'Rozetka.ua integration' section check "Add this product into the XML feed for rozetka.ua" checkbox and fill out product properties as required by Rozetka.ua
* That's it all the products of your choice will reflect in the feed.

= Minimum Requirements =

* WordPress 4.5 or greater
* PHP version 5.4 or greater
* MySQL version 5.0 or greater

= Recommended requirements =

* PHP version 7.3 or greater
* MySQL version 5.6 or greater
* WP Memory limit of 64 MB or greater (128 MB or higher is preferred, depending on the amount of products in your store)


== Installation ==

1. Install using the WordPress built-in Plugin installer, or Extract the zip file and drop the contents in the `wp-content/plugins/` directory of your WordPress installation.
2. Activate the plugin through the 'Plugins' menu in WordPress.


== Changelog ==

= 1.2.0 - 2019-11-10 = 
* Implemented the possibility to use WC product attributes.
* Added internationalization.

= 1.1.0 - 2019-11-10 = 
* Added a settings page.
* Now users can chose whether they want feed item parameters to be taken from in-built suggested parameters or set from custom product attributes.
* Minor bug fixes.


= 1.0.3 - 2019-03-08 =
Fixed bug with incorrect vatiation stocks.

= 1.0.2 - 2019-02-08 =
* Added settings page with custom company title and description.
* Now plugin adds all puctures for simple products.
* Fixed bug with variable products not showing up.

= 1.0.1 - 2019-24-07 =
Fixed bug that prevented the <vendor> property to be changed.

= 1.0 - 2019-25-05 =
* New: Initial Beta Release
