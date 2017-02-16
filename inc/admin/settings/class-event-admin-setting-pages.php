<?php
/*
 * @author leehld
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit;

class TP_Event_Admin_Setting_Pages extends TP_Event_Abstract_Setting {

	/**
	 * ID
	 * @var type mixed
	 */
	public $id = null;

	/**
	 * Title
	 * @var type string
	 */
	public $label = null;

	public function __construct() {
		$this->id    = 'event_pages';
		$this->label = __( 'Pages', 'wp-event-manager' );
		add_action( 'event_admin_setting_update_' . $this->id, array( $this, 'save' ) );
		parent::__construct();
	}


	public function save() {
		parent::save();
	}

	/**
	 * Get options setting page
	 * @return type array
	 */
	public function get_settings() {
		$prefix = 'thimpress_events_';
		return apply_filters( 'event_admin_setting_page_' . $this->id, array(
			array(
				'type'  => 'section_start',
				'id'    => 'pages_settings',
				'title' => __( 'Pages Settings', 'wp-event-manager' ),
			),
			array(
				'type'  => 'select_page',
				'title' => __( 'Register Page', 'wp-event-manager' ),
				'desc'  => __( 'This controls which the register page', 'wp-event-manager' ),
				'id'    => $prefix . 'register_page_id',
			),
			array(
				'type'  => 'select_page',
				'title' => __( 'Login Page', 'wp-event-manager' ),
				'desc'  => __( 'This controls which the login page', 'wp-event-manager' ),
				'id'    => $prefix . 'login_page_id',
			),
			array(
				'type'  => 'select_page',
				'title' => __( 'Forgot Password', 'wp-event-manager' ),
				'desc'  => __( 'This controls which the forgot password page', 'wp-event-manager' ),
				'id'    => $prefix . 'forgot_password_page_id',
			),
			array(
				'type'  => 'select_page',
				'title' => __( 'Reset Password', 'wp-event-manager' ),
				'desc'  => __( 'This controls which the reset password page', 'wp-event-manager' ),
				'id'    => $prefix . 'reset_password_page_id',
			),
			array(
				'type'  => 'select_page',
				'title' => __( 'My Account', 'wp-event-manager' ),
				'desc'  => __( 'This controls which the user account page', 'wp-event-manager' ),
				'id'    => $prefix . 'account_page_id',
			),
			array(
				'type' => 'section_end',
				'id'   => 'pages_settings'
			)
		) );
	}

}

return new TP_Event_Admin_Setting_Pages();
