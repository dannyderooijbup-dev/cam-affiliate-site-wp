<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>

	<!-- Client-side Tailwind CSS (v4) Play CDN for complete, zero-build responsiveness -->
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					fontFamily: {
						sans: ['Inter', 'sans-serif'],
						display: ['Space Grotesk', 'sans-serif'],
						mono: ['JetBrains Mono', 'monospace'],
					},
					colors: {
						bordeaux: {
							50: '#fff1f2',
							100: '#ffe4e6',
							200: '#fecdd3',
							300: '#fda4af',
							400: '#fb7185',
							500: '#f43f5e',
							550: '#e11d48',
							600: '#be123c',
							700: '#9f1239',
							800: '#881337',
							900: '#6b071a',
							950: '#40010c',
						},
						zinc: {
							850: '#1e1e24',
							950: '#09090b',
						}
					}
				}
			}
		}
	</script>

	<!-- Lucide Icons Library CDN -->
	<script src="https://unpkg.com/lucide@latest"></script>

	<style>
		/* Custom scrollbar and ambient visual adjustments */
		::-webkit-scrollbar {
			width: 8px;
		}
		::-webkit-scrollbar-track {
			background: #09090b;
		}
		::-webkit-scrollbar-thumb {
			background: #27272a;
			border-radius: 4px;
		}
		::-webkit-scrollbar-thumb:hover {
			background: #881337;
		}
		
		/* Text-selection theme matching */
		::selection {
			background-color: #881337;
			color: #ffffff;
		}
	</style>
</head>

<body <?php body_class( 'bg-zinc-950 text-zinc-100 min-h-screen flex flex-col selection:bg-bordeaux-800 selection:text-white' ); ?>>

	<!-- Header navigation -->
	<header class="sticky top-0 z-50 border-b border-zinc-900 bg-zinc-950/80 backdrop-blur-md">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			<div class="flex h-16 items-center justify-between gap-4">
				
				<!-- Logo -->
				<div class="flex items-center">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center space-x-2 group">
						<div class="flex h-9 w-9 items-center justify-center rounded-xl bg-gradient-to-tr from-bordeaux-800 to-bordeaux-600 text-white font-bold text-base transition-transform group-hover:scale-105 shadow-md shadow-bordeaux-950/50">
							B
						</div>
						<span class="font-display text-xl font-black tracking-tight text-zinc-100">
							BANGA<span class="text-bordeaux-500 group-hover:text-bordeaux-400 transition-colors">CAMS</span>
						</span>
					</a>
				</div>

				<!-- Navigation links (Desktop) -->
				<nav class="hidden md:flex items-center space-x-6 text-sm font-semibold">
					<?php
					$is_home = is_front_page() && !isset($_GET['tab']) && !isset($_GET['s']);
					$is_cams = is_post_type_archive('cam_model') || is_tax('model_category') || is_tax('model_tag') || (isset($_GET['tab']) && $_GET['tab'] === 'cams') || is_singular('cam_model');
					$is_platforms = is_post_type_archive('cam_platform') || (isset($_GET['tab']) && $_GET['tab'] === 'platforms') || is_singular('cam_platform');
					$is_blog = is_home() || is_singular('post') || (isset($_GET['tab']) && $_GET['tab'] === 'blog');
					?>
					
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="transition-colors <?php echo $is_home ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
						Trending
					</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" class="transition-colors <?php echo $is_cams ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
						Cams
					</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_platform' ) ); ?>" class="transition-colors <?php echo $is_platforms ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
						Top Platforms
					</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url('?tab=blog') ); ?>" class="transition-colors <?php echo $is_blog ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
						Blog
					</a>
				</nav>

				<!-- Search (Desktop) -->
				<div class="hidden sm:block flex-1 max-w-xs relative">
					<form role="search" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>">
						<div class="relative">
							<i data-lucide="search" class="absolute left-3 top-2.5 h-4 w-4 text-zinc-500 pointer-events-none"></i>
							<input 
								type="search" 
								name="s" 
								value="<?php echo get_search_query(); ?>"
								placeholder="Zoek live cams..." 
								class="w-full rounded-full border border-zinc-800 bg-zinc-950 py-2 pl-9 pr-4 text-xs font-medium text-zinc-200 outline-none focus:border-bordeaux-700 focus:ring-1 focus:ring-bordeaux-700 transition-all placeholder:text-zinc-600"
							>
							<!-- Ensure search only queries cam_model post type -->
							<input type="hidden" name="post_type" value="cam_model">
						</div>
					</form>
				</div>

				<!-- Menu trigger (Mobile) -->
				<div class="flex items-center space-x-2 md:hidden">
					<button id="mobile-search-toggle" class="rounded-lg p-2 text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200">
						<i data-lucide="search" class="h-5 w-5"></i>
					</button>
					<button id="mobile-menu-toggle" class="rounded-lg p-2 text-zinc-400 hover:bg-zinc-900 hover:text-zinc-200">
						<i data-lucide="menu" class="h-6 w-6"></i>
					</button>
				</div>

			</div>
		</div>

		<!-- Mobile Search Bar Expanded -->
		<div id="mobile-search-bar" class="hidden border-t border-zinc-900 bg-zinc-950 px-4 py-3 sm:hidden">
			<form role="search" method="get" action="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>">
				<div class="relative">
					<i data-lucide="search" class="absolute left-3 top-2.5 h-4 w-4 text-zinc-500"></i>
					<input 
						type="search" 
						name="s" 
						value="<?php echo get_search_query(); ?>"
						placeholder="Zoek live cams..." 
						class="w-full rounded-full border border-zinc-800 bg-zinc-900 py-2 pl-9 pr-4 text-xs font-medium text-zinc-200 outline-none focus:border-bordeaux-700"
					>
					<input type="hidden" name="post_type" value="cam_model">
				</div>
			</form>
		</div>

		<!-- Mobile Navigation Dropdown Menu -->
		<div id="mobile-menu" class="hidden border-t border-zinc-900 bg-zinc-950 px-4 py-4 md:hidden">
			<nav class="flex flex-col space-y-3 font-semibold text-sm">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="py-2 transition-colors <?php echo $is_home ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
					Trending
				</a>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" class="py-2 transition-colors <?php echo $is_cams ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
					Cams
				</a>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_platform' ) ); ?>" class="py-2 transition-colors <?php echo $is_platforms ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
					Top Platforms
				</a>
				<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url('?tab=blog') ); ?>" class="py-2 transition-colors <?php echo $is_blog ? 'text-bordeaux-500' : 'text-zinc-400 hover:text-zinc-200'; ?>">
					Blog
				</a>
			</nav>
		</div>

	</header>
