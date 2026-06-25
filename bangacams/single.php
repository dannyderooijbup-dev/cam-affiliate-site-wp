<?php
/**
 * The template for displaying a single blog post article
 *
 * @package BangaCams
 */

get_header();

$img_url = get_post_meta( get_the_ID(), 'blog_image_url', true );
if ( has_post_thumbnail() ) {
	$img_url = get_the_post_thumbnail_url( get_the_ID(), 'large' );
}
$author = get_post_meta( get_the_ID(), 'blog_author', true );
if ( ! $author ) {
	$author = get_the_author();
}
$read_time = get_post_meta( get_the_ID(), 'blog_read_time', true );
if ( ! $read_time ) {
	$read_time = '5 min leestijd';
}

// Generate JSON-LD Schema Markup for Blog Post SEO
?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BlogPosting",
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo esc_url( get_permalink() ); ?>"
  },
  "headline": "<?php echo esc_js( get_the_title() ); ?>",
  "description": "<?php echo esc_js( wp_strip_all_tags( get_the_excerpt() ) ); ?>",
  "image": "<?php echo esc_url( $img_url ); ?>",  
  "author": {
    "@type": "Person",
    "name": "<?php echo esc_js( $author ); ?>"
  },  
  "publisher": {
    "@type": "Organization",
    "name": "BangaCams Affiliate Directory",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo esc_url( $img_url ); ?>"
    }
  },
  "datePublished": "<?php echo esc_js( get_the_date('c') ); ?>",
  "dateModified": "<?php echo esc_js( get_the_modified_date('c') ); ?>"
}
</script>

<main id="primary" class="site-main py-12">
	<div class="mx-auto max-w-3xl px-4 sm:px-6">

		<!-- Article -->
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				
				<!-- Back button -->
				<div class="mb-8">
					<a 
						href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url('?tab=blog') ); ?>" 
						class="inline-flex items-center space-x-1.5 text-xs text-zinc-500 hover:text-zinc-300 font-bold transition-colors"
					>
						<i data-lucide="chevron-left" class="h-4 w-4"></i>
						<span>Terug naar blog & nieuws</span>
					</a>
				</div>

				<!-- Article Title -->
				<h1 class="font-display text-3xl sm:text-4xl md:text-5xl font-black text-white tracking-tight leading-tight mb-6">
					<?php the_title(); ?>
				</h1>

				<!-- Meta indicators -->
				<div class="flex flex-wrap items-center gap-4 text-xs text-zinc-500 mb-8 pb-5 border-b border-zinc-900 font-medium">
					<div class="flex items-center space-x-1.5">
						<i data-lucide="calendar" class="h-4 w-4 text-bordeaux-500"></i>
						<span><?php echo get_the_date(); ?></span>
					</div>
					<div class="flex items-center space-x-1.5">
						<i data-lucide="user" class="h-4 w-4 text-bordeaux-500"></i>
						<span><?php echo esc_html( $author ); ?></span>
					</div>
					<div class="flex items-center space-x-1.5">
						<i data-lucide="clock" class="h-4 w-4 text-bordeaux-500"></i>
						<span><?php echo esc_html( $read_time ); ?></span>
					</div>
				</div>

				<!-- Cover Image -->
				<?php if ( ! empty($img_url) ) : ?>
					<div class="aspect-video w-full overflow-hidden rounded-2xl border border-zinc-900 bg-zinc-950 mb-10">
						<img src="<?php echo esc_url($img_url); ?>" alt="<?php the_title_attribute(); ?>" class="h-full w-full object-cover">
					</div>
				<?php endif; ?>

				<!-- Prose Content Body -->
				<div class="prose prose-invert prose-bordeaux max-w-none text-zinc-300 font-light leading-relaxed text-sm sm:text-base space-y-6">
					<?php the_content(); ?>
				</div>

				<!-- Bottom Action Box -->
				<div class="mt-16 rounded-2xl bg-gradient-to-r from-bordeaux-950/50 via-zinc-900 to-zinc-950 border border-bordeaux-500/20 p-6 sm:p-8 text-center sm:text-left flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
					<div>
						<h3 class="font-display text-lg sm:text-xl font-bold text-white">Wil je live cams in actie zien?</h3>
						<p class="mt-1 text-xs sm:text-sm text-zinc-400 font-light">Bekijk duizenden geverifieerde model streams op ons top-aanbevolen platform.</p>
					</div>
					<a 
						href="https://external.directlink.com/aff/jerkmate?subid=seo_blog_cta" 
						target="_blank" 
						rel="noopener noreferrer" 
						class="affiliate-btn inline-flex items-center justify-center space-x-2 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 px-6 py-3.5 text-xs font-bold text-white transition-all shadow-md shadow-bordeaux-950/20 w-full sm:w-auto"
					>
						<span>Start Live Cams</span>
						<i data-lucide="arrow-right" class="h-4 w-4"></i>
					</a>
				</div>

			</article>
		<?php endwhile; ?>

	</div>
</main>

<?php
get_footer();
