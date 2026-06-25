<?php
/**
 * The template for displaying Cam Models Archive page (All Cams page)
 *
 * @package BangaCams
 */

get_header();

// Fetch active filters
$active_cat_slug = '';
$queried_obj = get_queried_object();
if ( is_tax( 'model_category' ) ) {
	$active_cat_slug = $queried_obj->slug;
} elseif ( isset( $_GET['category_filter'] ) && ! empty( $_GET['category_filter'] ) ) {
	$active_cat_slug = sanitize_text_field( $_GET['category_filter'] );
}

$sort_by = 'popularity';
if ( isset( $_GET['sort_by'] ) && ! empty( $_GET['sort_by'] ) ) {
	$sort_by = sanitize_text_field( $_GET['sort_by'] );
}

$search_query = get_search_query();
?>

<main id="primary" class="site-main py-12">
	<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

		<!-- Header intro banner -->
		<div class="rounded-3xl bg-gradient-to-r from-bordeaux-950/40 via-zinc-900/50 to-zinc-950 border border-zinc-900 p-8 sm:p-12 mb-8 relative overflow-hidden">
			<div class="absolute -top-32 -left-32 h-64 w-64 rounded-full bg-bordeaux-900/10 blur-3xl"></div>
			<div class="relative z-10 text-center sm:text-left">
				<h1 class="font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
					Live Webcam <span class="bg-gradient-to-r from-bordeaux-500 to-bordeaux-300 bg-clip-text text-transparent">Modellen</span>
				</h1>
				<p class="mt-2 text-sm text-zinc-400 font-light max-w-xl">
					Filter en sorteer door duizenden actieve streams om je favoriete model te vinden. Direct, veilig en anoniem.
				</p>
			</div>
		</div>

		<!-- Filter and sorting bar container -->
		<div class="flex flex-col gap-6 border-b border-zinc-900 pb-8 mb-8">
			
			<!-- Form for filters & sorting -->
			<form method="get" action="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" class="w-full flex flex-col md:flex-row md:items-center md:justify-between gap-4">
				
				<!-- Category pills selection -->
				<div class="flex flex-wrap items-center gap-2">
					<?php
					$categories_list = array(
						'All'           => '',
						'Live Girls'    => 'live-girls',
						'Couples'       => 'couples',
						'Amateur'       => 'amateur',
						'Premium Shows' => 'premium-shows',
						'Free Cams'     => 'free-cams',
					);

					foreach ( $categories_list as $label => $slug ) :
						$is_active = ( $active_cat_slug === $slug );
						
						// If "All" is active, or specific slug matches
						$button_class = $is_active 
							? 'bg-bordeaux-800 text-white shadow-md shadow-bordeaux-950/40 border border-bordeaux-700/50' 
							: 'bg-zinc-900 text-zinc-400 hover:bg-zinc-800 hover:text-zinc-200 border border-transparent';
						
						// Create link
						if ( empty( $slug ) ) {
							$link = get_post_type_archive_link( 'cam_model' );
						} else {
							$link = get_term_link( $slug, 'model_category' );
							if ( is_wp_error( $link ) ) {
								$link = get_post_type_archive_link( 'cam_model' ) . '?category_filter=' . $slug;
							}
						}
						
						// If we have sorting active, append it to the link
						if ( ! empty( $sort_by ) && $sort_by !== 'popularity' ) {
							$link = add_query_arg( 'sort_by', $sort_by, $link );
						}
						if ( ! empty( $search_query ) ) {
							$link = add_query_arg( 's', $search_query, $link );
						}
					?>
						<a 
							href="<?php echo esc_url( $link ); ?>" 
							class="rounded-full px-4 py-2 text-xs font-bold transition-all duration-200 cursor-pointer <?php echo $button_class; ?>"
						>
							<?php echo esc_html( $label ); ?>
						</a>
					<?php endforeach; ?>
				</div>

				<!-- Sorting dropdown -->
				<div class="flex items-center space-x-2 self-start md:self-auto">
					<span class="text-xs text-zinc-500 font-medium">Sorteer op:</span>
					
					<!-- Hidden inputs to preserve active category and search filter -->
					<?php if ( ! empty( $active_cat_slug ) && ! is_tax( 'model_category' ) ) : ?>
						<input type="hidden" name="category_filter" value="<?php echo esc_attr( $active_cat_slug ); ?>">
					<?php endif; ?>
					<?php if ( ! empty( $search_query ) ) : ?>
						<input type="hidden" name="s" value="<?php echo esc_attr( $search_query ); ?>">
					<?php endif; ?>
					<input type="hidden" name="post_type" value="cam_model">

					<select 
						name="sort_by" 
						onchange="this.form.submit()"
						class="rounded-xl border border-zinc-800 bg-zinc-950 px-3.5 py-2 text-xs font-bold text-zinc-200 outline-none focus:border-bordeaux-700 focus:ring-1 focus:ring-bordeaux-700 transition-all cursor-pointer"
					>
						<option value="popularity" <?php selected( $sort_by, 'popularity' ); ?>>Populariteit</option>
						<option value="rating" <?php selected( $sort_by, 'rating' ); ?>>Beoordeling</option>
						<option value="viewers" <?php selected( $sort_by, 'viewers' ); ?>>Kijkers (Live)</option>
					</select>
				</div>

			</form>

			<!-- Active Filters State Display -->
			<?php if ( ! empty( $active_cat_slug ) || ! empty( $search_query ) ) : ?>
				<div class="flex flex-wrap items-center justify-between gap-3 bg-zinc-900/20 rounded-xl border border-zinc-900 p-4">
					<div class="flex flex-wrap items-center gap-2">
						<span class="text-xs text-zinc-500 font-medium">Actieve filters:</span>
						
						<?php if ( ! empty( $active_cat_slug ) ) : 
							$term_obj = get_term_by('slug', $active_cat_slug, 'model_category');
							$display_term = $term_obj ? $term_obj->name : $active_cat_slug;
						?>
							<span class="rounded-lg bg-bordeaux-500/10 border border-bordeaux-500/20 px-3 py-1 text-xs text-bordeaux-400 font-bold flex items-center space-x-1.5">
								<span>Categorie: <?php echo esc_html( $display_term ); ?></span>
							</span>
						<?php endif; ?>

						<?php if ( ! empty( $search_query ) ) : ?>
							<span class="rounded-lg bg-bordeaux-500/10 border border-bordeaux-500/20 px-3 py-1 text-xs text-bordeaux-400 font-bold flex items-center space-x-1.5">
								<span>Zoekwoord: <?php echo esc_html( $search_query ); ?></span>
							</span>
						<?php endif; ?>
					</div>

					<a 
						href="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" 
						class="text-xs text-bordeaux-400 hover:text-bordeaux-300 font-bold transition-colors cursor-pointer flex items-center space-x-1"
					>
						<i data-lucide="rotate-ccw" class="h-3.5 w-3.5"></i>
						<span>Herstel filters</span>
					</a>
				</div>
			<?php endif; ?>

		</div>


		<!-- Main Models Grid View -->
		<?php if ( have_posts() ) : ?>
			<div class="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
				<?php while ( have_posts() ) : the_post(); 
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
				<?php endwhile; ?>
			</div>

			<!-- Standard Pagination -->
			<div class="mt-12 text-center">
				<?php
				echo paginate_links( array(
					'base'      => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
					'format'    => '?paged=%#%',
					'current'   => max( 1, get_query_var( 'paged' ) ),
					'total'     => $wp_query->max_num_pages,
					'type'      => 'plain',
					'prev_text' => '<i data-lucide="chevron-left" class="h-4 w-4 inline-block"></i> Vorige',
					'next_text' => 'Volgende <i data-lucide="chevron-right" class="h-4 w-4 inline-block"></i>',
				) );
				?>
			</div>

		<?php else : ?>
			<!-- No results state -->
			<div class="text-center py-16 bg-zinc-900/25 rounded-2xl border border-zinc-900 p-8">
				<div class="rounded-full bg-zinc-900 p-3 inline-block mb-4 text-zinc-500">
					<i data-lucide="search" class="h-8 w-8"></i>
				</div>
				<h3 class="font-display text-lg font-bold text-white">Geen resultaten gevonden</h3>
				<p class="mt-1 text-sm text-zinc-500 font-light">Probeer andere zoekwoorden of filtercategorieën.</p>
				<a 
					href="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" 
					class="mt-4 rounded-full bg-bordeaux-800 px-6 py-2.5 text-xs font-bold text-white hover:bg-bordeaux-700 inline-block"
				>
					Toon alle live cams
				</a>
			</div>
		<?php endif; ?>

	</div>
</main>

<?php
get_footer();
