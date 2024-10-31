<?php
if ( !defined( 'ABSPATH' ) ) exit;

// Display notice
function payje_gf_notice( $message, $type = 'success' ) {

    $plugin = esc_html__( 'PayJe for Gravity Forms', 'payje-gf' );

    printf( '<div class="notice notice-%1$s"><p><strong>%2$s:</strong> %3$s</p></div>', esc_attr( $type ), $plugin, $message );

}

// Log a message in Gravity Forms logs
function payje_gf_logger( $message ) {

    do_action( 'logger', $message );


    // if ( class_exists( 'GFLogging' ) && class_exists( 'KLogger' ) ) {
    //     GFLogging::include_logger();
    //     GFLogging::log_message( 'gravityformspayje', $message, KLogger::DEBUG );
    // }

}

// Get approved businesses from PayJe
function payje_gf_get_businesses() {

    if ( !class_exists( 'PayJe_GF_API' ) ) {
        return false;
    }

    try {

        $payje = new PayJe_GF_API();
        $payje->set_access_token( payje_get_access_token() );

        list( $code, $response ) = $payje->get_approved_businesses();

        $data = isset( $response['data'] ) ? $response['data'] : false;

        $businesses = array();

        if ( is_array( $data ) ) {

            foreach ( $data as $item ) {

                $business_id = isset( $item['id'] ) ? sanitize_text_field( $item['id'] ) : null;

                if ( !$business_id ) {
                    continue;
                }

                $businesses[ $business_id ] = array(
                    'id'             => $business_id,
                    'name'           => isset( $item['name'] ) ? sanitize_text_field( $item['name'] ) : null,
                    'integration_id' => isset( $item['integration']['id'] ) ? sanitize_text_field( $item['integration']['id'] ) : null,
                    'api_key'        => isset( $item['integration']['api_key'] ) ? sanitize_text_field( $item['integration']['api_key'] ) : null,
                    'signature_key'  => isset( $item['integration']['signature_key'] ) ? sanitize_text_field( $item['integration']['signature_key'] ) : null,
                );
            }
        }

        return $businesses;

    } catch ( Exception $e ) {
        return false;
    }

}

// Get business information from PayJe by its ID
function payje_gf_get_business( $business_id ) {
    $businesses = payje_gf_get_businesses();
    return isset( $businesses[ $business_id ] ) ? $businesses[ $business_id ] : false;
}
