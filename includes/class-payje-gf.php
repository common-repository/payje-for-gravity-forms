<?php
if ( !defined( 'ABSPATH' ) ) exit;

class PayJe_GF {

    // Load dependencies
    public function __construct() {

        // Libraries
        require_once( PAYJE_GF_PATH . 'libraries/payje/class-payje.php' );

        // Functions
        require_once( PAYJE_GF_PATH . 'includes/functions.php' );

        // Admin
        require_once( PAYJE_GF_PATH . 'admin/class-payje-gf-admin.php' );

        if ( payje_is_logged_in() && payje_is_plugin_activated( 'gravityforms/gravityforms.php' ) ) {

            // API
            require_once( PAYJE_GF_PATH . 'includes/class-payje-gf-api.php' );

            // Initialize payment gateway
            require_once( PAYJE_GF_PATH . 'includes/class-payje-gf-init.php' );

            // Settings
            require_once( PAYJE_GF_PATH . 'admin/class-payje-gf-settings.php' );
        }

    }

}
new PayJe_GF();
