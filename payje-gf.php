<?php
/**
 * Plugin Name:       PayJe for Gravity Forms
 * Description:       PayJe payment integration for Gravity Forms.
 * Version:           1.0.0
 * Requires at least: 4.6
 * Requires PHP:      7.0
 * Author:            Edaran IT Services Sdn Bhd.
 * Author URI:        https://www.edaran.com/
 * License:           GPLv2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

if ( !defined( 'ABSPATH' ) ) exit;

if ( class_exists( 'PayJe_GF' ) ) return;

define( 'PAYJE_GF_FILE', __FILE__ );
define( 'PAYJE_GF_URL', plugin_dir_url( PAYJE_GF_FILE ) );
define( 'PAYJE_GF_PATH', plugin_dir_path( PAYJE_GF_FILE ) );
define( 'PAYJE_GF_BASENAME', plugin_basename( PAYJE_GF_FILE ) );
define( 'PAYJE_GF_VERSION', '1.0.0' );

// Plugin core class
require( PAYJE_GF_PATH . 'includes/class-payje-gf.php' );
