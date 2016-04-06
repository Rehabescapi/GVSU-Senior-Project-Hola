<?php
/*
Template Name: Register Template
*/

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() ); ?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif; ?>

					<div class="entry-content">
					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

					</div> <!-- #content-area -->



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








</div>

	</div> <!-- .container -->

<?php endif; ?>



<!-- #main-content -->

<?php get_footer(); ?>