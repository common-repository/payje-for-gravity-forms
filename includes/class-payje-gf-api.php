<?php
if ( !defined( 'ABSPATH' ) ) exit;

class PayJe_GF_API extends PayJe_API {

    // Log a message in Gravity Forms logs
    protected function log( $message ) {

        if ( $this->debug ) {
            payje_gf_logger( $message );
        }

    }

}
