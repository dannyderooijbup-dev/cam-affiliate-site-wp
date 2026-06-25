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

	<!-- 🔞 18+ Age Verification Modal -->
	<div id="wp-age-gate" class="fixed inset-0 z-[9999] flex items-center justify-center bg-zinc-950 p-4 sm:p-6 md:p-10 overflow-y-auto hidden">
		<div class="absolute inset-0 bg-zinc-950/95"></div>
		
		<div class="relative w-full max-w-md rounded-3xl border border-zinc-900 bg-zinc-900/60 p-8 text-center shadow-2xl shadow-black/80 backdrop-blur-md">
			<!-- Warning Sign -->
			<div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-2xl bg-gradient-to-tr from-bordeaux-800 to-bordeaux-600 text-white font-black text-xl shadow-lg shadow-bordeaux-950/50 border border-bordeaux-500/20">
				18+
			</div>

			<h2 class="font-display text-2xl font-black tracking-tight text-white sm:text-3xl">
				Leeftijdsverificatie
			</h2>
			
			<p class="mt-4 text-xs text-zinc-400 font-light leading-relaxed">
				BangaCams bevat expliciete en seksuele inhoud van webcam modellen en platformen. Je moet minimaal <strong class="text-zinc-200">18 jaar of ouder</strong> zijn om deze website te bezoeken.
			</p>

			<div class="mt-8 flex flex-col gap-3">
				<button id="wp-age-accept" class="w-full rounded-xl bg-gradient-to-r from-bordeaux-800 to-bordeaux-600 hover:from-bordeaux-700 hover:to-bordeaux-550 py-4 text-center text-sm font-extrabold text-white shadow-lg shadow-bordeaux-950/50 transition-all hover:scale-[1.01] cursor-pointer">
					Ja, ik ben 18+ (Toegang)
				</button>
				<button id="wp-age-decline" class="w-full rounded-xl border border-zinc-800 bg-zinc-950/80 hover:bg-zinc-900 py-4 text-center text-sm font-bold text-zinc-500 hover:text-zinc-300 transition-colors cursor-pointer">
					Nee, ik ben minderjarig
				</button>
			</div>

			<p class="mt-6 text-[10px] text-zinc-600 font-light leading-relaxed">
				Door op "Ja" te klikken, ga je akkoord met onze algemene voorwaarden, ons cookiebeleid en verklaar je op erewoord dat je meerjarig bent.
			</p>
		</div>
	</div>

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

			// 4. Age Gate verification controller
			const ageGate = document.getElementById('wp-age-gate');
			const ageAccept = document.getElementById('wp-age-accept');
			const ageDecline = document.getElementById('wp-age-decline');

			if (ageGate && ageAccept && ageDecline) {
				const isVerified = localStorage.getItem('wp-age-verified') === 'true';
				if (!isVerified) {
					ageGate.classList.remove('hidden');
					document.body.classList.add('overflow-hidden');
				}

				ageAccept.addEventListener('click', function() {
					localStorage.setItem('wp-age-verified', 'true');
					ageGate.classList.add('hidden');
					document.body.classList.remove('overflow-hidden');
				});

				ageDecline.addEventListener('click', function() {
					window.location.href = 'https://www.google.com';
				});
			}
		});
	</script>
</body>
</html>
