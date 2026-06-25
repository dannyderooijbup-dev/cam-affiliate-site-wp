<?php
/**
 * BangaCams Theme functions and definitions
 *
 * @package BangaCams
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Setup Theme Defaults
 */
function bangacams_setup() {
	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails on posts and custom post types
	add_theme_support( 'post-thumbnails' );

	// Register navigation menus
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'bangacams' ),
	) );

	// Switch default core markup to output clean HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'style',
		'script',
	) );
}
add_action( 'after_setup_theme', 'bangacams_setup' );

/**
 * Enqueue scripts and styles
 */
function bangacams_scripts() {
	// Enqueue main stylesheet
	wp_enqueue_style( 'bangacams-style', get_stylesheet_uri(), array(), '1.0.0' );

	// Enqueue Google Fonts
	wp_enqueue_style( 'bangacams-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap', array(), null );
}
add_action( 'wp_enqueue_scripts', 'bangacams_scripts' );

/**
 * Register Custom Post Types and Taxonomies
 */
function bangacams_register_post_types_and_taxonomies() {
	// 1. Register Custom Post Type: cam_model
	register_post_type( 'cam_model', array(
		'labels'             => array(
			'name'               => _x( 'Cam Models', 'post type general name', 'bangacams' ),
			'singular_name'      => _x( 'Cam Model', 'post type singular name', 'bangacams' ),
			'menu_name'          => _x( 'Cam Models', 'admin menu', 'bangacams' ),
			'name_admin_bar'     => _x( 'Cam Model', 'add new on admin bar', 'bangacams' ),
			'add_new'            => _x( 'Voeg Nieuwe Toe', 'cam_model', 'bangacams' ),
			'add_new_item'       => __( 'Voeg Nieuw Model Toe', 'bangacams' ),
			'new_item'           => __( 'Nieuw Model', 'bangacams' ),
			'edit_item'          => __( 'Bewerk Model', 'bangacams' ),
			'view_item'          => __( 'Bekijk Model', 'bangacams' ),
			'all_items'          => __( 'Alle Modellen', 'bangacams' ),
			'search_items'       => __( 'Zoek Modellen', 'bangacams' ),
			'not_found'          => __( 'Geen modellen gevonden.', 'bangacams' ),
			'not_found_in_trash' => __( 'Geen modellen gevonden in de prullenbak.', 'bangacams' )
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'models' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-camera',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true, // Gutenberg support
	) );

	// 2. Register Custom Post Type: cam_platform
	register_post_type( 'cam_platform', array(
		'labels'             => array(
			'name'               => _x( 'Platforms', 'post type general name', 'bangacams' ),
			'singular_name'      => _x( 'Platform', 'post type singular name', 'bangacams' ),
			'menu_name'          => _x( 'Platforms', 'admin menu', 'bangacams' ),
			'name_admin_bar'     => _x( 'Platform', 'add new on admin bar', 'bangacams' ),
			'add_new'            => _x( 'Voeg Nieuwe Toe', 'cam_platform', 'bangacams' ),
			'add_new_item'       => __( 'Voeg Nieuw Platform Toe', 'bangacams' ),
			'new_item'           => __( 'Nieuw Platform', 'bangacams' ),
			'edit_item'          => __( 'Bewerk Platform', 'bangacams' ),
			'view_item'          => __( 'Bekijk Platform', 'bangacams' ),
			'all_items'          => __( 'Alle Platforms', 'bangacams' ),
			'search_items'       => __( 'Zoek Platforms', 'bangacams' ),
			'not_found'          => __( 'Geen platforms gevonden.', 'bangacams' ),
			'not_found_in_trash' => __( 'Geen platforms gevonden in de prullenbak.', 'bangacams' )
		),
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array( 'slug' => 'platforms' ),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => 6,
		'menu_icon'          => 'dashicons-awards',
		'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt' ),
		'show_in_rest'       => true, // Gutenberg support
	) );

	// 3. Register Taxonomy: model_category
	register_taxonomy( 'model_category', array( 'cam_model' ), array(
		'hierarchical'      => true,
		'labels'            => array(
			'name'              => _x( 'Model Categorieën', 'taxonomy general name', 'bangacams' ),
			'singular_name'     => _x( 'Model Categorie', 'taxonomy singular name', 'bangacams' ),
			'search_items'      => __( 'Zoek Categorieën', 'bangacams' ),
			'all_items'         => __( 'Alle Categorieën', 'bangacams' ),
			'parent_item'       => __( 'Bovenliggende Categorie', 'bangacams' ),
			'parent_item_colon' => __( 'Bovenliggende Categorie:', 'bangacams' ),
			'edit_item'         => __( 'Bewerk Categorie', 'bangacams' ),
			'update_item'       => __( 'Update Categorie', 'bangacams' ),
			'add_new_item'      => __( 'Voeg Nieuwe Categorie Toe', 'bangacams' ),
			'new_item_name'     => __( 'Nieuwe Categorie Naam', 'bangacams' ),
			'menu_name'         => __( 'Model Categorieën', 'bangacams' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'model-category' ),
		'show_in_rest'      => true,
	) );

	// 4. Register Taxonomy: model_tag
	register_taxonomy( 'model_tag', array( 'cam_model' ), array(
		'hierarchical'      => false,
		'labels'            => array(
			'name'              => _x( 'Model Tags', 'taxonomy general name', 'bangacams' ),
			'singular_name'     => _x( 'Model Tag', 'taxonomy singular name', 'bangacams' ),
			'search_items'      => __( 'Zoek Tags', 'bangacams' ),
			'all_items'         => __( 'Alle Tags', 'bangacams' ),
			'edit_item'         => __( 'Bewerk Tag', 'bangacams' ),
			'update_item'       => __( 'Update Tag', 'bangacams' ),
			'add_new_item'      => __( 'Voeg Nieuwe Tag Toe', 'bangacams' ),
			'new_item_name'     => __( 'Nieuwe Tag Naam', 'bangacams' ),
			'menu_name'         => __( 'Model Tags', 'bangacams' ),
		),
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'model-tag' ),
		'show_in_rest'      => true,
	) );
}
add_action( 'init', 'bangacams_register_post_types_and_taxonomies' );

/**
 * Auto-inject Demo Data on Theme Activation
 */
