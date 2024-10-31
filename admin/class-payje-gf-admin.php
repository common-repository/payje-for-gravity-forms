<?php
if ( !defined( 'ABSPATH' ) ) exit;

class PayJe_GF_Admin {

    // Register hooks
    public function __construct() {

        add_action( 'plugin_action_links_' . PAYJE_GF_BASENAME, array( $this, 'register_settings_link' ) );
        add_action( 'admin_notices', array( $this, 'gravityforms_notice' ) );

    }

    // Register plugin settings link
    public function register_settings_link( $links ) {

        $url = admin_url( 'admin.php?page=payje' );
        $label = esc_html__( 'Settings', 'payje-gf' );

        $settings_link = sprintf( '<a href="%s">%s</a>', $url, $label );
        array_unshift( $links, $settings_link );

        return $links;

    }

    // Show notice if Gravity Forms not installed
    public function gravityforms_notice() {

        if ( !payje_is_plugin_activated( 'gravityforms/gravityforms.php' ) ) {
            payje_gf_notice( __( 'Gravity Forms needs to be installed and activated.', 'payje-gf' ), 'error' );
        }

    }

}
new PayJe_GF_Admin();
