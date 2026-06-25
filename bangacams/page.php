<?php
/**
 * The template for displaying all pages
 *
 * @package BangaCams
 */

get_header(); ?>

<main id="primary" class="site-main py-12">
	<div class="mx-auto max-w-4xl px-4 sm:px-6">

		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<!-- Page Title Header -->
				<header class="entry-header border-b border-zinc-900 pb-6 mb-8 text-center sm:text-left">
					<h1 class="font-display text-3xl sm:text-4xl font-extrabold text-white tracking-tight">
						<?php the_title(); ?>
					</h1>
				</header>

				<!-- Entry Content -->
				<div class="entry-content prose prose-invert max-w-none text-zinc-300 font-light leading-relaxed text-sm sm:text-base">
					<?php
					the_content();

					wp_link_pages( array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'bangacams' ),
						'after'  => '</div>',
					) );
					?>
				</div>

			</article>
		<?php endwhile; ?>

	</div>
</main>

<?php
get_footer();