function bangacams_import_demo_content() {
	if ( get_option( 'bangacams_demo_imported' ) === 'yes' ) {
		return;
	}

	// Make sure custom post types are registered before importing
	bangacams_register_post_types_and_taxonomies();

	// 1. IMPORT MODEL CATEGORIES & TAGS
	$categories_to_create = array( 'Live Girls', 'Couples', 'Amateur', 'Premium Shows', 'Free Cams' );
	$category_map = array();
	foreach ( $categories_to_create as $cat ) {
		$term = wp_insert_term( $cat, 'model_category' );
		if ( ! is_wp_error( $term ) ) {
			$category_map[ $cat ] = $term['term_id'];
		} else {
			$existing = get_term_by( 'name', $cat, 'model_category' );
			if ( $existing ) {
				$category_map[ $cat ] = $existing->term_id;
			}
		}
	}

	// 2. IMPORT BLOG POSTS
	$blog_articles = array(
		array(
			'title'   => 'Beste Live Cam Sites in 2026: De Ultieme Vergelijking & Review',
			'excerpt' => 'Ontdek de best geteste live webcam platforms van 2026. We vergelijken interface, modelkwaliteit, prijzen en privacy zodat je de beste keuze maakt.',
			'content' => "Het landschap van live webcam entertainment is in 2026 innovatiever en populairder dan ooit. Met de opkomst van interactieve toys, Ultra-HD 4K streaming en geavanceerde matching-algoritmen is er een platform voor werkelijk elke voorkeur.\n\nMaar welk platform sluit het beste aan bij jouw wensen en budget? In deze gids vergelijken we de absolute top-sites van dit jaar op basis van cruciale factoren zoals modelkwaliteit, videotechnologie, betrouwbaarheid en prijs.\n\n### 1. JerkMate: Het Beste voor Gepersonaliseerde Matches\nJerkMate heeft de markt veroverd met een unieke 'matching wizard'. In plaats van eindeloos scrollen door duizenden kamers, geef je vooraf je voorkeuren aan. Het platform koppelt je vervolgens direct aan modellen die perfect bij jouw smaak passen.\n\n* **Voordelen:** Razendsnelle matching, fantastische mobiele ervaring, zeer actieve community.\n* **Ideaal voor:** Gebruikers die direct actie willen zonder urenlang te zoeken.\n\n### 2. LiveJasmin: Ongekende Luxe en VIP Kwaliteit\nVoor wie op zoek is naar premium entertainment en absolute topmodellen, is LiveJasmin de gouden standaard. De nadruk ligt hier op discretie en extreem hoge videokwaliteit (vaak in 4K). De modellen zijn uiterst professioneel.\n\n* **Voordelen:** Kristalhelder beeld en geluid, de meest discrete betaalmethoden, luxueuze uitstraling.\n* **Ideaal voor:** Liefhebbers van exclusieve VIP privé-shows en top-tier verleiding.\n\n### 3. Chaturbate: De Koning van de Amateur Cams\nWil je liever een informele, interactieve en grotendeels gratis ervaring? Dan blijft Chaturbate de onbetwiste leider. Dankzij de open community streamen hier dagelijks tienduizenden onafhankelijke amateurs direct vanuit hun slaapkamer.\n\n* **Voordelen:** Gigantische diversiteit, interactieve chats, Lovense speelgoedkoppelingen waarmee kijkers direct de actie bepalen.\n* **Ideaal voor:** Liefhebbers van ongedwongen, rauwe amateur-actie en levendige chatrooms.",
			'author'  => 'Cam Expert Danny',
			'time'    => '6 min leestijd',
			'image'   => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=800&h=450',
		),
		array(
			'title'   => 'Hoe Werken Live Cam Platforms? Een Blik Achter de Schermen',
			'excerpt' => 'Van interactieve Lovense seksspeeltjes tot blockchain betalingen en private rooms. Leer alles over de techniek achter je favoriete cam-sites.',
			'content' => "Veel mensen bezoeken cam-sites voor het entertainment, maar staan zelden stil bij de indrukwekkende technologie die deze platforms draaiende houdt. Vandaag de dag zijn cam-sites pioniers op het gebied van realtime streaming en internet-interactiviteit.\n\n### Realtime Telemetrie & Interactief Speelgoed\nEen van de grootste revoluties van de afgelopen jaren is de integratie van teledildonica (op afstand bestuurbare seksspeeltjes). Modellen dragen toys die gekoppeld zijn aan de servers van het platform via Bluetooth en WebSockets.\n\nWanneer een kijker een bepaald aantal 'tokens' tipt, stuurt de server direct een signaal naar het speelgoed van het model om te vibreren of te pulseren. Dit creëert een ongekende, directe feedback-loop tussen kijker en model.\n\n### Privé-kamers (Private Rooms) en Groepsshows\nHoe werkt de verdeling tussen gratis streams en betaalde kamers?\n1. **Public Show:** Het model streamt gratis voor iedereen. Ze probeert tips te verzamelen om specifieke doelen (de 'tip menu goals') te behalen.\n2. **Spy Show:** Gebruikers betalen een klein aantal tokens per minuut om stiekem mee te kijken naar een show die het model voor iemand anders uitvoert.\n3. **Private Show:** Een 1-op-1 chat waarin het model uitsluitend jouw instructies opvolgt. Dit is volledig discreet en op maat gemaakt.",
			'author'  => 'Tech Analyst Bram',
			'time'    => '4 min leestijd',
			'image'   => 'https://images.unsplash.com/photo-1614850523459-c2f4c699c52e?auto=format&fit=crop&q=80&w=800&h=450',
		),
		array(
			'title'   => 'Top 10 Populairste Cam Modellen van dit Seizoen (2026)',
			'excerpt' => 'Wie trekken momenteel de meeste kijkers en krijgen de beste reviews? We zetten de meest trending live cam performers op een rij.',
			'content' => "Met tienduizenden actieve performers kan het lastig zijn om de echte pareltjes te vinden. Dit seizoen zien we een opvallende verschuiving naar ongedwongen amateurs en creatieve koppels die de kijkcijferlijsten domineren. Hier is onze top-selectie van modellen die je absoluut niet mag missen.\n\n### De Stijgende Sterren van dit Seizoen\n\n### 1. Luna Cherry (Live Girls)\nLuna is de onbetwiste favoriet op JerkMate. Met haar natuurlijke charme en uiterst actieve reactie op chatberichten heeft ze in korte tijd een gigantische fanbase opgebouwd. Ze is bijna dagelijks online en staat bekend om haar vrolijke energie.\n\n### 2. Sophia & Liam (Couples Koepel)\nEchte stelletjes zijn populairder dan ooit. Sophia en Liam stralen een pure chemie uit die je zelden vindt bij gescripte studio-shows. Hun interactieve massage- en passieshows zijn van absolute topklasse op LiveJasmin.\n\n### 3. Amateur Chloe (Spontane Amateurs)\nChloe bewijst dat je geen dure studio-verlichting nodig hebt om te fascineren. Haar streams vanuit haar knusse slaapkamer zijn puur, rauw en ontzettend interactief. Ze is een absolute aanrader op Chaturbate voor wie houdt van authentiek.",
			'author'  => 'Trends Redacteur Tess',
			'time'    => '5 min leestijd',
			'image'   => 'https://images.unsplash.com/photo-1618005198143-d3667c402b83?auto=format&fit=crop&q=80&w=800&h=450',
		)
	);

	foreach ( $blog_articles as $article ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $article['title'],
			'post_content' => $article['content'],
			'post_excerpt' => $article['excerpt'],
			'post_status'  => 'publish',
			'post_type'    => 'post'
		) );
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, 'blog_image_url', $article['image'] );
			update_post_meta( $post_id, 'blog_author', $article['author'] );
			update_post_meta( $post_id, 'blog_read_time', $article['time'] );
		}
	}

	// 3. IMPORT PLATFORMS
	$platforms_data = array(
		array(
			'title'        => 'JerkMate',
			'desc'         => 'JerkMate is een van de populairste cam-portals ter wereld. Het platform koppelt je direct aan de best passende modellen op basis van je persoonlijke voorkeuren via een interactief keuzesysteem.',
			'logo'         => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=150&h=150',
			'rating'       => 4.9,
			'aff_url'      => 'https://external.directlink.com/aff/jerkmate?subid=aistudio',
			'features'     => "Persoonlijke matching\nHD Video streaming\nGrote diversiteit aan modellen\nInteractieve speelgoedkoppeling",
			'pros'         => "Uiterst gebruiksvriendelijke interface\nVeel actieve live shows 24/7\nSnelle laadtijden op mobiel",
			'cons'         => "Sommige premium functies vereisen tokens\nGeen gratis proefversie voor alle VIP kamers",
			'signup_bonus' => 'Krijg direct 3 gratis credits bij aanmelding!',
			'category'     => 'Premium Cams'
		),
		array(
			'title'        => 'LiveJasmin',
			'desc'         => 'LiveJasmin staat bekend als de meest luxueuze en professionele webcam-site ter wereld. Ze focussen sterk op high-definition streams, discrete interactie en getrainde topmodellen.',
			'logo'         => 'https://images.unsplash.com/photo-1614850523459-c2f4c699c52e?auto=format&fit=crop&q=80&w=150&h=150',
			'rating'       => 4.8,
			'aff_url'      => 'https://external.directlink.com/aff/livejasmin?subid=aistudio',
			'features'     => "Ultra-HD 4K camera-kwaliteit\n100% discrete betalingen\nExclusieve VIP privé-shows\nMeertalige modellen",
			'pros'         => "Uitzonderlijk hoge video- en audiokwaliteit\nZeer professionele modellen\nUitstekende privacybescherming",
			'cons'         => "Gemiddeld iets duurder per minuut\nMinder focus op gratis amateur-content",
			'signup_bonus' => 'Meld je aan en ontvang €10 gratis speelgoed-tegoed!',
			'category'     => 'Premium Shows'
		),
		array(
			'title'        => 'Chaturbate',
			'desc'         => 'Chaturbate is de onbetwiste koning van de gratis amateur webcam-sites. Het platform is enorm populair vanwege het interactieve token-systeem en de gigantische community van onafhankelijke omroepers.',
			'logo'         => 'https://images.unsplash.com/photo-1579783900882-c0d3dad7b119?auto=format&fit=crop&q=80&w=150&h=150',
			'rating'       => 4.7,
			'aff_url'      => 'https://external.directlink.com/aff/chaturbate?subid=aistudio',
			'features'     => "Duizenden gratis streams\nInteractieve Lovense toys integratie\nActieve chat community\nEnorme variatie in genres",
			'pros'         => "Vrijwel alles is gratis te bekijken\nEnorme amateur community\nZeer interactief met tip-goals",
			'cons'         => "Veel advertenties en pop-ups\nKwaliteit van streams varieert sterk",
			'signup_bonus' => 'Maak een gratis account aan en chat direct live mee!',
			'category'     => 'Free Cams'
		),
		array(
			'title'        => 'CamSoda',
			'desc'         => 'CamSoda is een innovatief cam-platform dat bekend staat om technologische snufjes zoals VR-streams, interactieve toys en unieke evenementen met bekende sterren.',
			'logo'         => 'https://images.unsplash.com/photo-1618005198143-d3667c402b83?auto=format&fit=crop&q=80&w=150&h=150',
			'rating'       => 4.6,
			'aff_url'      => 'https://external.directlink.com/aff/camsoda?subid=aistudio',
			'features'     => "Virtual Reality (VR) ondersteuning\nSocial media integraties\nBitcoin & Crypto betalingen\nExclusieve fan-clubs",
			'pros'         => "Technologisch vooruitstrevend\nGeweldige mobiele app-ervaring\nLeuke gamification elementen",
			'cons'         => "VR-bril vereist voor VR-optie\nSoms overweldigend qua interface",
			'signup_bonus' => 'Ontvang direct 20 gratis tokens bij e-mailverificatie!',
			'category'     => 'Amateur Cams'
		),
		array(
			'title'        => 'Stripcash (Cam4 Network)',
			'desc'         => 'Stripcash is het officiële partnerprogramma van Cam4, een van de meest legendarische en bezochte amateur webcam-platforms ter wereld. Het herbergt miljoenen actieve shows en heeft een gigantisch bereik.',
			'logo'         => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=150&h=150',
			'rating'       => 4.8,
			'aff_url'      => 'https://external.directlink.com/aff/stripcash?subid=bangacams',
			'features'     => "Echt amateur webcam netwerk (Cam4)\nVolledige Lovense toy integratie\nWereldwijd bereik met miljoenen actieve leden\nSnel ladende live HD-streams",
			'pros'         => "Enorm hoge model-diversiteit uit alle werelddelen\nZeer betrouwbaar en gevestigd merk\nVeel gratis openbare streams beschikbaar",
			'cons'         => "Sommige streams hebben lagere resoluties door amateur-webcams\nChatrooms kunnen erg druk en levendig zijn",
			'signup_bonus' => 'Krijg gratis 50 tokens bij registratie via onze partnerlink!',
			'category'     => 'Amateur Cams'
		)
	);

	foreach ( $platforms_data as $plat ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $plat['title'],
			'post_content' => $plat['desc'],
			'post_status'  => 'publish',
			'post_type'    => 'cam_platform'
		) );
		if ( $post_id && ! is_wp_error( $post_id ) ) {
			update_post_meta( $post_id, 'platform_rating', $plat['rating'] );
			update_post_meta( $post_id, 'platform_logo_url', $plat['logo'] );
			update_post_meta( $post_id, 'platform_affiliate_url', $plat['aff_url'] );
			update_post_meta( $post_id, 'platform_signup_bonus', $plat['signup_bonus'] );
			update_post_meta( $post_id, 'platform_category', $plat['category'] );
			update_post_meta( $post_id, 'platform_features', $plat['features'] );
			update_post_meta( $post_id, 'platform_pros', $plat['pros'] );
			update_post_meta( $post_id, 'platform_cons', $plat['cons'] );
		}
	}

	// 4. IMPORT MODELS
	$models_data = array(
		array(
			'name'       => 'Luna Cherry',
			'image'      => 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Live Girls',
			'rating'     => 4.9,
			'aff_url'    => 'https://external.directlink.com/aff/jerkmate?subid=luna_cherry',
			'desc'       => 'Luna Cherry is een sprankelende en energieke 21-jarige studente die houdt van gezellig kletsen, dansen en interactieve shows. Ze reageert supersnel op tips en bouwt graag een hechte band op met haar kijkers.',
			'popularity' => 9800,
			'tags'       => array( 'Naughty', 'College', 'Brunette', 'Interactive Toy', 'HD' ),
			'isOnline'   => 'yes',
			'viewers'    => 1420,
			'platform'   => 'JerkMate',
			'age'        => 21,
			'country'    => 'Nederland',
			'languages'  => 'Nederlands, Engels'
		),
		array(
			'name'       => 'Sophia & Liam',
			'image'      => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Couples',
			'rating'     => 4.8,
			'aff_url'    => 'https://external.directlink.com/aff/livejasmin?subid=sophia_liam',
			'desc'       => 'Sophia en Liam zijn een echt koppel dat hun passie deelt op camera. Van romantische massages tot intense passie, hun shows zijn altijd puur, sensueel en vol interactie met het publiek.',
			'popularity' => 9500,
			'tags'       => array( 'Real Couple', 'Sensual', 'Romance', 'Hardcore', 'HD' ),
			'isOnline'   => 'yes',
			'viewers'    => 2850,
			'platform'   => 'LiveJasmin',
			'age'        => 24,
			'country'    => 'België',
			'languages'  => 'Nederlands, Frans, Engels'
		),
		array(
			'name'       => 'Amateur Chloe',
			'image'      => 'https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Amateur',
			'rating'     => 4.7,
			'aff_url'    => 'https://external.directlink.com/aff/chaturbate?subid=amateur_chloe',
			'desc'       => 'Chloe is een spontane meid die pas net is begonnen met streamen vanuit haar studentenkamer. Ze houdt van casual praatjes, ondeugende uitdagingen en is 100% onafhankelijk en ongefilterd.',
			'popularity' => 8900,
			'tags'       => array( 'Solo', 'Amateur', 'Blonde', 'Feet', 'Chatty' ),
			'isOnline'   => 'yes',
			'viewers'    => 940,
			'platform'   => 'Chaturbate',
			'age'        => 20,
			'country'    => 'Nederland',
			'languages'  => 'Nederlands, Engels'
		),
		array(
			'name'       => 'Elena Diamond',
			'image'      => 'https://images.unsplash.com/photo-1544005313-94ddf0286df2?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Premium Shows',
			'rating'     => 4.9,
			'aff_url'    => 'https://external.directlink.com/aff/livejasmin?subid=elena_diamond',
			'desc'       => 'Elena is een gecertificeerd internationaal topmodel. Ze biedt adembenemende high-class shows in een prachtige studio-omgeving. Voor liefhebbers van elegantie en pure verleiding.',
			'popularity' => 12400,
			'tags'       => array( 'High-Class', 'Studio', 'Lingerie', 'Elegant', 'VIP Exclusive' ),
			'isOnline'   => 'no',
			'viewers'    => 0,
			'platform'   => 'LiveJasmin',
			'age'        => 26,
			'country'    => 'Duitsland',
			'languages'  => 'Duits, Engels'
		),
		array(
			'name'       => 'Ruby Fox',
			'image'      => 'https://images.unsplash.com/photo-1524504388940-b1c1722653e1?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Free Cams',
			'rating'     => 4.6,
			'aff_url'    => 'https://external.directlink.com/aff/chaturbate?subid=ruby_fox',
			'desc'       => 'Ruby is een vrolijke roodharige die haar kijkers graag vermaakt met humor, een grote glimlach en interactieve speelgoeddoelen. Haar kamer is altijd druk, gezellig en vol actie.',
			'popularity' => 8100,
			'tags'       => array( 'Redhead', 'Free Stream', 'Tattoos', 'Cosplay', 'Loud' ),
			'isOnline'   => 'yes',
			'viewers'    => 1210,
			'platform'   => 'Chaturbate',
			'age'        => 23,
			'country'    => 'Engeland',
			'languages'  => 'Engels'
		),
		array(
			'name'       => 'Mila Sweet',
			'image'      => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Live Girls',
			'rating'     => 4.8,
			'aff_url'    => 'https://external.directlink.com/aff/jerkmate?subid=mila_sweet',
			'desc'       => 'Mila is een lieve, ondeugende brunette met een passie voor yoga en fitness. Ze laat graag haar flexibiliteit zien op camera en houdt van intieme privé-chats.',
			'popularity' => 9100,
			'tags'       => array( 'Fitness', 'Petite', 'Flexible', 'Sensual', 'Private Room' ),
			'isOnline'   => 'yes',
			'viewers'    => 850,
			'platform'   => 'JerkMate',
			'age'        => 22,
			'country'    => 'Nederland',
			'languages'  => 'Nederlands, Engels'
		),
		array(
			'name'       => 'Lily & Alex',
			'image'      => 'https://images.unsplash.com/photo-1513956589380-bad6acb9b9d4?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Couples',
			'rating'     => 4.7,
			'aff_url'    => 'https://external.directlink.com/aff/camsoda?subid=lily_alex',
			'desc'       => 'Lily en Alex zijn jonge avonturiers die ervan houden om nieuwe dingen uit te proberen voor de camera. Ze reageert op de wensen van hun publiek en houden van interactieve chatspellen.',
			'popularity' => 8300,
			'tags'       => array( 'Young Couple', 'Toys', 'Dutch', 'Amateur Couple', 'Fun' ),
			'isOnline'   => 'yes',
			'viewers'    => 1100,
			'platform'   => 'CamSoda',
			'age'        => 22,
			'country'    => 'Nederland',
			'languages'  => 'Nederlands, Engels'
		),
		array(
			'name'       => 'Amateur Emma',
			'image'      => 'https://images.unsplash.com/photo-1531746020798-e6953c6e8e04?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Amateur',
			'rating'     => 4.5,
			'aff_url'    => 'https://external.directlink.com/aff/chaturbate?subid=amateur_emma',
			'desc'       => 'Emma houdt van puur natuur. Ze streamt casual vanuit haar slaapkamer, zonder script en met een heerlijk nuchtere Nederlandse instelling. Perfect voor een gezellig en relaxed gesprek.',
			'popularity' => 7600,
			'tags'       => array( 'No Makeup', 'Natural', 'Chilled', 'BBW', 'Pierced' ),
			'isOnline'   => 'no',
			'viewers'    => 0,
			'platform'   => 'Chaturbate',
			'age'        => 25,
			'country'    => 'Nederland',
			'languages'  => 'Nederlands'
		),
		array(
			'name'       => 'Aria Rose',
			'image'      => 'https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Premium Shows',
			'rating'     => 4.9,
			'aff_url'    => 'https://external.directlink.com/aff/livejasmin?subid=aria_rose',
			'desc'       => 'Aria Rose is de belichaming van elegantie en passie. Ze straalt pure verleiding uit en verzorgt exclusieve, sensuele striptease- en fetishshows van de allerhoogste esthetische klasse.',
			'popularity' => 11500,
			'tags'       => array( 'Elegant', 'Fetish', 'Premium', 'Striptease', 'Red Heels' ),
			'isOnline'   => 'yes',
			'viewers'    => 1980,
			'platform'   => 'LiveJasmin',
			'age'        => 24,
			'country'    => 'Frankrijk',
			'languages'  => 'Frans, Engels'
		),
		array(
			'name'       => 'Zoe Sweet',
			'image'      => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Live Girls',
			'rating'     => 4.6,
			'aff_url'    => 'https://external.directlink.com/aff/camsoda?subid=zoe_sweet',
			'desc'       => 'Zoe is een vrolijke spring-in-het-veld die houdt van interactieve games. Ze koppelt haar toys aan de chat, wat betekent dat jij direct controle hebt over haar plezier. Super interactief!',
			'popularity' => 7900,
			'tags'       => array( 'Gamer', 'Interactive Toy', 'Cute', 'Blonde', 'Dutch' ),
			'isOnline'   => 'yes',
			'viewers'    => 720,
			'platform'   => 'CamSoda',
			'age'        => 19,
			'country'    => 'Nederland',
			'languages'  => 'Nederlands, Engels'
		),
		array(
			'name'       => 'Isabella Lust',
			'image'      => 'https://images.unsplash.com/photo-1488426862026-3ee34a7d66df?auto=format&fit=crop&q=80&w=600&h=800',
			'cat'        => 'Premium Shows',
			'rating'     => 4.8,
			'aff_url'    => 'https://external.directlink.com/aff/livejasmin?subid=isabella_lust',
			'desc'       => 'Isabella is een ervaren model die precies weet hoe ze haar publiek moet betoveren. Haar shows op LiveJasmin behoren tot de best gewaardeerde vanwege haar charismatische uitstraling.',
			'popularity' => 10200,
			'tags'       => array( 'Milf', 'Classy', 'Brunette', 'Sensual', 'High Definition' ),
			'isOnline'   => 'yes',
			'viewers'    => 1540,
			'platform'   => 'LiveJasmin',
			'age'        => 32,
			'country'    => 'België',
			'languages'  => 'Nederlands, Engels'
		),
		array(
			'name'       => 'Maya & Jaden',
			'image'      => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&q=80&w=600&h=800&sig=1',
			'cat'        => 'Couples',
			'rating'     => 4.7,
			'aff_url'    => 'https://external.directlink.com/aff/jerkmate?subid=maya_jaden',
			'desc'       => 'Maya en Jaden zijn onafscheidelijk en stralen pure intimiteit uit op camera. Ze nodigen kijkers uit om invloed uit te oefenen op hun spel via interactieve stemrondes en doelen.',
			'popularity' => 8800,
			'tags'       => array( 'Young Couple', 'Bi-Sexual', 'Interactive', 'Wild', 'HD' ),
			'isOnline'   => 'yes',
			'viewers'    => 1390,
			'platform'   => 'JerkMate',
			'age'        => 23,
			'country'    => 'Nederland',
			'languages'  => 'Nederlands, Engels'
		)
	);

	foreach ( $models_data as $mod ) {
		$post_id = wp_insert_post( array(
			'post_title'   => $mod['name'],
			'post_content' => $mod['desc'],
			'post_status'  => 'publish',
			'post_type'    => 'cam_model'
		) );

		if ( $post_id && ! is_wp_error( $post_id ) ) {
			// Set meta
			update_post_meta( $post_id, 'model_rating', $mod['rating'] );
			update_post_meta( $post_id, 'model_image_url', $mod['image'] );
			update_post_meta( $post_id, 'model_affiliate_url', $mod['aff_url'] );
			update_post_meta( $post_id, 'model_popularity', $mod['popularity'] );
			update_post_meta( $post_id, 'model_is_online', $mod['isOnline'] );
			update_post_meta( $post_id, 'model_viewers', $mod['viewers'] );
			update_post_meta( $post_id, 'model_platform', $mod['platform'] );
			update_post_meta( $post_id, 'model_age', $mod['age'] );
			update_post_meta( $post_id, 'model_country', $mod['country'] );
			update_post_meta( $post_id, 'model_languages', $mod['languages'] );

			// Assign taxonomy category
			if ( isset( $category_map[ $mod['cat'] ] ) ) {
				wp_set_object_terms( $post_id, $category_map[ $mod['cat'] ], 'model_category' );
			}

			// Assign tag terms
			$tag_ids = array();
			foreach ( $mod['tags'] as $tag_name ) {
				$term = wp_insert_term( $tag_name, 'model_tag' );
				if ( ! is_wp_error( $term ) ) {
					$tag_ids[] = $term['term_id'];
				} else {
					$existing = get_term_by( 'name', $tag_name, 'model_tag' );
					if ( $existing ) {
						$tag_ids[] = $existing->term_id;
					}
				}
			}
			if ( ! empty( $tag_ids ) ) {
				wp_set_object_terms( $post_id, $tag_ids, 'model_tag' );
			}
		}
	}

	// Set option so it doesn't run again
	update_option( 'bangacams_demo_imported', 'yes' );
}
add_action( 'after_switch_theme', 'bangacams_import_demo_content' );

