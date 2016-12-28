<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class Event_Autoloader {

    /**
     * Path to the includes directory
     * @var string
     */
    private $include_path = '';

    /**
     * The Constructor
     */
    public function __construct() {
        if ( function_exists( "__autoload" ) ) {
            spl_autoload_register( "__autoload" );
        }

        spl_autoload_register( array( $this, 'autoload' ) );

        $this->include_path = untrailingslashit( TP_EVENT_PATH ) . '/inc/';
    }

    /**
     * Take a class name and turn it into a file name
     * @param  string $class
     * @return string
     */
    private function get_file_name_from_class( $class ) {
        return 'class-' . str_replace( '_', '-', strtolower( $class ) ) . '.php';
    }

    /**
     * Include a class file
     * @param  string $path
     * @return bool successful or not
     */
    private function load_file( $path ) {
        if ( $path && is_readable( $path ) ) {
            include_once( $path );
            return true;
        }
        return false;
    }

    /**
     * Auto-load HB classes on demand to reduce memory consumption.
     *
     * @param string $class
     */
    public function autoload( $class ) {
        $class = strtolower( $class );
        $file  = $this->get_file_name_from_class( $class );
        $path  = $this->include_path;

        // payment gateways
        if ( strpos( $class, 'event_abstract' ) === 0 ) {
            $path = $this->include_path . 'abstracts/';
        }

        // widgets
        if ( stripos( $class, 'event_widget_' ) === 0 ) {
            $path = $this->include_path . '/widgets/';
        } else if ( stripos( $class, 'event_shortcode_' ) === 0 ) {
            $path = $this->include_path . '/shortcodes/';
        }

        // admin metaboxs
        if ( strpos( $class, 'event_admin_metabox_' ) === 0 ) {
            $path = $this->include_path . 'admin/metaboxes/';
        } else if ( strpos( $class, 'event_admin_' ) === 0 ) {
            $path = $this->include_path . 'admin/';
        }

        $this->load_file( $path . $file );
    }
}

new Event_Autoloader();