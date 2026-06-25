<?php
/**
 * The template for displaying a single Cam Model profile
 *
 * @package BangaCams
 */

get_header();

$rating = get_post_meta( get_the_ID(), 'model_rating', true );
$img_url = get_post_meta( get_the_ID(), 'model_image_url', true );
if ( has_post_thumbnail() ) {
	$img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
}
$platform = get_post_meta( get_the_ID(), 'model_platform', true );
$aff_url = get_post_meta( get_the_ID(), 'model_affiliate_url', true );
if ( empty($aff_url) && function_exists('bangacams_get_dynamic_aff_url') ) {
	$aff_url = bangacams_get_dynamic_aff_url( get_the_title(), $platform );
}
$is_online = get_post_meta( get_the_ID(), 'model_is_online', true ) === 'yes';
$viewers = get_post_meta( get_the_ID(), 'model_viewers', true );
$age = get_post_meta( get_the_ID(), 'model_age', true );
$country = get_post_meta( get_the_ID(), 'model_country', true );
$languages = get_post_meta( get_the_ID(), 'model_languages', true );

$cats = get_the_terms( get_the_ID(), 'model_category' );
$cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : 'Live Cam';
$cat_slug = ($cats && !is_wp_error($cats)) ? $cats[0]->slug : '';
?>