/**
 * Filter search to include custom fields if desired, or make standard queries easier
 */
function bangacams_modify_archive_queries( $query ) {
	if ( is_admin() || ! $query->is_main_query() ) {
		return;
	}

	// For model archive: handle sorting and filtering
	if ( is_post_type_archive( 'cam_model' ) || is_tax( array( 'model_category', 'model_tag' ) ) ) {
		$query->set( 'posts_per_page', 12 );

		// Category filtering via query params
		if ( isset( $_GET['category_filter'] ) && ! empty( $_GET['category_filter'] ) ) {
			$query->set( 'tax_query', array(
				array(
					'taxonomy' => 'model_category',
					'field'    => 'slug',
					'terms'    => sanitize_text_field( $_GET['category_filter'] ),
				)
			) );
		}

		// Sorting via query params
		if ( isset( $_GET['sort_by'] ) ) {
			$sort_by = sanitize_text_field( $_GET['sort_by'] );
			if ( $sort_by === 'rating' ) {
				$query->set( 'meta_key', 'model_rating' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'DESC' );
			} elseif ( $sort_by === 'viewers' ) {
				$query->set( 'meta_key', 'model_viewers' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'DESC' );
			} else {
				// Default or popularity
				$query->set( 'meta_key', 'model_popularity' );
				$query->set( 'orderby', 'meta_value_num' );
				$query->set( 'order', 'DESC' );
			}
		} else {
			// Default sort by popularity
			$query->set( 'meta_key', 'model_popularity' );
			$query->set( 'orderby', 'meta_value_num' );
			$query->set( 'order', 'DESC' );
		}
	}
}
add_action( 'pre_get_posts', 'bangacams_modify_archive_queries' );

