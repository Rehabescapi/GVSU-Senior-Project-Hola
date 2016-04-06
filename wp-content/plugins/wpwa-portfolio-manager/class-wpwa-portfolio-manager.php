<?php
/*
  Plugin Name: WPWA Portfolio Manager
  Plugin URI:
  Description: User management module for the portfolio management application.
  Author: Rakhitha Nimesh edited then by Jason Lehmann 
  Version: 1.0
  Author URI: http://www.innovativephp.com/
*/

require_once 'functions.php';

class WPWA_Portfolio_Manager {

    public function __construct() {
        // Creates all the user types
        register_activation_hook( __FILE__ , array( $this, 'add_application_user_roles' ) );
        // Remove unused user roles
        register_activation_hook( __FILE__, array( $this, 'remove_application_user_roles' ) );
        // Create custom capabilities for user roles
        register_activation_hook( __FILE__, array( $this, 'add_application_user_capabilities' ) );

        register_activation_hook( __FILE__, array( $this, 'flush_application_rewrite_rules' ) );

        add_action( 'template_redirect', array( $this, 'front_controller' ) );

        add_action( 'init', array( $this, 'manage_user_routes' ) );

        //add_action('wpwa_register_user', array($this, 'validate_user'));
        add_action( 'wpwa_register_user', array( $this, 'register_user' ) );
        add_action( 'wpwa_login_user', array( $this, 'login_user' ) );
        add_action( 'wpwa_activate_user', array( $this, 'activate_user' ) );
        add_filter( 'authenticate', array( $this, 'authenticate_user' ),30, 3 );

        add_filter( 'query_vars', array( $this, 'manage_user_routes_query_vars' ) );

        add_action( 'wp_enqueue_scripts', array( $this, 'generate_styles' ) );
    }

//    /*
//     * Add extra validation on user registration
//     *
//     * @param  -
//     * @return void
//     */
//    public function validate_user() {
//        remove_action('wpwa_register_user', array($this, 'register_user'));
//    }

    /*
     * Add new user roles to application on activation
     *
     * @param  -
     * @return void
    */

    public function add_application_user_roles() {
        add_role( 'follower', 'Follower', array( 'read' => true ) );
        add_role( 'developer', 'Developer', array( 'read' => true ) );
        add_role( 'member', 'Member', array( 'read' => true ) );
    }

    /*
     * Remove existing user roles from application on activation
     *
     * @param  -
     * @return void
    */

    public function remove_application_user_roles() {
        // remove_role( 'author' );
        // remove_role( 'editor' );
        // remove_role( 'contributor' );
        // remove_role( 'subscriber' );
    }

    /*
     * Add capabilities to user roles on activation
     *
     * @param  -
     * @return void
    */

    public function add_application_user_capabilities() {
        $role = get_role( 'follower' );
        $role->add_cap( 'follow_developer_activities' );
    }

    /*
     * Activate user account using the link
     *
     * @param  -
     * @return void
    */

    public function activate_user() {

        $activation_code = isset( $_GET['wpwa_activation_code'] ) ? $_GET['wpwa_activation_code'] : '';
        $message = '';

        // Get activation record for the user
        $user_query = new WP_User_Query(
                array(
                        'meta_key' => 'wpwa_activation_code',
                        'meta_value' => $activation_code
                )
        );

        $users = $user_query->get_results();

        // Check and update activation status
        if ( !empty($users) ) {
            $user_id = $users[0]->ID;
            update_user_meta( $user_id, 'wpwa_activation_status', 'active' );
            $message = __('Account activated successfully.','wpwa');
        } else {
            $message = __('Invalid Activation Code','wpwa');
        }

        include dirname(__FILE__) . '/templates/info-template.php';
        exit;
    }

    /*
     * Log the user into the system
     *
     * @param  -
     * @return void
    */
    public function login_user() {

        $errors = array();

        if ( $_POST ) {

            

            $username = isset ( $_POST['wpwa_username'] ) ? $_POST['wpwa_username'] : '';
            $password = isset ( $_POST['wpwa_password'] ) ? $_POST['wpwa_password'] : '';
            
            if ( empty( $username ) )
                array_push( $errors, __('Please enter a username.','wpwa') );

            if ( empty( $password ) )
                array_push( $errors, __('Please enter password.','wpwa') );


            if(count($errors) > 0){
                include dirname(__FILE__) . '/templates/login-template.php';
                exit;
            }

            $credentials = array();
            
            $credentials['user_login']      = $username;
            $credentials['user_login']      = sanitize_user( $credentials['user_login'] );
            $credentials['user_password']   = $password;
            $credentials['remember']        = false;

            $user = wp_signon( $credentials, false );

            if ( is_wp_error( $user ) ){
                array_push( $errors, $user->get_error_message() );

            }else{
                wp_redirect( home_url() );
                exit;
            }

        }

        if ( !is_user_logged_in() ) {

            include dirname(__FILE__) . '/templates/login-template.php';
        } else {
            wp_redirect( home_url() );
        }
        exit;
    }

