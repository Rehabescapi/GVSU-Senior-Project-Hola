<?php


/*
 *  Overriden version of wp_new_user_notification function
 *  for sending activation code
*/

if ( !function_exists( 'wp_new_user_notification' ) ) {

    function wp_new_user_notification($user_id, $plaintext_pass = '', $activate_code = '') {

        $user = new WP_User($user_id);

        $user_login = stripslashes($user->user_login);
        $user_email = stripslashes($user->user_email);

        $message = sprintf(__('New user registration on %s:','wpwa'), get_option('blogname')) . "\r\n\r\n";
        $message .= sprintf(__('Username: %s','wpwa'), $user_login) . "\r\n\r\n";
        $message .= sprintf(__('E-mail: %s','wpwa'), $user_email) . "\r\n";

        @wp_mail(get_option('admin_email'), sprintf(__('[%s] New User Registration','wpwa'), get_option('blogname')), $message);

        if (empty($plaintext_pass))
            return;
        
        $activate_link = site_url() . "/user/activate/?wpwa_activation_code=$activate_code";
        
        $message = __('Hi there,') . "\r\n\r\n";
        $message .= sprintf(__('Welcome to %s! Please activate your account using the link:','wpwa'), get_option('blogname')) . "\r\n\r\n";
        $message .=  sprintf(__('<a href="%s">%s</a>','wpwa'), $activate_link, $activate_link) . '\r\n';
        $message .= sprintf(__('Username: %s','wpwa'), $user_login) . "\r\n";
        $message .= sprintf(__('Password: %s','wpwa'), $plaintext_pass) . "\r\n\r\n";
        

        wp_mail($user_email, sprintf(__('[%s] Your username and password','wpwa'), get_option('blogname')), $message);
        
       

    }

}
  ?>