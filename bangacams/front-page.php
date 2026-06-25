<?php
/**
 * The template for displaying the front page (Home Page)
 *
 * @package BangaCams
 */

get_header(); ?>

<main id="primary" class="site-main">

	<!-- Hero Banner Section -->
	<section class="relative overflow-hidden bg-gradient-to-b from-bordeaux-950/60 via-zinc-950 to-zinc-950 py-16 sm:py-24 border-b border-zinc-900/40">
		<!-- Subtle ambient radial lights -->
		<div class="absolute -top-40 -left-40 h-[400px] w-[400px] rounded-full bg-bordeaux-900/15 blur-[120px]"></div>
		<div class="absolute -top-40 -right-40 h-[400px] w-[400px] rounded-full bg-bordeaux-900/10 blur-[120px]"></div>

		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 relative">
			<div class="text-center max-w-3xl mx-auto">
				
				<!-- Badge -->
				<div class="inline-flex items-center space-x-1.5 rounded-full border border-bordeaux-500/35 bg-bordeaux-950/60 px-4 py-1.5 text-xs font-semibold text-bordeaux-400 backdrop-blur-md shadow-lg shadow-bordeaux-950/50 mb-6">
					<i data-lucide="sparkles" class="h-3.5 w-3.5 text-bordeaux-400"></i>
					<span>Beste Live Cam Selectie van 2026</span>
				</div>

				<!-- Main Heading -->
				<h1 class="font-display text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl leading-[1.1]">
					Ontdek Live <span class="bg-gradient-to-r from-bordeaux-400 to-bordeaux-300 bg-clip-text text-transparent">Cam Modellen</span> & Reviews
				</h1>
				
				<p class="mt-6 text-base sm:text-lg text-zinc-400 font-light leading-relaxed">
					Filter, sorteer en vergelijk duizenden actieve streams om je favoriete model te vinden op de meest betrouwbare en veilige cam platforms van dit moment.
				</p>

				<!-- CTAs -->
				<div class="mt-8 flex flex-col sm:flex-row items-center justify-center gap-4">
					<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 rounded-xl bg-gradient-to-r from-bordeaux-800 to-bordeaux-600 hover:from-bordeaux-700 hover:to-bordeaux-500 px-8 py-4 text-center text-sm font-bold text-white shadow-lg shadow-bordeaux-950/50 transition-all hover:scale-[1.01]">
						<span>Bekijk Live Cams</span>
						<i data-lucide="play" class="h-4 w-4 fill-current text-white"></i>
					</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_platform' ) ); ?>" class="w-full sm:w-auto inline-flex items-center justify-center space-x-2 rounded-xl border border-zinc-800 bg-zinc-950 hover:bg-zinc-900 px-8 py-4 text-center text-sm font-bold text-zinc-200 transition-colors">
						<span>Vergelijk Platforms</span>
						<i data-lucide="award" class="h-4 w-4 text-zinc-400"></i>
					</a>
				</div>

				<!-- Visual Trust indicators -->
				<div class="mt-12 grid grid-cols-2 md:grid-cols-4 gap-4 pt-8 border-t border-zinc-900/50 text-left text-zinc-500 text-xs">
					<div class="flex items-center space-x-2">
						<i data-lucide="shield" class="h-5 w-5 text-bordeaux-600"></i>
						<span>100% Veilig & Discreet</span>
					</div>
					<div class="flex items-center space-x-2">
						<i data-lucide="user-check" class="h-5 w-5 text-bordeaux-600"></i>
						<span>Geverifieerde Modellen</span>
					</div>
					<div class="flex items-center space-x-2">
						<i data-lucide="tv" class="h-5 w-5 text-bordeaux-600"></i>
						<span>HD 4K Camera Kwaliteit</span>
					</div>
					<div class="flex items-center space-x-2">
						<i data-lucide="star" class="h-5 w-5 text-bordeaux-600"></i>
						<span>Best Gewaardeerde Shows</span>
					</div>
				</div>

			</div>
		</div>
	</section>


	<!-- Trending Models Section -->
	<section id="trending-section" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
		
		<div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-2 border-b border-zinc-900 pb-5 mb-8">
			<div class="flex items-center space-x-2.5">
				<div class="rounded-lg bg-bordeaux-500/10 p-1.5 text-bordeaux-500 border border-bordeaux-500/20">
					<i data-lucide="flame" class="h-5.5 w-5.5 text-bordeaux-500"></i>
				</div>
				<h2 class="font-display text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
					Trending Now
				</h2>
			</div>
			<p class="text-sm text-zinc-400 font-light font-sans">De meest actieve live shows op dit moment</p>
		</div>

		<!-- Models Grid (Queries top 12 online/popular models) -->
		<?php
		$models_query = new WP_Query( array(
			'post_type'      => 'cam_model',
			'posts_per_page' => 12,
			'meta_key'       => 'model_popularity',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC'
		) );

		if ( $models_query->have_posts() ) : ?>
			<div class="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
				<?php while ( $models_query->have_posts() ) : $models_query->the_post(); 
					$rating = get_post_meta( get_the_ID(), 'model_rating', true );
					$img_url = get_post_meta( get_the_ID(), 'model_image_url', true );
					if ( has_post_thumbnail() ) {
						$img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
					}
					$aff_url = get_post_meta( get_the_ID(), 'model_affiliate_url', true );
					$is_online = get_post_meta( get_the_ID(), 'model_is_online', true ) === 'yes';
					$viewers = get_post_meta( get_the_ID(), 'model_viewers', true );
					$platform = get_post_meta( get_the_ID(), 'model_platform', true );
					$age = get_post_meta( get_the_ID(), 'model_age', true );
					$country = get_post_meta( get_the_ID(), 'model_country', true );
					
					$cats = get_the_terms( get_the_ID(), 'model_category' );
					$cat_name = ($cats && !is_wp_error($cats)) ? $cats[0]->name : 'Live Cam';
				?>
					<!-- Model Card -->
					<div class="group relative flex flex-col overflow-hidden rounded-2xl bg-zinc-900 border border-zinc-900 transition-all duration-300 hover:border-bordeaux-800/40 hover:shadow-lg hover:shadow-bordeaux-950/20">
						
						<!-- Image & Badges -->
						<div class="relative aspect-[3/4] overflow-hidden bg-zinc-950">
							<img 
								src="<?php echo esc_url( $img_url ); ?>" 
								alt="<?php the_title_attribute(); ?>"
								class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
								loading="lazy"
							>
							<div class="absolute inset-0 bg-gradient-to-t from-zinc-950 via-transparent to-transparent"></div>

							<!-- Online status & Viewers -->
							<div class="absolute top-2.5 left-2.5 flex items-center space-x-1.5 rounded-full bg-zinc-950/70 px-2 py-1 text-[9px] font-bold text-white backdrop-blur-md">
								<?php if ($is_online) : ?>
									<span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
									<span>LIVE (<?php echo number_format($viewers); ?>)</span>
								<?php else : ?>
									<span class="h-2 w-2 rounded-full bg-zinc-500"></span>
									<span>OFFLINE</span>
								<?php endif; ?>
							</div>

							<!-- Rating -->
							<div class="absolute top-2.5 right-2.5 flex items-center space-x-1 rounded-full bg-zinc-950/70 px-2 py-1 text-[9px] font-bold text-yellow-500 backdrop-blur-md">
								<i data-lucide="star" class="h-2.5 w-2.5 fill-current text-yellow-500"></i>
								<span><?php echo esc_html( $rating ); ?></span>
							</div>

							<!-- Platform Badge -->
							<div class="absolute bottom-2.5 left-2.5 rounded bg-bordeaux-800/80 px-1.5 py-0.5 text-[8px] font-bold text-white tracking-wide uppercase">
								<?php echo esc_html( $platform ); ?>
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
								<span class="text-[10px] text-zinc-500 font-medium"><?php echo esc_html( $age ); ?>j</span>
							</div>
							
							<div class="mt-1 flex items-center justify-between text-[10px] text-zinc-500 font-light">
								<span><?php echo esc_html( $cat_name ); ?></span>
								<span><?php echo esc_html( $country ); ?></span>
							</div>

							<!-- CTA Button -->
							<div class="mt-3.5 space-y-1.5">
								<a 
									href="<?php echo esc_url( $aff_url ); ?>" 
									target="_blank" 
									rel="noopener noreferrer" 
									class="affiliate-btn flex w-full items-center justify-center space-x-1 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 py-2.5 text-center text-xs font-bold text-white transition-all shadow-md shadow-bordeaux-950/20"
								>
									<span>Watch Live Now</span>
									<i data-lucide="external-link" class="h-3 w-3"></i>
								</a>
								<a 
									href="<?php the_permalink(); ?>" 
									class="flex w-full items-center justify-center py-1 text-[10px] text-zinc-500 hover:text-zinc-300 font-medium transition-colors"
								>
									Bekijk Profiel
								</a>
							</div>
						</div>

					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p class="text-zinc-500 text-sm">Geen actieve live shows gevonden. Activeer het thema opnieuw om de demo-data in te laden.</p>
		<?php endif; ?>

	</section>


	<!-- Categories Grid Section -->
	<section id="categories-section" class="border-t border-zinc-900/60 bg-zinc-950/30">
		<div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
			
			<div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-2 border-b border-zinc-900 pb-5 mb-8">
				<div class="flex items-center space-x-2.5">
					<div class="rounded-lg bg-bordeaux-500/10 p-1.5 text-bordeaux-500 border border-bordeaux-500/20">
						<i data-lucide="layers" class="h-5.5 w-5.5 text-bordeaux-500"></i>
					</div>
					<h2 class="font-display text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
						Bekijk per Categorie
					</h2>
				</div>
				<p class="text-sm text-zinc-400 font-light font-sans">Ontdek specifieke shows die bij jouw voorkeur passen</p>
			</div>

			<!-- Categories Bento Grid -->
			<div id="categories-grid" class="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-5">
				<?php
				$categories_data = array(
					'Live Girls'     => 'live-girls',
					'Couples'        => 'couples',
					'Amateur'        => 'amateur',
					'Premium Shows'  => 'premium-shows',
					'Free Cams'      => 'free-cams',
				);
				$gradients = array(
					'from-bordeaux-950/60 to-bordeaux-900/40 hover:from-bordeaux-900 hover:to-bordeaux-800 border-bordeaux-500/20',
					'from-zinc-900/60 to-bordeaux-950/40 hover:from-bordeaux-950 hover:to-bordeaux-900 border-bordeaux-500/20',
					'from-bordeaux-900/60 to-zinc-900/40 hover:from-bordeaux-900 hover:to-zinc-900 border-bordeaux-500/10',
					'from-zinc-900/85 to-bordeaux-950/80 hover:from-bordeaux-900 hover:to-bordeaux-950 border-bordeaux-500/20',
					'from-bordeaux-950/80 to-zinc-900/80 hover:from-bordeaux-900 hover:to-bordeaux-950 border-bordeaux-500/20'
				);
				
				$idx = 0;
				foreach ( $categories_data as $cat_label => $cat_slug ) :
					// Query taxonomy link
					$term_link = get_term_link( $cat_slug, 'model_category' );
					if ( is_wp_error( $term_link ) ) {
						$term_link = get_post_type_archive_link( 'cam_model' ) . '?category_filter=' . $cat_slug;
					}
					$grad = $gradients[$idx % count($gradients)];
					$idx++;
				?>
					<a
						href="<?php echo esc_url( $term_link ); ?>"
						class="flex flex-col items-center justify-center p-6 rounded-2xl bg-gradient-to-br <?php echo $grad; ?> border text-center transition-all duration-300 hover:scale-[1.02] group"
					>
						<span class="font-display text-base font-bold text-white group-hover:underline">
							<?php echo esc_html( $cat_label ); ?>
						</span>
						<span class="mt-2 text-[10px] font-semibold tracking-widest text-zinc-400 group-hover:text-zinc-200 uppercase flex items-center space-x-1">
							<span>Bekijk Cams</span>
							<i data-lucide="chevron-right" class="h-3 w-3"></i>
						</span>
					</a>
				<?php endforeach; ?>
			</div>

		</div>
	</section>


	<!-- Recommended Platforms Section -->
	<section id="platforms-section" class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
		
		<div class="flex items-center space-x-2.5 border-b border-zinc-900 pb-5 mb-10">
			<div class="rounded-lg bg-bordeaux-500/10 p-1.5 text-bordeaux-500 border border-bordeaux-500/20">
				<i data-lucide="award" class="h-5.5 w-5.5 text-bordeaux-500"></i>
			</div>
			<h2 class="font-display text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
				Recommended Platforms
			</h2>
		</div>

		<!-- Platforms Grid Loop -->
		<?php
		$platforms_query = new WP_Query( array(
			'post_type'      => 'cam_platform',
			'posts_per_page' => 4,
			'meta_key'       => 'platform_rating',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC'
		) );

		if ( $platforms_query->have_posts() ) : ?>
			<div class="grid gap-6 md:grid-cols-2">
				<?php while ( $platforms_query->have_posts() ) : $platforms_query->the_post(); 
					$rating = get_post_meta( get_the_ID(), 'platform_rating', true );
					$logo_url = get_post_meta( get_the_ID(), 'platform_logo_url', true );
					$aff_url = get_post_meta( get_the_ID(), 'platform_affiliate_url', true );
					$signup_bonus = get_post_meta( get_the_ID(), 'platform_signup_bonus', true );
					$plat_cat = get_post_meta( get_the_ID(), 'platform_category', true );
					
					$features_text = get_post_meta( get_the_ID(), 'platform_features', true );
					$features_arr = array_filter(explode("\n", str_replace("\r", "", $features_text)));
				?>
					<!-- Platform Card -->
					<div class="rounded-3xl border border-zinc-900 bg-zinc-900/40 p-6 flex flex-col justify-between hover:border-bordeaux-900/30 transition-colors">
						
						<div>
							<div class="flex items-center justify-between mb-4">
								<div class="flex items-center space-x-3.5">
									<img src="<?php echo esc_url($logo_url); ?>" alt="<?php the_title_attribute(); ?>" class="h-12 w-12 rounded-xl object-cover border border-zinc-880">
									<div>
										<h3 class="font-display text-lg font-bold text-white"><?php the_title(); ?></h3>
										<div class="flex items-center space-x-1 text-xs text-yellow-500 font-bold mt-0.5">
											<i data-lucide="star" class="h-3.5 w-3.5 fill-current text-yellow-500"></i>
											<span><?php echo esc_html($rating); ?> / 5.0</span>
										</div>
									</div>
								</div>
								
								<div class="rounded-full bg-bordeaux-500/10 px-2.5 py-1 text-[11px] font-bold text-bordeaux-400 border border-bordeaux-500/20">
									<?php echo esc_html($plat_cat); ?>
								</div>
							</div>
							
							<p class="text-xs text-zinc-400 font-light leading-relaxed mb-4">
								<?php echo wp_trim_words( get_the_content(), 25 ); ?>
							</p>

							<!-- Key features list -->
							<div class="space-y-1.5 mb-6">
								<?php foreach ( array_slice($features_arr, 0, 3) as $feature ) : ?>
									<div class="flex items-center space-x-2 text-[11px] text-zinc-400 font-medium">
										<i data-lucide="check" class="h-3.5 w-3.5 text-emerald-500 flex-shrink-0"></i>
										<span><?php echo esc_html($feature); ?></span>
									</div>
								<?php endforeach; ?>
							</div>

							<!-- Bonus dynamic bar -->
							<div class="flex items-center space-x-1.5 rounded-lg bg-bordeaux-500/10 border border-bordeaux-500/20 px-3 py-2 text-xs font-semibold text-bordeaux-400 mb-6">
								<i data-lucide="gift" class="h-4 w-4 flex-shrink-0"></i>
								<span class="truncate"><?php echo esc_html($signup_bonus); ?></span>
							</div>
						</div>

						<div class="flex items-center space-x-3">
							<a 
								href="<?php echo esc_url($aff_url); ?>" 
								target="_blank" 
								rel="noopener noreferrer" 
								class="affiliate-btn flex-1 flex items-center justify-center space-x-1 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 py-3 text-center text-xs font-bold text-white transition-all shadow-md shadow-bordeaux-950/20"
							>
								<span>Bezoek <?php the_title(); ?></span>
								<i data-lucide="arrow-up-right" class="h-3.5 w-3.5"></i>
							</a>
							<a 
								href="<?php the_permalink(); ?>" 
								class="px-4 py-3 rounded-xl border border-zinc-800 bg-zinc-950 hover:bg-zinc-900 text-xs font-bold text-zinc-400 hover:text-zinc-200 transition-colors"
							>
								Review
							</a>
						</div>

					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php endif; ?>

		<div class="mt-10 text-center">
			<a
				href="<?php echo esc_url( get_post_type_archive_link( 'cam_platform' ) ); ?>"
				class="inline-flex items-center space-x-1.5 text-sm font-bold text-bordeaux-400 hover:text-bordeaux-300 transition-colors"
			>
				<span>Bekijk alle platform vergelijkingen & reviews</span>
				<i data-lucide="chevron-right" class="h-4 w-4"></i>
			</a>
		</div>

	</section>


	<!-- Latest Blog/Guides Section -->
	<section id="blog-section" class="border-t border-zinc-900/60 bg-zinc-950/30">
		<div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
			
			<div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-2 border-b border-zinc-900 pb-5 mb-10">
				<div class="flex items-center space-x-2.5">
					<div class="rounded-lg bg-bordeaux-500/10 p-1.5 text-bordeaux-500 border border-bordeaux-500/20">
						<i data-lucide="book-open" class="h-5.5 w-5.5 text-bordeaux-500"></i>
					</div>
					<h2 class="font-display text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
						Cam Gidsen & SEO Artikelen
					</h2>
				</div>
				<p class="text-sm text-zinc-400 font-light font-sans">Leer over cam technologieën en branche-innovaties</p>
			</div>

			<!-- Blog grid loop -->
			<?php
			$blog_query = new WP_Query( array(
				'post_type'      => 'post',
				'posts_per_page' => 3,
			) );

			if ( $blog_query->have_posts() ) : ?>
				<div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
					<?php while ( $blog_query->have_posts() ) : $blog_query->the_post(); 
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
					<?php endwhile; wp_reset_postdata(); ?>
				</div>
			<?php endif; ?>

		</div>
	</section>

</main>

<?php get_footer(); ?>
