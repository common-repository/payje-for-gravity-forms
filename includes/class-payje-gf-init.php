<?php
if ( !defined( 'ABSPATH' ) ) exit;

class PayJe_GF_Init {

    // Register hooks
    public function __construct() {

        add_action( 'gform_loaded', array( $this, 'load_dependencies' ), 5 );

    }

    // Load required files
    public function load_dependencies() {

        GFForms::include_payment_addon_framework();

        require_once( PAYJE_GF_PATH . 'includes/class-payje-gf-gateway.php' );

        GFAddOn::register( 'PayJe_GF_Gateway' );

    }

}
new PayJe_GF_Init();
