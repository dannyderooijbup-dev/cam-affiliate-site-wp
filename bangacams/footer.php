	<!-- Footer section -->
	<footer class="mt-auto border-t border-zinc-900 bg-zinc-950 py-12 text-zinc-500">
		<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
			
			<!-- Top row of footer -->
			<div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pb-8 border-b border-zinc-900/60">
				<div class="flex items-center space-x-2">
					<div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-tr from-bordeaux-800 to-bordeaux-600 text-white font-bold text-sm">
						B
					</div>
					<span class="font-display text-lg font-black tracking-tight text-zinc-200">
						BANGA<span class="text-bordeaux-500">CAMS</span>
					</span>
				</div>
				
				<div class="flex flex-wrap gap-x-6 gap-y-2 text-xs font-semibold text-zinc-400">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-zinc-200 transition-colors">Trending</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_model' ) ); ?>" class="hover:text-zinc-200 transition-colors">Cams</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'cam_platform' ) ); ?>" class="hover:text-zinc-200 transition-colors">Top Platforms</a>
					<a href="<?php echo esc_url( get_post_type_archive_link( 'post' ) ? get_post_type_archive_link( 'post' ) : home_url('?tab=blog') ); ?>" class="hover:text-zinc-200 transition-colors">Blog</a>
				</div>
			</div>

			<!-- Core disclaimers (Age Warning & Affiliate disclosure) -->
			<div class="mt-8 space-y-4 text-xs leading-relaxed font-light text-zinc-600">
				
				<!-- Age alert -->
				<p class="flex items-start bg-zinc-950/40 p-4 rounded-xl border border-zinc-900/40">
					<i data-lucide="shield-alert" class="h-5 w-5 text-bordeaux-700 mr-3 flex-shrink-0 mt-0.5"></i>
					<span>
						<strong class="text-zinc-500 font-semibold">18+ Leeftijdsgrens:</strong> De content op deze website en de doorgelinkte platformen zijn uitsluitend bestemd voor personen van 18 jaar en ouder. Door onze website te gebruiken, verklaar je dat je ten minste 18 jaar oud bent en wettelijk bevoegd bent om dergelijke inhoud te bekijken in jouw rechtsgebied.
					</span>
				</p>

				<!-- Affiliate disclaimer -->
				<p class="bg-zinc-950/40 p-4 rounded-xl border border-zinc-900/40">
					<strong class="text-zinc-500 font-semibold">Affiliate Disclosure:</strong> BangaCams is een onafhankelijk vergelijkings- en reviewportaal. Wij bieden zelf geen streamingdiensten aan. De knoppen gemarkeerd met "Watch Live Now", "Bezoek Platform" of andere doorklik-links zijn affiliate links. Dit houdt in dat wij een vergoeding kunnen ontvangen van het cam-platform wanneer je doorklikt en je registreert. Dit kost jou als gebruiker niets extra's, maar stelt ons in staat om de website gratis, actueel en optimaal te onderhouden.
				</p>

				<!-- Copyright -->
				<p class="pt-4 border-t border-zinc-900/30 text-center md:text-left">
					&copy; <?php echo date('Y'); ?> BangaCams. Alle rechten voorbehouden. Bezoek cam platforms discreet en speel bewust.
				</p>
			</div>

		</div>
	</footer>

	<?php wp_footer(); ?>

	<!-- Mobile Navigation, Interactive Filters and Lucide Initiation Scripts -->
	<script>
		document.addEventListener('DOMContentLoaded', function() {
			// 1. Initialize Lucide icons
			if (typeof lucide !== 'undefined') {
				lucide.createIcons();
			}

			// 2. Mobile Menu Toggle
			const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
			const mobileMenu = document.getElementById('mobile-menu');
			if (mobileMenuToggle && mobileMenu) {
				mobileMenuToggle.addEventListener('click', function() {
					mobileMenu.classList.toggle('hidden');
				});
			}

			// 3. Mobile Search Toggle
			const mobileSearchToggle = document.getElementById('mobile-search-toggle');
			const mobileSearchBar = document.getElementById('mobile-search-bar');
			if (mobileSearchToggle && mobileSearchBar) {
				mobileSearchToggle.addEventListener('click', function() {
					mobileSearchBar.classList.toggle('hidden');
				});
			}
		});
	</script>
</body>
</html>