<main id="primary" class="site-main py-12">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

		<!-- Breadcrumb / Back button -->
		<div class="mb-8">
			<a 
				href="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" 
				class="inline-flex items-center space-x-1.5 text-xs text-zinc-500 hover:text-zinc-300 font-bold transition-colors"
			>
				<i data-lucide="chevron-left" class="h-4 w-4"></i>
				<span>Terug naar alle live cams</span>
			</a>
		</div>

		<!-- Main Profile Layout Split -->
		<div class="grid gap-10 lg:grid-cols-12 bg-zinc-900/10 rounded-3xl border border-zinc-900 p-6 sm:p-8">
			
			<!-- Left column: Portrait Image & Watch CTAs -->
			<div class="lg:col-span-5 flex flex-col gap-6">
				
				<div class="relative aspect-[3/4] w-full overflow-hidden rounded-2xl bg-zinc-950 border border-zinc-850">
					<img 
						src="<?php echo esc_url( $img_url ); ?>" 
						alt="<?php the_title_attribute(); ?>" 
						class="h-full w-full object-cover"
					>
					<div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent"></div>

					<!-- Floating Online badge -->
					<div class="absolute top-4 left-4 flex items-center space-x-1.5 rounded-full bg-zinc-950/85 px-3 py-1.5 text-xs font-bold text-white backdrop-blur-md">
						<?php if ( $is_online ) : ?>
							<span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
							<span>LIVE SHOW (<?php echo number_format($viewers); ?>)</span>
						<?php else : ?>
							<span class="h-2 w-2 rounded-full bg-zinc-500"></span>
							<span>OFFLINE PROFILE</span>
						<?php endif; ?>
					</div>

					<!-- Floating Rating badge -->
					<div class="absolute top-4 right-4 flex items-center space-x-1 rounded-full bg-zinc-950/85 px-3 py-1.5 text-xs font-bold text-yellow-500 backdrop-blur-md">
						<i data-lucide="star" class="h-3 w-3 fill-current text-yellow-500"></i>
						<span><?php echo esc_html( $rating ); ?> Rating</span>
					</div>

					<!-- Category indicator overlay -->
					<div class="absolute bottom-4 left-4 rounded-lg bg-bordeaux-800/90 border border-bordeaux-700/30 px-3 py-1 text-[10px] font-bold text-white uppercase tracking-wider">
						<?php echo esc_html( $cat_name ); ?>
					</div>
				</div>

				<!-- Direct Watch Live CTA -->
				<div class="space-y-3">
					<a 
						href="<?php echo esc_url( $aff_url ); ?>" 
						target="_blank" 
						rel="noopener noreferrer" 
						class="affiliate-btn flex w-full items-center justify-center space-x-2.5 rounded-2xl bg-gradient-to-r from-bordeaux-800 via-bordeaux-700 to-bordeaux-600 hover:from-bordeaux-700 hover:to-bordeaux-500 py-4.5 text-center text-sm font-bold text-white shadow-lg shadow-bordeaux-950/50 transition-all hover:scale-[1.01]"
					>
						<span>Open Live Show op <?php echo esc_html( $platform ); ?></span>
						<i data-lucide="arrow-up-right" class="h-4 w-4"></i>
					</a>
					<p class="text-[10px] text-center text-zinc-600 font-light leading-relaxed">
						* Je wordt doorgestuurd naar het geverifieerde cam-platform om deze stream veilig en discreet te bekijken.
					</p>
				</div>

			</div>


			<!-- Right column: Bio description & parameters -->
			<div class="lg:col-span-7 flex flex-col justify-between">
				
				<div>
					
					<!-- Header meta -->
					<div class="flex items-center space-x-3 flex-wrap gap-y-2 mb-4">
						<h1 class="font-display text-3xl sm:text-4xl font-extrabold tracking-tight text-white">
							<?php the_title(); ?>
						</h1>
						
						<!-- Active checkmark badge -->
						<div class="flex items-center space-x-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/20 px-3 py-1 text-xs font-bold text-emerald-400">
							<i data-lucide="shield-check" class="h-3.5 w-3.5"></i>
							<span>Geverifieerd Model</span>
						</div>
					</div>

					<!-- Interactive Platform metadata banner -->
					<div class="flex items-center space-x-2 rounded-xl bg-zinc-950 p-4 border border-zinc-900 mb-6">
						<i data-lucide="tv" class="h-5 w-5 text-bordeaux-600"></i>
						<span class="text-xs text-zinc-400 font-light">
							Streamt momenteel live shows via partnernetwerk: <strong class="text-zinc-200 font-bold uppercase"><?php echo esc_html( $platform ); ?></strong>
						</span>
					</div>

					<!-- Biography / Content -->
					<div class="prose prose-invert prose-sm max-w-none mb-8 text-zinc-300 font-light leading-relaxed">
						<h2 class="text-xs font-bold uppercase tracking-widest text-zinc-500 mb-2">Over <?php the_title(); ?></h2>
						<?php the_content(); ?>
					</div>

					<!-- Detailed Specs parameters grid -->
					<div class="grid grid-cols-2 gap-4 bg-zinc-950/40 p-5 rounded-2xl border border-zinc-900 mb-8">
						<div>
							<span class="text-[10px] font-bold text-zinc-600 uppercase tracking-wider block">Leeftijd</span>
							<span class="text-xs font-bold text-zinc-300 mt-0.5 block"><?php echo esc_html( $age ); ?> jaar oud</span>
						</div>
						<div>
							<span class="text-[10px] font-bold text-zinc-600 uppercase tracking-wider block">Land</span>
							<span class="text-xs font-bold text-zinc-300 mt-0.5 block"><?php echo esc_html( $country ); ?></span>
						</div>
						<div>
							<span class="text-[10px] font-bold text-zinc-600 uppercase tracking-wider block">Talen</span>
							<span class="text-xs font-bold text-zinc-300 mt-0.5 block"><?php echo esc_html( $languages ); ?></span>
						</div>
						<div>
							<span class="text-[10px] font-bold text-zinc-600 uppercase tracking-wider block">Hoofdplatform</span>
							<span class="text-xs font-bold text-zinc-300 mt-0.5 block text-bordeaux-400"><?php echo esc_html( $platform ); ?></span>
						</div>
					</div>

					<!-- Tags list -->
					<?php
					$tags = get_the_terms( get_the_ID(), 'model_tag' );
					if ( $tags && ! is_wp_error( $tags ) ) : ?>
						<div>
							<h3 class="text-[10px] font-bold uppercase tracking-wider text-zinc-600 mb-2.5">Specificaties & Kenmerken</h3>
							<div class="flex flex-wrap gap-2">
								<?php foreach ( $tags as $tag ) : ?>
									<span class="rounded-lg bg-zinc-950 border border-zinc-850 px-3 py-1.5 text-xs text-zinc-400 font-medium hover:border-bordeaux-800/30 hover:text-zinc-200 transition-colors">
										# <?php echo esc_html( $tag->name ); ?>
									</span>
								<?php endforeach; ?>
							</div>
						</div>
					<?php endif; ?>

				</div>

			</div>

		</div>


		<!-- Secondary CTA section: "More Models Like This" -->
		<div id="more-models-section" class="mt-16">
			
			<div class="flex items-center space-x-2 border-b border-zinc-900 pb-4 mb-8">
				<i data-lucide="heart" class="h-6 w-6 text-bordeaux-500 fill-current"></i>
				<h2 class="font-display text-2xl font-bold text-white tracking-tight">
					More Models Like This
				</h2>
			</div>

			<!-- Query related models -->
			<?php
			$related_query = new WP_Query( array(
				'post_type'      => 'cam_model',
				'posts_per_page' => 4,
				'post__not_in'   => array( get_the_ID() ),
				'tax_query'      => array(
					array(
						'taxonomy' => 'model_category',
						'field'    => 'slug',
						'terms'    => $cat_slug
					)
				)
			) );

			if ( $related_query->have_posts() ) : ?>
				<div class="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
					<?php while ( $related_query->have_posts() ) : $related_query->the_post(); 
						$r_rating = get_post_meta( get_the_ID(), 'model_rating', true );
						$r_img_url = get_post_meta( get_the_ID(), 'model_image_url', true );
						if ( has_post_thumbnail() ) {
							$r_img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
						}
						$r_aff_url = get_post_meta( get_the_ID(), 'model_affiliate_url', true );
						$r_is_online = get_post_meta( get_the_ID(), 'model_is_online', true ) === 'yes';
						$r_viewers = get_post_meta( get_the_ID(), 'model_viewers', true );
						$r_platform = get_post_meta( get_the_ID(), 'model_platform', true );
						$r_age = get_post_meta( get_the_ID(), 'model_age', true );
						$r_country = get_post_meta( get_the_ID(), 'model_country', true );
						
						$r_cats = get_the_terms( get_the_ID(), 'model_category' );
						$r_cat_name = ($r_cats && !is_wp_error($r_cats)) ? $r_cats[0]->name : 'Live Cam';
					?>
						<!-- Related Model Card -->
						<div class="group relative flex flex-col overflow-hidden rounded-2xl bg-zinc-900 border border-zinc-900 transition-all duration-300 hover:border-bordeaux-800/40 hover:shadow-lg hover:shadow-bordeaux-950/20">
							
							<div class="relative aspect-[3/4] overflow-hidden bg-zinc-950">
								<img 
									src="<?php echo esc_url( $r_img_url ); ?>" 
									alt="<?php the_title_attribute(); ?>"
									class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
									loading="lazy"
								>
								<div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent"></div>

								<!-- Online status -->
								<div class="absolute top-2.5 left-2.5 flex items-center space-x-1.5 rounded-full bg-zinc-950/70 px-2 py-1 text-[9px] font-bold text-white backdrop-blur-md">
									<?php if ( $r_is_online ) : ?>
										<span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
										<span>LIVE (<?php echo number_format($r_viewers); ?>)</span>
									<?php else : ?>
										<span class="h-2 w-2 rounded-full bg-zinc-500"></span>
										<span>OFFLINE</span>
									<?php endif; ?>
								</div>

								<!-- Platform Badge -->
								<div class="absolute bottom-2.5 left-2.5 rounded bg-bordeaux-800/80 px-1.5 py-0.5 text-[8px] font-bold text-white tracking-wide uppercase">
									<?php echo esc_html( $r_platform ); ?>
								</div>
							</div>

							<!-- Details -->
							<div class="flex flex-1 flex-col p-3.5">
								<div class="flex items-center justify-between">
									<h3 class="font-display text-sm font-bold text-zinc-100 truncate">
										<a href="<?php the_permalink(); ?>" class="hover:underline">
											<?php the_title(); ?>
										</a>
									</h3>
									<span class="text-[10px] text-zinc-500 font-medium"><?php echo esc_html( $r_age ); ?>j</span>
								</div>
								
								<div class="mt-1 flex items-center justify-between text-[10px] text-zinc-500 font-light">
									<span><?php echo esc_html( $r_cat_name ); ?></span>
									<span><?php echo esc_html( $r_country ); ?></span>
								</div>

								<!-- CTA Button -->
								<div class="mt-3.5">
									<a 
										href="<?php echo esc_url( $r_aff_url ); ?>" 
										target="_blank" 
										rel="noopener noreferrer" 
										class="affiliate-btn flex w-full items-center justify-center space-x-1 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 py-2.5 text-center text-xs font-bold text-white transition-all shadow-md shadow-bordeaux-950/20"
									>
										<span>Watch Live</span>
										<i data-lucide="external-link" class="h-3 w-3"></i>
									</a>
								</div>
							</div>

						</div>
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			<?php else : ?>
				<p class="text-zinc-600 text-xs">Geen gerelateerde modellen gevonden.</p>
			<?php endif; ?>

		</div>

	</div>
</main>

<?php
get_footer();
