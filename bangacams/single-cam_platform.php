<?php
/**
 * The template for displaying a single Cam Platform review
 *
 * @package BangaCams
 */

get_header();

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

<main id="primary" class="site-main py-12">
	<div class="mx-auto max-w-4xl px-4 sm:px-6">

		<!-- Back button -->
		<div class="mb-8">
			<a 
				href="<?php echo esc_url( get_post_type_archive_link( 'cam_platform' ) ); ?>" 
				class="inline-flex items-center space-x-1.5 text-xs text-zinc-500 hover:text-zinc-300 font-bold transition-colors"
			>
				<i data-lucide="chevron-left" class="h-4 w-4"></i>
				<span>Terug naar alle platform reviews</span>
			</a>
		</div>

		<!-- Single Platform Board -->
		<article class="bg-zinc-900/10 rounded-3xl border border-zinc-900 p-6 sm:p-10 relative overflow-hidden">
			
			<!-- Header banner area -->
			<div class="flex flex-col md:flex-row md:items-center justify-between gap-6 pb-8 border-b border-zinc-900">
				
				<div class="flex items-center space-x-4">
					<img src="<?php echo esc_url($logo_url); ?>" alt="<?php the_title_attribute(); ?>" class="h-16 w-16 rounded-2xl object-cover border border-zinc-850">
					<div>
						<div class="flex items-center space-x-2.5 flex-wrap gap-y-1">
							<h1 class="font-display text-2xl sm:text-3xl font-extrabold text-white"><?php the_title(); ?></h1>
							<span class="rounded-md bg-bordeaux-600/15 border border-bordeaux-500/20 px-2 py-0.5 text-xs font-bold text-bordeaux-400">
								<?php echo esc_html($plat_cat); ?>
							</span>
						</div>
						<div class="flex items-center space-x-1 text-xs text-yellow-500 font-bold mt-1.5">
							<i data-lucide="star" class="h-4 w-4 fill-current text-yellow-500"></i>
							<span><?php echo esc_html($rating); ?> / 5.0 (Uitstekende score)</span>
						</div>
					</div>
				</div>

				<!-- Promo Signup bonus box -->
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

			<!-- Core platform features, pros & cons lists -->
			<div class="grid gap-6 md:grid-cols-3 py-8 border-b border-zinc-900/60">
				
				<!-- Key features list -->
				<div>
					<h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3.5 flex items-center space-x-1.5">
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

				<!-- Pros list -->
				<div>
					<h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3.5 flex items-center space-x-1.5">
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

				<!-- Cons list -->
				<div>
					<h3 class="text-xs font-bold uppercase tracking-wider text-zinc-500 mb-3.5 flex items-center space-x-1.5">
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

			<!-- Main review textual description block -->
			<div class="prose prose-invert prose-sm max-w-none py-8 border-b border-zinc-900/60 text-zinc-300 font-light leading-relaxed">
				<h2 class="text-xs font-bold uppercase tracking-widest text-zinc-500 mb-4">Uitgebreide Vergelijking & Platform Review</h2>
				<?php the_content(); ?>
			</div>

			<!-- Bottom Highlight Box & CTA -->
			<div class="mt-8 flex flex-col sm:flex-row items-center justify-between gap-6 bg-zinc-950 p-6 rounded-2xl border border-zinc-900">
				<div>
					<h4 class="font-display text-base font-bold text-white">Klaar om live cam shows te bekijken?</h4>
					<p class="text-xs text-zinc-500 font-light mt-1">Registreer vandaag nog via onze affiliate link en ontvang direct je welkomstbonus.</p>
				</div>
				<a 
					href="<?php echo esc_url($aff_url); ?>" 
					target="_blank" 
					rel="noopener noreferrer" 
					class="affiliate-btn inline-flex items-center justify-center space-x-2 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 px-6 py-3.5 text-xs font-bold text-white transition-all shadow-md shadow-bordeaux-950/20 w-full sm:w-auto"
				>
					<span>Bezoek <?php the_title(); ?> Nu</span>
					<i data-lucide="arrow-up-right" class="h-4 w-4"></i>
				</a>
			</div>

		</article>

	</div>
</main>

<?php
get_footer();
