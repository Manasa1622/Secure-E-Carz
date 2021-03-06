<?php

/**
* Plugin Name:       Stripe Payments
* Description:       Easily accept credit card payments via Stripe payment gateway in WordPress.
* Version:           1.5.2
* Author:            Tips and Tricks HQ, wptipsntricks
* Author URI:        https://www.tipsandtricks-hq.com/
* Plugin URI:        https://www.tipsandtricks-hq.com/ecommerce/wordpress-stripe-plugin-accept-payments-using-stripe
* License:           GPLv2 or later
*/

//Slug - asp
//Textdomain - stripe-payments

// If this file is called directly, abort.
if (!defined('ABSPATH')) {
    exit; //Exit if accessed directly
}

define('WP_ASP_PLUGIN_VERSION','1.5.2');
define('WP_ASP_PLUGIN_URL', plugins_url('', __FILE__));


/* ----------------------------------------------------------------------------*
 * Public-Facing Functionality
 * ---------------------------------------------------------------------------- */

require_once( plugin_dir_path(__FILE__) . 'public/class-asp.php' );
require_once( plugin_dir_path(__FILE__) . 'public/includes/class-shortcode-asp.php' );
require_once( plugin_dir_path(__FILE__) . 'admin/includes/class-order.php' );
require_once( plugin_dir_path(__FILE__) . 'includes/stripe/lib/Stripe.php' );


/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 */

register_activation_hook(__FILE__, array('AcceptStripePayments', 'activate'));
register_deactivation_hook(__FILE__, array('AcceptStripePayments', 'deactivate'));

/*
 */
add_action('plugins_loaded', array('AcceptStripePayments', 'get_instance'));
add_action('plugins_loaded', array('AcceptStripePaymentsShortcode', 'get_instance'));

/* ----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 * ---------------------------------------------------------------------------- */

/*
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if (is_admin() && (!defined('DOING_AJAX') || !DOING_AJAX )) {

    require_once( plugin_dir_path(__FILE__) . 'admin/class-asp-admin.php' );
    add_action('plugins_loaded', array('AcceptStripePayments_Admin', 'get_instance'));
}

/* Add a link to the settings page in the plugins listing page */
function asp_stripe_add_settings_link($links, $file) {
    if ($file == plugin_basename(__FILE__)) {
        $settings_link = '<a href="options-general.php?page=accept_stripe_payment">Settings</a>';
        array_unshift($links, $settings_link);
    }
    return $links;
}

add_filter('plugin_action_links', 'asp_stripe_add_settings_link', 10, 2);