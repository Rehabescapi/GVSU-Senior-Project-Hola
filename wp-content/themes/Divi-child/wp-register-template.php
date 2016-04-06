


<div id='wpwa_custom_panel'>
    <?php
    if( isset($errors) && count($errors) > 0) {
        foreach ( $errors as $error ) {
            echo '<p class="wpwa_frm_error">' . $error . '</p>';
        }
    }
    ?>

    <form id='registration-form' method='post' action='<?php echo get_site_url() . '/user/register'; ?>'>
        <ul>
            <li>
                <label class='wpwa_frm_label'><?php echo __('Username','wpwa'); ?></label>
                <input class='wpwa_frm_field' type='text' id='wpwa_user' name='wpwa_user' value='<?php echo isset( $user_login ) ? $user_login : ''; ?>'  />
            </li>
            <li>
                <label class='wpwa_frm_label'><?php echo __('E-mail','wpwa'); ?></label>
                <input class='wpwa_frm_field' type='text' id='wpwa_email' name='wpwa_email' value='<?php echo isset( $user_email ) ? $user_email : ''; ?>' />
            </li>
            <li>
                <label class='wpwa_frm_label'><?php echo __('User Type','wpwa'); ?></label>
                <select class='wpwa_frm_field' name='wpwa_user_type'>
                    <option <?php echo (isset( $user_type ) && $user_type == 'follower') ? 'selected' : ''; ?> value='follower'><?php echo __('Follower','wpwa'); ?></option>
                    <option <?php echo (isset( $user_type ) && $user_type == 'developer') ? 'selected' : ''; ?> value='developer'><?php echo __('Developer','wpwa'); ?></option>
                    <option <?php echo (isset( $user_type ) && $user_type == 'member') ? 'selected' : ''; ?> value='member'><?php echo __('Member','wpwa'); ?></option>
                </select>
            </li>
            <li>
                <label class='wpwa_frm_label' for=''>&nbsp;</label>
                <input type='submit' value='<?php echo __('Register','wpwa'); ?>' />
            </li>
        </ul>
    </form>
</div>

