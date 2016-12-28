<?php

defined( 'ABSPATH' ) || exit();

class Event_Admin_Metaboxes {

    public static function init() {
        add_action( 'add_meta_boxes', array( __CLASS__, 'add_meta_boxes' ), 0 );
        add_action( 'save_post', array( __CLASS__, 'save_post_meta' ) );
        add_action( 'admin_notices', array( __CLASS__, 'print_errors' ) );

        /**
         * Save post meta
         */
        add_action( 'event_process_update_tp_event_meta', array( 'Event_Admin_Metabox_Event', 'save' ), 10, 2 );
    }

    /**
     * Add meta boxes
     */
    public static function add_meta_boxes() {
        add_meta_box(
                'tp_event_setting_section', __( 'Event Settings', 'tp-event' ), array( 'Event_Admin_Metabox_Event', 'render' ), 'tp_event', 'normal', 'high'
        );
//        add_meta_box(
//                'tp_event_timing', __( 'Event Timing Period', 'tp-event' ), array( 'Event_Admin_Metabox_Event_Timing', 'render' ), 'tp_event', 'normal', 'high'
//        );
    }

    /**
     * Save post meta
     * @param type $post_id
     * @return boolean
     */
    public static function save_post_meta( $post_id ) {
        if ( empty( $_POST ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) {
            return false;
        }

        if ( empty( $_POST['event-nonce'] ) || !wp_verify_nonce( $_POST['event-nonce'], 'event_nonce' ) ) {
            return false;
        }

        $post_type = get_post_type( $post_id );
        if ( $post_type !== 'tp_event' ) {
            return false;
        }

        do_action( 'event_process_update_' . $post_type . '_meta', $post_id, $_POST );
    }

    /**
     * Add error message save post meta
     * @param type $message
     */
    public static function add_error( $message = '' ) {
        $error = get_option( 'tp_event_meta_box_error_messages', array() );
        $error[] = $message;
        update_option( 'tp_event_meta_box_error_messages', $error );
    }

    /**
     * Print notices error save post meta
     * @return type
     */
    public static function print_errors() {
        $errors = get_option( 'tp_event_meta_box_error_messages' );
        if ( !$errors ) {
            return;
        }
        echo '<div id="event_error" class="error notice is-dismissible">';

        foreach ( $errors as $error ) {
            echo '<p>' . wp_kses_post( $error ) . '</p>';
        }

        echo '</div>';
        delete_option( 'tp_event_meta_box_error_messages' );
    }

}

Event_Admin_Metaboxes::init();