/**
 * 🔞 FORCE IMPORT STRIPCASH IF MISSING FROM DATABASE
 */
function bangacams_check_missing_platforms() {
	if ( ! is_admin() ) {
		return;
	}

	// List of default platforms to check
	$platforms_to_check = array(
		'Stripcash (Cam4 Network)' => array(
			'desc'         => 'Stripcash is het officiële partnerprogramma van Cam4, een van de meest legendarische en bezochte amateur webcam-platforms ter wereld. Het herbergt miljoenen actieve shows en heeft een gigantisch bereik.',
			'logo'         => 'https://images.unsplash.com/photo-1542751371-adc38448a05e?auto=format&fit=crop&q=80&w=150&h=150',
			'rating'       => 4.8,
			'aff_url'      => 'https://go.mavrtracktor.com?userId=9f36d6bb3a6d8f68c7be616b155ceed95fcef32e4b3e209377544ac458b157a2',
			'features'     => "Echt amateur webcam netwerk (Cam4)\nVolledige Lovense toy integratie\nWereldwijd bereik met miljoenen active leden\nSnel ladende live HD-streams",
			'pros'         => "Enorm hoge model-diversiteit uit alle werelddelen\nZeer betrouwbaar en gevestigd merk\nVeel gratis openbare streams beschikbaar",
			'cons'         => "Sommige streams hebben lagere resoluties door amateur-webcams\nChatrooms kunnen erg druk en levendig zijn",
			'signup_bonus' => 'Krijg gratis 50 tokens bij registratie via onze partnerlink!',
			'category'     => 'Amateur Cams'
		)
	);

	foreach ( $platforms_to_check as $title => $plat ) {
		// Try to query the post by title
		$existing = get_page_by_title( $title, OBJECT, 'cam_platform' );
		if ( ! $existing ) {
			$post_id = wp_insert_post( array(
				'post_title'   => $title,
				'post_content' => $plat['desc'],
				'post_status'  => 'publish',
				'post_type'    => 'cam_platform'
			) );
			if ( $post_id && ! is_wp_error( $post_id ) ) {
				update_post_meta( $post_id, 'platform_rating', $plat['rating'] );
				update_post_meta( $post_id, 'platform_logo_url', $plat['logo'] );
				update_post_meta( $post_id, 'platform_affiliate_url', $plat['aff_url'] );
				update_post_meta( $post_id, 'platform_signup_bonus', $plat['signup_bonus'] );
				update_post_meta( $post_id, 'platform_category', $plat['category'] );
				update_post_meta( $post_id, 'platform_features', $plat['features'] );
				update_post_meta( $post_id, 'platform_pros', $plat['pros'] );
				update_post_meta( $post_id, 'platform_cons', $plat['cons'] );
			}
		}
	}
}
add_action( 'admin_init', 'bangacams_check_missing_platforms' );

