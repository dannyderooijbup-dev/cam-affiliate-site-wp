<?php
/**
 * The template for displaying the blog posts index
 *
 * @package BangaCams
 */

get_header(); ?>

<main id="primary" class="site-main py-12">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

		<!-- Page Header -->
		<div class="text-center mb-16">
			<h1 class="font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
				BangaCams <span class="bg-gradient-to-r from-bordeaux-500 to-bordeaux-300 bg-clip-text text-transparent">Gidsen & Nieuws</span>
			</h1>
			<p class="mx-auto mt-4 max-w-2xl text-sm text-zinc-400 font-light font-sans">
				Lees onze gidsen over privacy, live-cam technologieën, en reviews van platforms om het meeste uit je webcam-ervaring te halen.
			</p>
		</div>

		<!-- Blog posts list -->
		<?php if ( have_posts() ) : ?>
			<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
				<?php while ( have_posts() ) : the_post(); 
					$img_url = get_post_meta( get_the_ID(), 'blog_image_url', true );
					if ( has_post_thumbnail() ) {
						$img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					}
					$read_time = get_post_meta( get_the_ID(), 'blog_read_time', true );
					if (!$read_time) { $read_time = '5 min leestijd'; }
					$author = get_post_meta( get_the_ID(), 'blog_author', true );
					if (!$author) { $author = 'BangaCams Team'; }
				?>
					<!-- Blog Post Card -->
					<a href="<?php the_permalink(); ?>" class="group flex flex-col overflow-hidden rounded-2xl bg-zinc-900/40 border border-zinc-900 transition-all duration-300 hover:border-bordeaux-900/30">
						
						<div class="relative aspect-video overflow-hidden bg-zinc-950">
							<img 
								src="<?php echo esc_url($img_url); ?>" 
								alt="<?php the_title_attribute(); ?>"
								class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
								loading="lazy"
							>
						</div>

						<div class="flex flex-1 flex-col p-6">
							<div class="flex items-center space-x-3 text-[11px] font-semibold text-zinc-500 mb-3">
								<span class="text-bordeaux-400"><?php echo get_the_date(); ?></span>
								<span>•</span>
								<span><?php echo esc_html($read_time); ?></span>
							</div>

							<h3 class="font-display text-base font-bold text-white group-hover:text-bordeaux-400 transition-colors line-clamp-2">
								<?php the_title(); ?>
							</h3>

							<p class="mt-2 text-xs text-zinc-400 line-clamp-3 leading-relaxed font-sans font-light flex-1">
								<?php echo wp_strip_all_tags( get_the_excerpt() ); ?>
							</p>

							<div class="mt-4 pt-4 border-t border-zinc-900/60 flex items-center justify-between text-[11px] font-medium text-zinc-500">
								<span class="flex items-center space-x-1">
									<i data-lucide="user" class="h-3.5 w-3.5 text-zinc-600"></i>
									<span>By <?php echo esc_html($author); ?></span>
								</span>
								<span class="text-bordeaux-400 group-hover:text-bordeaux-300 font-bold flex items-center space-x-1">
									<span>Lees meer</span>
									<i data-lucide="arrow-right" class="h-3.5 w-3.5 transition-transform group-hover:translate-x-1"></i>
								</span>
							</div>
						</div>

					</a>
				<?php endwhile; ?>
			</div>

			<!-- Pagination -->
			<div class="mt-12 text-center">
				<?php
				echo paginate_links( array(
					'prev_text' => '<i data-lucide="chevron-left" class="h-4 w-4 inline-block"></i> Vorige',
					'next_text' => 'Volgende <i data-lucide="chevron-right" class="h-4 w-4 inline-block"></i>',
				) );
				?>
			</div>

		<?php else : ?>
			<p class="text-zinc-500 text-center">Geen artikelen gevonden.</p>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
