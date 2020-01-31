<?php
if ( ! defined( 'ABSPATH' ) ) exit;

class td_instagram_access_tk {

	private static $instance = null;

	public static function get_instance(){
		if ( is_null(self::$instance) ) {
			self::$instance = new td_instagram_access_tk();
		}
		return self::$instance;
	}

	public function __construct() {

		if( is_admin() ) {
			add_action( 'wp_ajax_td_after_connection', array( $this, 'td_after_connection' ) );
			add_action( 'wp_ajax_td_save_account', array( $this, 'td_save_account' ) );
			add_action( 'wp_ajax_td_remove_account', array( $this, 'td_remove_account' ) );
		}
	}

	function td_after_connection() {

		$reply = array(
			'status' => '',
			'account_data' => array(),
		);

		if ( isset( $_POST['access_token'] ) ) {

			$access_token = sanitize_text_field( $_POST['access_token'] );
			$account_data = $this->td_account_data_for_token( $access_token );

			if ( isset( $account_data['error_message'] ) ) {
				$reply['status'] = 'error - ' . $account_data['error_message'];
			} elseif ( $account_data !== false ) {
				$reply['status'] = 'success - ' . $account_data['username'] . ' account was successfully proccessed!';
				$reply['account_data'] = $account_data;
			} else {
				$reply['status'] = 'error - a successful connection could not be made.!';
			}
		}  else {
			$reply['status'] = 'error - no access_token provided!';
		}

		die(json_encode($reply));
	}

	function td_remove_account() {

		$reply = array(
			'status' => '',
		);

		if ( isset( $_POST['account_id'] ) ) {

			$options = td_options::get_array('td_instagram_connected_account');
			if ( !empty( $options ) ) {

				if ( $_POST['account_id'] === $options['connected_account']['user_id'] ){
					td_options::update_array('td_instagram_connected_account', array());
					$reply['status'] = 'success - ' . $_POST['account_username'] . ' account deleted!';
				} else {
					$reply['status'] = 'warning - no connected account found with the given user id!';
				}
				
			} else {
				$reply['status'] = 'warning - no connected account found!';
			}
		} else {
			$reply['status'] = 'error - no account id provided!';
		}
		
		die(json_encode($reply));
	}

	function td_account_data_for_token( $access_token ) {

		//date_default_timezone_set('Europe/Bucharest');

		$return = array(
			'id' => false,
			'username' => false,
			'is_valid' => false,
			'last_checked' => date('m/d/Y H:i:s', time() )
		);

		$url = 'https://api.instagram.com/v1/users/self/?access_token=' . $this->td_maybe_clean( $access_token );
		$args = array(
			'timeout' => 60,
			'sslverify' => false
		);
		$result = wp_remote_get( $url, $args );

		if ( ! is_wp_error( $result ) ) {
			$data = json_decode( $result['body'] );
		} else {
			$data = array();
		}

		if ( isset( $data->data->id ) ) {
			$return['id'] = $data->data->id;
			$return['username'] = $data->data->username;
			$return['is_valid'] = true;
			$return['profile_picture'] = $data->data->profile_picture;
			$return['followers'] = $data->data->counts->followed_by;

		} elseif ( isset( $data->error_type ) && $data->error_type === 'OAuthRateLimitException' ) {
			$return['error_message'] = 'This account\'s access token is currently over the rate limit. Try removing this access token from all feeds and wait an hour before reconnecting.';
		} else {
			$return = false;
		}

		return $return;
	}

	function td_maybe_clean( $maybe_dirty ) {
		if ( substr_count ( $maybe_dirty , '.' ) < 3 ) {
			return $maybe_dirty;
		}

		$parts = explode( '.', trim( $maybe_dirty ) );
		$last_part = $parts[2] . $parts[3];
		$cleaned = $parts[0] . '.' . base64_decode( $parts[1] ) . '.' . base64_decode( $last_part );

		return $cleaned;
	}

	function td_save_account() {

		$reply = array(
			'status' => '',
			'account_data' => array(),
		);

		if ( current_user_can( 'edit_posts' ) ) {

			$options = td_options::get_array('td_instagram_connected_account');

			$new_access_token = isset( $_POST['access_token'] ) ? sanitize_text_field( $_POST['access_token'] ) : false;
			$test_connection_data = $this->td_account_data_for_token( $new_access_token );

			if ( isset( $test_connection_data['error_message'] ) ) {

				$reply['status'] = 'error - ' . $test_connection_data['error_message'];

			} elseif ( $test_connection_data !== false ) {
				$options['connected_account'] = array(
					'access_token' => $this->td_get_parts( $new_access_token ),
					'user_id' => $test_connection_data['id'],
					'username' => $test_connection_data['username'],
					'is_valid' => $test_connection_data['is_valid'],
					'last_checked' => $test_connection_data['last_checked'],
					'profile_picture' => $test_connection_data['profile_picture'],
					'followers' => $test_connection_data['followers']
				);

				td_options::update_array('td_instagram_connected_account', $options);
				
				$reply['status'] = 'success - ' . $test_connection_data['username'] . ' account was successfully connected!';
				$reply['account_data'] = $options['connected_account'];
				
			} else {
				
				$reply['status'] = 'error - a successful connection could not be made.!';
				
			}
			
		} else {
			$reply['status'] = 'error - user doesn\'t have admin rights!';
		}
		
		die( json_encode($reply) );
	}

	function td_get_parts( $whole ) {
		if ( substr_count ( $whole , '.' ) !== 2 ) {
			return $whole;
		}

		$parts = explode( '.', trim( $whole ) );
		$return = $parts[0] . '.' . base64_encode( $parts[1] ). '.' . base64_encode( $parts[2] );

		return substr( $return, 0, 40 ) . '.' . substr( $return, 40, 100 );
	}
}

td_instagram_access_tk::get_instance();