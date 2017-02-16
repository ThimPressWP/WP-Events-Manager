<?php

if ( !defined( 'ABSPATH' ) ) {
	exit();
}

class TP_Event_Admin_Setting_Emails extends TP_Event_Abstract_Setting {

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
		$this->id    = 'event_emails';
		$this->label = __( 'Emails', 'wp-event-manager' );
		parent::__construct();
	}

	/**
	 * Get options setting page
	 * @return type array
	 */
	public function get_settings() {
		$prefix = 'thimpress_events_';

		$register_event_mail = tp_event_get_option( 'email_enable' );

		return apply_filters( 'event_admin_setting_page_' . $this->id, array(
			array(
				'type'  => 'section_start',
				'id'    => 'email_settings',
				'title' => __( 'Email Notifications', 'wp-event-manager' ),
			),
			array(
				'type'    => 'yes_no',
				'title'   => __( 'Event register', 'wp-event-manager' ),
				'desc'    => __( 'Send notify when user register event', 'wp-event-manager' ),
				'id'      => $prefix . 'email_enable',
				'default' => 'yes'
			),
			array(
				'type'        => 'text',
				'title'       => __( 'From name', 'wp-event-manager' ),
				'placeholder' => get_option( 'blogname' ),
				'id'          => $prefix . 'email_from_name',
				'default'     => get_option( 'blog_name' ),
				'class'       => 'email-setting-form-name' . ( $register_event_mail == 'no' ? ' hide-if-js' : '' )
			),
			array(
				'type'        => 'email',
				'title'       => __( 'Email from', 'wp-event-manager' ),
				'placeholder' => get_option( 'admin_email' ),
				'id'          => $prefix . 'admin_email',
				'default'     => get_option( 'admin_email' ),
				'class'       => 'email-setting-email-form' . ( $register_event_mail == 'no' ? ' hide-if-js' : '' )
			),
			array(
				'type'        => 'text',
				'title'       => __( 'Subject', 'wp-event-manager' ),
				'placeholder' => __( 'Register event', 'wp-event-manager' ),
				'id'          => $prefix . 'email_subject',
				'default'     => '',
				'class'       => 'email-setting-subject' . ( $register_event_mail == 'no' ? ' hide-if-js' : '' )
			),
			array(
				'type'    => 'checkbox',
				'title'   => __( 'Account register', 'wp-event-manager' ),
				'desc'    => __( 'Send notify when user register account', 'wp-event-manager' ),
				'id'      => $prefix . 'register_notify',
				'default' => false
			),
			array(
				'type' => 'section_end',
				'id'   => 'email_settings'
			)
		) );
	}

}

return new TP_Event_Admin_Setting_Emails();
