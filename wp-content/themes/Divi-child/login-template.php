<?php
/*
Template Name: Login Template
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

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->

</div>
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

	</div> <!-- .container -->

<?php endif; ?>



<!-- #main-content -->

<?php get_footer(); ?>