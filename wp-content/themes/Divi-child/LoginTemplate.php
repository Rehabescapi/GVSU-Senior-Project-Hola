<?php /* Template Name : LoginV1 */ ?>

<?php get_header(); ?>

<div id='wpwa_custom_panel'>
    <?php

    if ( isset($errors) && count($errors) > 0) {
        foreach ( $errors as $error ) {
            echo '<p class="wpwa_frm_error">'.$error .'</p>';
        }
    }


    if( isset( $success_message ) && $success_message != ""){
        echo '<p class="wpwa_frm_success">' . $success_message . '</p>';
    }

    ?>
    <form method='post' action='<?php echo site_url(); ?>/user/login' id='wpwa_login_form' name='wpwa_login_form'>
        <ul>
            <li>
                <label class='wpwa_frm_label' for='username'><?php echo __('Username','wpwa'); ?></label>
                <input class='wpwa_frm_field' type='text'  name='wpwa_username' value='<?php echo isset( $username ) ? $username : ''; ?>' />
            </li>
            <li>
                <label class='wpwa_frm_label' for='password'><?php echo __('Password','wpwa'); ?></label>
                <input class='wpwa_frm_field' type='password' name='wpwa_password' value="" />
            </li>
            <li>
                <label class='wpwa_frm_label' >&nbsp;</label>
                <input  type='submit'  name='submit' value='<?php echo __('Login','wpwa'); ?>' />
            </li>
        </ul>
    </form>
</div>
<?php get_footer(); ?>