    /*
     * Execute extra validations in user authentication
     *
     * @param  object  User
     * @param  string  Username of the authenticated user
     * @param  string  Password of the authenticated user
     * @return object  User Object or Error Object
    */
    public function authenticate_user( $user, $username, $password ) {
        if(! empty($username) && !is_wp_error($user)){
          $user = get_user_by('login', $username );

          if (!in_array( 'administrator', (array) $user->roles ) ) {
              $active_status = '';
              $active_status = get_user_meta( $user->data->ID, 'wpwa_activation_status', true );

              if ( 'inactive' == $active_status ) {
                  $user = new WP_Error( 'denied', __('<strong>ERROR</strong>: Please activate your account.','wpwa' ) );
              }
          }
        }
        return $user;
    }

    /*
     * Register new application user from frontend
     *
     * @param  -
     * @return void
    */

    public function register_user() {
        if ( $_POST ) {

            $errors = array();

            $user_login = ( isset ( $_POST['wpwa_user'] ) ? $_POST['wpwa_user'] : '' );
            $user_email = ( isset ( $_POST['wpwa_email'] ) ? $_POST['wpwa_email'] : '' );
            $user_type  = ( isset ( $_POST['wpwa_user_type'] ) ? $_POST['wpwa_user_type'] : '' );

            // Validating user data
            if ( empty( $user_login ) )
                array_push( $errors, __('Please enter a username.','wpwa') );

            if ( empty( $user_email ) )
                array_push( $errors, __('Please enter e-mail.','wpwa') );

            if ( empty( $user_type ) )
                array_push( $errors, __('Please enter user type.','wpwa') );


            $sanitized_user_login = sanitize_user( $user_login );

            if ( !empty($user_email) && !is_email( $user_email ) )
                array_push( $errors, __('Please enter valid email.','wpwa'));
            elseif ( email_exists( $user_email ) )
                array_push( $errors, __('User with this email already registered.','wpwa'));

            if ( empty( $sanitized_user_login ) || !validate_username( $user_login ) )
                array_push( $errors,  __('Invalid username.','wpwa') );
            elseif ( username_exists( $sanitized_user_login ) )
                array_push( $errors, __('Username already exists.','wpwa') );

            if ( empty( $errors ) ) {
                $user_pass  = wp_generate_password();
                $user_id    = wp_insert_user( array('user_login' => $sanitized_user_login,
                                                        'user_email' => $user_email,
                                                        'role' => $user_type,
                                                        'user_pass' => $user_pass)
                                            );


                if ( !$user_id ) {
                    array_push( $errors, __('Registration failed.','wpwa') );
                } else {
                    $activation_code = $this->random_string();

                    update_user_meta( $user_id, 'wpwa_activation_code', $activation_code );
                    update_user_meta( $user_id, 'wpwa_activation_status', 'inactive' );
                    wp_new_user_notification( $user_id, $user_pass, $activation_code );

                    $success_message = __('Registration completed successfully. Please check your email for activation link.','wpwa');
                }

                if ( !is_user_logged_in() ) {
                    include dirname(__FILE__) . '/templates/login-template.php';
                    exit;
                }
            }
        }
        if ( !is_user_logged_in() ) {
            include dirname(__FILE__) . '/templates/register-template.php';
            exit;
        }
    }

    /*
     * Front controller for handling custom routing
     *
     * @param  -
     * @return void
    */

    public function front_controller() {
        global $wp_query;
        $control_action = isset ( $wp_query->query_vars['control_action'] ) ? $wp_query->query_vars['control_action'] : '';

        switch ( $control_action ) {
            case 'register':
                do_action( 'wpwa_register_user' );
                break;

            case 'login':                
                do_action( 'wpwa_login_user' );
                break;

            case 'activate':
                do_action( 'wpwa_activate_user' );
                break;

            default:
                break;
        }
    }

    /*
     * Add custom routinng rules
     *
     * @param  -
     * @return void
    */

    public function manage_user_routes() {

        add_rewrite_rule( '^user/([^/]+)/?', 'index.php?control_action=$matches[1]', 'top' );
    }

    /*
     * Flush and rest application rewrite rules on activation
     *
     * @param  -
     * @return void
    */

    public function flush_application_rewrite_rules() {
        $this->manage_user_routes();
        flush_rewrite_rules();
    }

    /*
     * Add custom query variables to WordPress
     *
     * @param  array  List of built-in query variables of WordPress
     * @return void
    */

    public function manage_user_routes_query_vars( $query_vars ) {
        $query_vars[] = 'control_action';
        return $query_vars;
    }

    /*
     * Generate random string for activation code
     *
     * @param  -
     * @return string
    */
    public function random_string() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstr = '';
        for ( $i = 0; $i < 15; $i++ ) {
            $randstr .= $characters[rand(0, strlen( $characters ))];
        }
        return $randstr;
    }

    /*
     * Include neccessary styles for the plugin
     *
     * @param  -  
     * @return void
    */
    public function generate_styles() {
        wp_register_style( 'wpwa_styles', plugins_url( 'css/style.css', __FILE__ ) );
        wp_enqueue_style( 'wpwa_styles' );
    }

}

$wpwa_portfolio_manager = new WPWA_Portfolio_Manager();