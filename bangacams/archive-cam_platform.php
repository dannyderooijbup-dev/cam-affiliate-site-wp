<?php
/**
 * The template for displaying Cam Platforms Archive page (Top Platforms comparison page)
 *
 * @package BangaCams
 */

get_header(); ?>

<main id="primary" class="site-main py-12">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

		<!-- Page Header -->
		<div class="text-center mb-16">
			<h1 class="font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
				Beste Live Cam <span class="bg-gradient-to-r from-bordeaux-500 to-bordeaux-300 bg-clip-text text-transparent">Platforms</span> 2026
			</h1>
			<p class="mx-auto mt-4 max-w-2xl text-sm text-zinc-400 font-light font-sans">
				Wij vergelijken de meest betrouwbare en veilige cam platforms van dit moment. Onze reviews zijn onafhankelijk en gebaseerd op camera-kwaliteit, model-diversiteit en privacy.
			</p>
		</div>

		<!-- Platforms comparisons loop -->
		<?php
		$plats_query = new WP_Query( array(
			'post_type'      => 'cam_platform',
			'posts_per_page' => 10,
			'meta_key'       => 'platform_rating',
			'orderby'        => 'meta_value_num',
			'order'          => 'DESC'
		) );

		if ( $plats_query->have_posts() ) : ?>
			<div class="space-y-10">
				<?php while ( $plats_query->have_posts() ) : $plats_query->the_post(); 
					$rating = get_post_meta( get_the_ID(), 'platform_rating', true );
					$logo_url = get_post_meta( get_the_ID(), 'platform_logo_url', true );
					$aff_url = get_post_meta( get_the_ID(), 'platform_affiliate_url', true );
					$signup_bonus = get_post_meta( get_the_ID(), 'platform_signup_bonus', true );
					$plat_cat = get_post_meta( get_the_ID(), 'platform_category', true );
					
					// Parse lists
					$features_text = get_post_meta( get_the_ID(), 'platform_features', true );
					$features_arr = array_filter(explode("\n", str_replace("\r", "", $features_text)));

					$pros_text = get_post_meta( get_the_ID(), 'platform_pros', true );
					$pros_arr = array_filter(explode("\n", str_replace("\r", "", $pros_text)));

					$cons_text = get_post_meta( get_the_ID(), 'platform_cons', true );
					$cons_arr = array_filter(explode("\n", str_replace("\r", "", $cons_text)));
				?>
					<!-- Detailed Platform Review Board -->
					<div class="rounded-3xl border border-zinc-900 bg-zinc-900/20 p-6 sm:p-8 hover:border-bordeaux-950/40 transition-all duration-300">
						
						<!-- Header Row -->
						<div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-6 border-b border-zinc-900">
							
							<div class="flex items-center space-x-4">
								<img src="<?php echo esc_url($logo_url); ?>" alt="<?php the_title_attribute(); ?>" class="h-16 w-16 rounded-2xl object-cover border border-zinc-850">
								<div>
									<div class="flex items-center space-x-2.5 flex-wrap gap-y-1">
										<h2 class="font-display text-2xl font-bold text-white"><?php the_title(); ?></h2>
										<span class="rounded-md bg-bordeaux-600/15 border border-bordeaux-500/20 px-2 py-0.5 text-xs font-bold text-bordeaux-400">
											<?php echo esc_html($plat_cat); ?>
										</span>
									</div>
									<div class="flex items-center space-x-1 text-xs text-yellow-500 font-bold mt-1.5">
										<i data-lucide="star" class="h-4 w-4 fill-current text-yellow-500"></i>
										<span><?php echo esc_html($rating); ?> / 5.0 (Uitstekend)</span>
									</div>
								</div>
							</div>

							<!-- Signup Bonus banner -->
							<div class="rounded-2xl bg-gradient-to-r from-bordeaux-950/50 via-bordeaux-900/40 to-zinc-900/30 border border-bordeaux-500/20 px-5 py-4 flex items-center space-x-3 md:max-w-xs w-full">
								<div class="rounded-lg bg-bordeaux-700 p-2 text-white">
									<i data-lucide="gift" class="h-5 w-5"></i>
								</div>
								<div>
									<div class="text-[10px] font-bold text-bordeaux-400 uppercase tracking-wider">AANMELDINGSBONUS</div>
									<div class="text-xs font-bold text-zinc-100"><?php echo esc_html($signup_bonus); ?></div>
								</div>
							</div>

						</div>

						<!-- Body: Pros & Cons & Features -->
						<div class="grid gap-6 md:grid-cols-3 py-6 my-2 border-b border-zinc-900/60">
							
							<!-- Key Features -->
							<div>
								<h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3 flex items-center space-x-1.5">
									<i data-lucide="shield" class="h-4 w-4 text-zinc-500"></i>
									<span>Belangrijkste Kenmerken</span>
								</h3>
								<ul class="space-y-2.5">
									<?php foreach ( $features_arr as $feature ) : ?>
										<li class="flex items-start text-xs text-zinc-400 leading-relaxed font-light">
											<i data-lucide="check" class="h-4 w-4 text-zinc-500 mr-2 flex-shrink-0 mt-0.5"></i>
											<span><?php echo esc_html($feature); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>

							<!-- Pros -->
							<div>
								<h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3 flex items-center space-x-1.5">
									<i data-lucide="check-circle" class="h-4 w-4 text-emerald-500"></i>
									<span>Pluspunten (Pros)</span>
								</h3>
								<ul class="space-y-2.5">
									<?php foreach ( $pros_arr as $pro ) : ?>
										<li class="flex items-start text-xs text-zinc-400 leading-relaxed font-light">
											<i data-lucide="check" class="h-4 w-4 text-emerald-500 mr-2 flex-shrink-0 mt-0.5"></i>
											<span><?php echo esc_html($pro); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>

							<!-- Cons -->
							<div>
								<h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3 flex items-center space-x-1.5">
									<i data-lucide="minus-circle" class="h-4 w-4 text-bordeaux-600"></i>
									<span>Minpunten (Cons)</span>
								</h3>
								<ul class="space-y-2.5">
									<?php foreach ( $cons_arr as $con ) : ?>
										<li class="flex items-start text-xs text-zinc-400 leading-relaxed font-light">
											<i data-lucide="x" class="h-4 w-4 text-bordeaux-600 mr-2 flex-shrink-0 mt-0.5"></i>
											<span><?php echo esc_html($con); ?></span>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>

						</div>

						<!-- Description & CTAs -->
						<div class="pt-6 flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
							
							<div class="flex-1">
								<p class="text-xs text-zinc-400 leading-relaxed font-light max-w-2xl">
									<?php the_content(); ?>
								</p>
							</div>

							<!-- CTAs -->
							<div class="flex flex-col sm:flex-row items-center gap-3 w-full lg:w-auto lg:min-w-[320px]">
								<a 
									href="<?php the_permalink(); ?>" 
									class="w-full sm:w-auto flex-1 inline-flex items-center justify-center rounded-xl border border-zinc-800 bg-zinc-950 hover:bg-zinc-900 px-6 py-3.5 text-center text-xs font-bold text-zinc-400 hover:text-zinc-200 transition-colors"
								>
									Volledige Review
								</a>
								<a 
									href="<?php echo esc_url($aff_url); ?>" 
									target="_blank" 
									rel="noopener noreferrer" 
									class="affiliate-btn w-full sm:w-auto flex-1 inline-flex items-center justify-center space-x-1.5 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 px-6 py-3.5 text-center text-xs font-bold text-white transition-all shadow-md shadow-bordeaux-950/20"
								>
									<span>Bezoek <?php the_title(); ?></span>
									<i data-lucide="arrow-up-right" class="h-4 w-4"></i>
								</a>
							</div>

						</div>

					</div>
				<?php endwhile; wp_reset_postdata(); ?>
			</div>
		<?php else : ?>
			<p class="text-zinc-500 text-center">Geen platforms gevonden. Activeer het thema opnieuw om de demo-data in te laden.</p>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
