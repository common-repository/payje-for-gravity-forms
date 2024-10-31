<?php
if ( !defined( 'ABSPATH' ) ) exit;

class PayJe_GF_Settings {

    private $id = 'payje_gf_settings';

    // Register hooks
    public function __construct() {

        add_action( 'admin_menu', array( $this, 'register_menu' ), 20 );

    }

    // Register admin menu
    public function register_menu() {

        add_submenu_page(
            'payje',
            __( 'PayJe – Gravity Forms Settings', 'payje-gf' ),
            __( 'Gravity Forms', 'payje-gf' ),
            'manage_options',
            $this->id,
            array( $this, 'view_page' )
        );

    }

    // Get the views of the settings page
    public function view_page() {

        $forms = GFAPI::get_forms();
        $feeds = GFAPI::get_feeds();

        $gateway = new PayJe_GF_Gateway();
        $gateway_slug = $gateway->get_slug();

        $form_edit_url = add_query_arg( 'page', 'gf_edit_forms', admin_url( 'admin.php' ) );

        $feed_edit_url = add_query_arg( array(
            'page'    => 'gf_edit_forms',
            'view'    => 'settings',
            'subview' => $gateway_slug,
        ), admin_url( 'admin.php' ) );

        $gateway_forms = array();

        foreach ( $forms as $form ) {
            $gateway_forms[ $form['id'] ] = array(
                'id'    => $form['id'],
                'title' => $form['title'],
            );
        }

        foreach ( $feeds as $feed ) {
            if ( isset( $feed['addon_slug'] ) && $feed['addon_slug'] == $gateway_slug ) {
                $gateway_forms[ $feed['form_id'] ]['feeds'][] = array(
                    'id'    => $feed['id'],
                    'title' => $feed['meta']['feedName'],
                );
            }
        }

        foreach ( $gateway_forms as $key => $form ) {
            if ( !isset( $form['feeds'] ) ) {
                unset( $gateway_forms[ $key ] );
            }
        }

        ob_start();
        require_once( PAYJE_GF_PATH . 'admin/views/settings.php' );

        echo ob_get_clean();

    }

}
new PayJe_GF_Settings();