/**
 * 🔞 ADD BEAUTIFUL CUSTOM METABOXES FOR MODELS AND PLATFORMS
 */
function bangacams_add_custom_meta_boxes() {
	// 1. Model Details Metabox
	add_meta_box(
		'bangacams_model_meta',
		__( 'Model Details & Affiliate Links', 'bangacams' ),
		'bangacams_render_model_meta_box',
		'cam_model',
		'normal',
		'high'
	);

	// 2. Platform Details Metabox
	add_meta_box(
		'bangacams_platform_meta',
		__( 'Platform Details & Reviews', 'bangacams' ),
		'bangacams_render_platform_meta_box',
		'cam_platform',
		'normal',
		'high'
	);
}
add_action( 'add_meta_boxes', 'bangacams_add_custom_meta_boxes' );

// Render Model Meta Box Input Fields
function bangacams_render_model_meta_box( $post ) {
	wp_nonce_field( 'bangacams_save_model_meta', 'bangacams_model_meta_nonce' );

	$age           = get_post_meta( $post->ID, 'model_age', true );
	$country       = get_post_meta( $post->ID, 'model_country', true );
	$languages     = get_post_meta( $post->ID, 'model_languages', true );
	$platform      = get_post_meta( $post->ID, 'model_platform', true );
	$affiliate_url = get_post_meta( $post->ID, 'model_affiliate_url', true );
	$rating        = get_post_meta( $post->ID, 'model_rating', true );
	$is_online     = get_post_meta( $post->ID, 'model_is_online', true );
	$viewers       = get_post_meta( $post->ID, 'model_viewers', true );
	$popularity    = get_post_meta( $post->ID, 'model_popularity', true );
	$image_url     = get_post_meta( $post->ID, 'model_image_url', true );

	if ( empty( $rating ) ) $rating = '4.5';
	if ( empty( $popularity ) ) $popularity = '5000';
	if ( empty( $viewers ) ) $viewers = '0';
	if ( empty( $is_online ) ) $is_online = 'no';

	// Query all platforms registered in WP to make linking easy!
	$platforms_posts = get_posts( array(
		'post_type'      => 'cam_platform',
		'posts_per_page' => -1,
		'post_status'    => 'publish',
	) );

	$default_platforms = array( 'Chaturbate', 'Stripcash', 'LiveJasmin', 'JerkMate', 'CamSoda' );
	?>
	<style>
		.bangacams-meta-grid {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 20px;
			margin-top: 10px;
		}
		.bangacams-meta-field {
			margin-bottom: 15px;
		}
		.bangacams-meta-field label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
		.bangacams-meta-field input[type="text"],
		.bangacams-meta-field input[type="number"],
		.bangacams-meta-field input[type="url"],
		.bangacams-meta-field select {
			width: 100%;
			padding: 8px;
			box-sizing: border-box;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
		.bangacams-meta-desc {
			font-size: 11px;
			color: #666;
			margin-top: 3px;
		}
	</style>

	<div class="bangacams-meta-grid">
		<div class="bangacams-meta-column">
			<!-- Platform selection -->
			<div class="bangacams-meta-field">
				<label for="model_platform"><?php _e( 'Gekoppeld Platform (Partner)', 'bangacams' ); ?></label>
				<select id="model_platform" name="model_platform">
					<option value=""><?php _e( '-- Selecteer Platform --', 'bangacams' ); ?></option>
					<?php 
					if ( ! empty( $platforms_posts ) ) :
						foreach ( $platforms_posts as $p_post ) :
							$p_title = $p_post->post_title;
							// Clean up names if brackets exist to match frontend lookup
							$clean_title = trim(str_replace( ' (Cam4 Network)', '', $p_title ));
							?>
							<option value="<?php echo esc_attr( $clean_title ); ?>" <?php selected( $platform, $clean_title ); ?>>
								<?php echo esc_html( $p_title ); ?>
							</option>
						<?php 
						endforeach;
					else :
						foreach ( $default_platforms as $def_plat ) :
							?>
							<option value="<?php echo esc_attr( $def_plat ); ?>" <?php selected( $platform, $def_plat ); ?>>
								<?php echo esc_html( $def_plat ); ?>
							</option>
							<?php
						endforeach;
					endif;
					?>
				</select>
				<p class="bangacams-meta-desc"><?php _e( 'Selecteer het platform waarop dit model streamt. Dit linkt dit model direct aan het juiste partnernetwerk op de website.', 'bangacams' ); ?></p>
			</div>

			<!-- Affiliate URL -->
			<div class="bangacams-meta-field">
				<label for="model_affiliate_url"><?php _e( 'Model Affiliate / Partner Link', 'bangacams' ); ?></label>
				<input type="url" id="model_affiliate_url" name="model_affiliate_url" value="<?php echo esc_url( $affiliate_url ); ?>" placeholder="https://..." />
				<p class="bangacams-meta-desc"><?php _e( 'De specifieke affiliate/hoplink link naar de stream van dit model waarmee je commissie verdient.', 'bangacams' ); ?></p>
			</div>

			<!-- External Image URL -->
			<div class="bangacams-meta-field">
				<label for="model_image_url"><?php _e( 'Aangepaste Model Afbeeldings URL', 'bangacams' ); ?></label>
				<input type="text" id="model_image_url" name="model_image_url" value="<?php echo esc_url( $image_url ); ?>" placeholder="https://..." />
				<p class="bangacams-meta-desc"><?php _e( 'Indien leeg, gebruikt de site de standaard WordPress Featured Image (Uitgelichte Afbeelding).', 'bangacams' ); ?></p>
			</div>

			<!-- Rating -->
			<div class="bangacams-meta-field">
				<label for="model_rating"><?php _e( 'Beoordeling / Rating (0.0 - 5.0)', 'bangacams' ); ?></label>
				<input type="text" id="model_rating" name="model_rating" value="<?php echo esc_attr( $rating ); ?>" placeholder="4.8" />
			</div>

			<!-- Is Online dropdown -->
			<div class="bangacams-meta-field">
				<label for="model_is_online"><?php _e( 'Is Online?', 'bangacams' ); ?></label>
				<select id="model_is_online" name="model_is_online">
					<option value="yes" <?php selected( $is_online, 'yes' ); ?>><?php _e( 'Ja, Nu Live', 'bangacams' ); ?></option>
					<option value="no" <?php selected( $is_online, 'no' ); ?>><?php _e( 'Nee, Offline', 'bangacams' ); ?></option>
				</select>
			</div>
		</div>

		<div class="bangacams-meta-column">
			<!-- Age -->
			<div class="bangacams-meta-field">
				<label for="model_age"><?php _e( 'Leeftijd (Age)', 'bangacams' ); ?></label>
				<input type="number" id="model_age" name="model_age" value="<?php echo esc_attr( $age ); ?>" placeholder="21" />
			</div>

			<!-- Country -->
			<div class="bangacams-meta-field">
				<label for="model_country"><?php _e( 'Land van Herkomst (Country)', 'bangacams' ); ?></label>
				<input type="text" id="model_country" name="model_country" value="<?php echo esc_attr( $country ); ?>" placeholder="Nederland" />
			</div>

			<!-- Languages -->
			<div class="bangacams-meta-field">
				<label for="model_languages"><?php _e( 'Gesproken Talen (Languages)', 'bangacams' ); ?></label>
				<input type="text" id="model_languages" name="model_languages" value="<?php echo esc_attr( $languages ); ?>" placeholder="Nederlands, Engels" />
				<p class="bangacams-meta-desc"><?php _e( 'Komma-gescheiden lijst met talen.', 'bangacams' ); ?></p>
			</div>

			<!-- Viewers -->
			<div class="bangacams-meta-field">
				<label for="model_viewers"><?php _e( 'Aantal Actieve Kijkers', 'bangacams' ); ?></label>
				<input type="number" id="model_viewers" name="model_viewers" value="<?php echo esc_attr( $viewers ); ?>" placeholder="1250" />
			</div>

			<!-- Popularity index -->
			<div class="bangacams-meta-field">
				<label for="model_popularity"><?php _e( 'Populariteits-index (Sorteer volgorde)', 'bangacams' ); ?></label>
				<input type="number" id="model_popularity" name="model_popularity" value="<?php echo esc_attr( $popularity ); ?>" placeholder="9500" />
				<p class="bangacams-meta-desc"><?php _e( 'Hogere getallen verschijnen bovenaan op de homepage.', 'bangacams' ); ?></p>
			</div>
		</div>
	</div>
	<?php
}

// Render Platform Meta Box Input Fields
function bangacams_render_platform_meta_box( $post ) {
	wp_nonce_field( 'bangacams_save_platform_meta', 'bangacams_platform_meta_nonce' );

	$rating       = get_post_meta( $post->ID, 'platform_rating', true );
	$logo_url     = get_post_meta( $post->ID, 'platform_logo_url', true );
	$aff_url      = get_post_meta( $post->ID, 'platform_affiliate_url', true );
	$signup_bonus = get_post_meta( $post->ID, 'platform_signup_bonus', true );
	$category     = get_post_meta( $post->ID, 'platform_category', true );
	$features     = get_post_meta( $post->ID, 'platform_features', true );
	$pros         = get_post_meta( $post->ID, 'platform_pros', true );
	$cons         = get_post_meta( $post->ID, 'platform_cons', true );

	if ( empty( $rating ) ) $rating = '4.5';
	?>
	<style>
		.bangacams-platform-grid {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 20px;
			margin-top: 10px;
		}
		.bangacams-meta-field {
			margin-bottom: 15px;
		}
		.bangacams-meta-field label {
			display: block;
			font-weight: bold;
			margin-bottom: 5px;
		}
		.bangacams-meta-field input[type="text"],
		.bangacams-meta-field input[type="url"],
		.bangacams-meta-field textarea {
			width: 100%;
			padding: 8px;
			box-sizing: border-box;
			border: 1px solid #ccc;
			border-radius: 4px;
		}
		.bangacams-meta-field textarea {
			height: 100px;
			font-family: monospace;
			font-size: 12px;
		}
		.bangacams-meta-desc {
			font-size: 11px;
			color: #666;
			margin-top: 3px;
		}
	</style>

	<div class="bangacams-platform-grid">
		<div class="bangacams-meta-column">
			<!-- Platform Category -->
			<div class="bangacams-meta-field">
				<label for="platform_category"><?php _e( 'Platform Categorie', 'bangacams' ); ?></label>
				<input type="text" id="platform_category" name="platform_category" value="<?php echo esc_attr( $category ); ?>" placeholder="Amateur Cams" />
				<p class="bangacams-meta-desc"><?php _e( 'Bijv: Free Cams, Amateur Cams, Premium Shows.', 'bangacams' ); ?></p>
			</div>

			<!-- Logo URL -->
			<div class="bangacams-meta-field">
				<label for="platform_logo_url"><?php _e( 'Logo Afbeeldings URL', 'bangacams' ); ?></label>
				<input type="text" id="platform_logo_url" name="platform_logo_url" value="<?php echo esc_url( $logo_url ); ?>" placeholder="https://..." />
			</div>

			<!-- General Affiliate Link -->
			<div class="bangacams-meta-field">
				<label for="platform_affiliate_url"><?php _e( 'Algemene Platform Affiliate / Registratie Link', 'bangacams' ); ?></label>
				<input type="url" id="platform_affiliate_url" name="platform_affiliate_url" value="<?php echo esc_url( $aff_url ); ?>" placeholder="https://..." />
				<p class="bangacams-meta-desc"><?php _e( 'De hoofdlink voor de reviews en bezoek platform knoppen waarmee je commissie verdient.', 'bangacams' ); ?></p>
			</div>

			<!-- Signup Bonus -->
			<div class="bangacams-meta-field">
				<label for="platform_signup_bonus"><?php _e( 'Aanmeldingsbonus Tekst', 'bangacams' ); ?></label>
				<input type="text" id="platform_signup_bonus" name="platform_signup_bonus" value="<?php echo esc_attr( $signup_bonus ); ?>" placeholder="Krijg direct 3 gratis credits!" />
			</div>

			<!-- Rating -->
			<div class="bangacams-meta-field">
				<label for="platform_rating"><?php _e( 'Beoordeling / Rating (0.0 - 5.0)', 'bangacams' ); ?></label>
				<input type="text" id="platform_rating" name="platform_rating" value="<?php echo esc_attr( $rating ); ?>" placeholder="4.9" />
			</div>
		</div>

		<div class="bangacams-meta-column">
			<!-- Features list -->
			<div class="bangacams-meta-field">
				<label for="platform_features"><?php _e( 'Kenmerken / Features (Eén per regel)', 'bangacams' ); ?></label>
				<textarea id="platform_features" name="platform_features" placeholder="Uitzonderlijke kwaliteit&#10;Grote community"><?php echo esc_textarea( $features ); ?></textarea>
			</div>

			<!-- Pros list -->
			<div class="bangacams-meta-field">
				<label for="platform_pros"><?php _e( 'Pluspunten (Pros) (Eén per regel)', 'bangacams' ); ?></label>
				<textarea id="platform_pros" name="platform_pros" placeholder="Grootste aanbod aan gratis cams&#10;24/7 online shows"><?php echo esc_textarea( $pros ); ?></textarea>
			</div>

			<!-- Cons list -->
			<div class="bangacams-meta-field">
				<label for="platform_cons"><?php _e( 'Minpunten (Cons) (Eén per regel)', 'bangacams' ); ?></label>
				<textarea id="platform_cons" name="platform_cons" placeholder="Hoge token prijzen&#10;Veel drukte"><?php echo esc_textarea( $cons ); ?></textarea>
			</div>
		</div>
	</div>
	<?php
}

// Save Model Meta Box Data on post update
function bangacams_save_model_meta_data( $post_id ) {
	if ( ! isset( $_POST['bangacams_model_meta_nonce'] ) || ! wp_verify_nonce( $_POST['bangacams_model_meta_nonce'], 'bangacams_save_model_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys_to_save = array(
		'model_age'           => 'sanitize_text_field',
		'model_country'       => 'sanitize_text_field',
		'model_languages'     => 'sanitize_text_field',
		'model_platform'      => 'sanitize_text_field',
		'model_affiliate_url' => 'esc_url_raw',
		'model_rating'        => 'sanitize_text_field',
		'model_is_online'     => 'sanitize_text_field',
		'model_viewers'       => 'sanitize_text_field',
		'model_popularity'    => 'sanitize_text_field',
		'model_image_url'     => 'esc_url_raw',
	);

	foreach ( $keys_to_save as $key => $sanitize_func ) {
		if ( isset( $_POST[ $key ] ) ) {
			$value = call_user_func( $sanitize_func, $_POST[ $key ] );
			update_post_meta( $post_id, $key, $value );
		}
	}
}
add_action( 'save_post_cam_model', 'bangacams_save_model_meta_data' );

// Save Platform Meta Box Data on post update
function bangacams_save_platform_meta_data( $post_id ) {
	if ( ! isset( $_POST['bangacams_platform_meta_nonce'] ) || ! wp_verify_nonce( $_POST['bangacams_platform_meta_nonce'], 'bangacams_save_platform_meta' ) ) {
		return;
	}

	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	$keys_to_save = array(
		'platform_rating'          => 'sanitize_text_field',
		'platform_logo_url'        => 'esc_url_raw',
		'platform_affiliate_url'   => 'esc_url_raw',
		'platform_signup_bonus'    => 'sanitize_text_field',
		'platform_category'        => 'sanitize_text_field',
		'platform_features'        => 'sanitize_textarea_field',
		'platform_pros'            => 'sanitize_textarea_field',
		'platform_cons'            => 'sanitize_textarea_field',
	);

	foreach ( $keys_to_save as $key => $sanitize_func ) {
		if ( isset( $_POST[ $key ] ) ) {
			$value = call_user_func( $sanitize_func, $_POST[ $key ] );
			update_post_meta( $post_id, $key, $value );
		}
	}
}
add_action( 'save_post_cam_platform', 'bangacams_save_platform_meta_data' );
