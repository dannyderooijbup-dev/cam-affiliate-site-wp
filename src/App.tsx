import React, { useState, useMemo, useEffect } from 'react';
import { 
  Flame, 
  Layers, 
  Award, 
  BookOpen, 
  Star, 
  Eye, 
  Tv, 
  ArrowLeft, 
  ExternalLink, 
  Sparkles, 
  Globe, 
  ShieldAlert, 
  TrendingUp, 
  Heart, 
  ChevronRight,
  Filter,
  CheckCircle2,
  Clock,
  ThumbsUp,
  FolderOpen,
  Terminal,
  Download,
  Check,
  FileCode,
  AlertTriangle,
  FileText,
  Settings,
  HelpCircle
} from 'lucide-react';
import { motion, AnimatePresence } from 'motion/react';

import { CamModel, CamPlatform } from './types';
import { MOCK_MODELS, MOCK_PLATFORMS } from './data';

import Header from './components/Header';
import Hero from './components/Hero';
import ModelCard from './components/ModelCard';
import PlatformReview from './components/PlatformReview';
import BlogSection from './components/BlogSection';

// Theme files source code for the developer dashboard
const THEME_FILES_DOCUMENTATION = [
  {
    name: 'style.css',
    description: 'The theme stylesheet containing WordPress Metadata, custom font imports, and core theme configuration.',
    language: 'css',
    code: `/*
Theme Name: BangaCams Affiliate Directory
Theme URI: https://bangacams.com/
Author: BangaCams Team
Author URI: https://bangacams.com/team
Description: A modern, responsive, high-performance affiliate platform for webcam directory and live cam platform reviews. Standard Dark Mode, Netflix-style layout, SEO optimized, fully compatible with WordPress 6+ and Gutenberg editor.
Version: 1.0.0
License: GNU General Public License v2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: bangacams
Tags: black, dark, red, translation-ready, full-width-template, grid-layout, custom-menu, featured-images
*/

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@500;750;800;900&family=JetBrains+Mono:wght@400;500;700&display=swap');

/* Global Reset & Base Typography */
body {
	font-family: 'Inter', sans-serif;
	background-color: #09090b;
	color: #f4f4f5;
	margin: 0;
	padding: 0;
}`
  },
  {
    name: 'functions.php',
    description: 'Core engine file registering custom post types, taxonomies, Tailwind asset loading, and the automatic high-fidelity demo data generator.',
    language: 'php',
    code: `<?php
/**
 * BangaCams functions and definitions
 *
 * @package BangaCams
 */

if ( ! function_exists( 'bangacams_setup' ) ) :
	function bangacams_setup() {
		// Standard theme support
		add_theme_support( 'title-tag' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
		
		// Nav menus
		register_nav_menus( array(
			'primary-menu' => esc_html__( 'Primary Header Menu', 'bangacams' ),
			'footer-menu'  => esc_html__( 'Footer Navigation Menu', 'bangacams' ),
		) );
	}
endif;
add_action( 'after_setup_theme', 'bangacams_setup' );

// Register Cam Model & Cam Platform Custom Post Types...
// Includes automatic mock data import upon activation!`
  },
  {
    name: 'header.php',
    description: 'The template header containing the document head, Tailwind Play CDN configuration, logo, desktop links, and active state checkers.',
    language: 'php',
    code: `<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
	<script src="https://cdn.tailwindcss.com"></script>
	<script>
		tailwind.config = {
			theme: {
				extend: {
					fontFamily: {
						sans: ['Inter', 'sans-serif'],
						display: ['Space Grotesk', 'sans-serif'],
					},
					colors: {
						bordeaux: { 500: '#f43f5e', 800: '#881337', 950: '#40010c' }
					}
				}
			}
		}
	</script>
</head>`
  },
  {
    name: 'index.php',
    description: 'Main landing page template displaying the modern Hero Section, Category Bento selector, Trending Live shows, and Platform reviews.',
    language: 'php',
    code: `<?php
/**
 * The main template file: Home Page
 */
get_header(); ?>
<main id="primary" class="site-main">
	<!-- Hero Banner -->
	<section class="relative overflow-hidden bg-gradient-to-b from-bordeaux-950/60 to-zinc-950 py-24">
		<!-- Dynamic query & grid loops for models & platforms... -->
	</section>
</main>
<?php get_footer(); ?>`
  },
  {
    name: 'archive-cam_model.php',
    description: 'The grid explorer archive page which maps model categories, filters, search indicators, and viewer/rating query parameters.',
    language: 'php',
    code: `<?php
/**
 * The template for displaying Cam Models Archive page (All Cams page)
 */
get_header();
// Sort and Category Filters...
if ( have_posts() ) : ?>
	<div class="grid gap-4 grid-cols-2 md:grid-cols-4 lg:grid-cols-6">
		<?php while ( have_posts() ) : the_post(); ?>
			<!-- Compact Custom Cam Cards -->
		<?php endwhile; ?>
	</div>
<?php endif; ?>
<?php get_footer(); ?>`
  },
  {
    name: 'single-cam_model.php',
    description: 'Single profile display containing biography specs, verified badges, specs grid, and the Related Models recommendations.',
    language: 'php',
    code: `<?php
/**
 * Single Cam Model Profile Template
 */
get_header(); ?>
<!-- 12-Column Split: Image, Watch Live CTA, Biography Specs, Tags -->
<main class="site-main py-12">
	<!-- Model Profile Details -->
</main>
<?php get_footer(); ?>`
  }
];

export default function App() {
  const [dashboardTab, setDashboardTab] = useState<'preview' | 'installer'>('preview');
  const [activeTab, setActiveTab] = useState<string>('home'); // 'home' | 'categories' | 'platforms' | 'blog'
  const [selectedModel, setSelectedModel] = useState<CamModel | null>(null);
  const [searchQuery, setSearchQuery] = useState<string>('');
  const [selectedCategory, setSelectedCategory] = useState<string | null>(null);
  const [sortBy, setSortBy] = useState<string>('popularity'); // 'popularity' | 'rating' | 'viewers'
  const [activeThemeFile, setActiveThemeFile] = useState<number>(0);

  // Scroll to top on navigation or detail view change
  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, [activeTab, selectedModel, dashboardTab]);

  // Categories list
  const categories = ['Live Girls', 'Couples', 'Amateur', 'Premium Shows', 'Free Cams'];

  // Filter models based on search query AND active category filter
  const filteredModels = useMemo(() => {
    return MOCK_MODELS.filter((model) => {
      const matchesSearch = 
        model.name.toLowerCase().includes(searchQuery.toLowerCase()) ||
        model.category.toLowerCase().includes(searchQuery.toLowerCase()) ||
        model.tags.some(tag => tag.toLowerCase().includes(searchQuery.toLowerCase())) ||
        model.platform.toLowerCase().includes(searchQuery.toLowerCase());

      const matchesCategory = selectedCategory ? model.category === selectedCategory : true;

      return matchesSearch && matchesCategory;
    });
  }, [searchQuery, selectedCategory]);

  // Sort filtered models
  const sortedAndFilteredModels = useMemo(() => {
    const modelsCopy = [...filteredModels];
    if (sortBy === 'popularity') {
      return modelsCopy.sort((a, b) => b.popularity - a.popularity);
    } else if (sortBy === 'rating') {
      return modelsCopy.sort((a, b) => b.rating - a.rating);
    } else if (sortBy === 'viewers') {
      return modelsCopy.sort((a, b) => b.viewers - a.viewers);
    }
    return modelsCopy;
  }, [filteredModels, sortBy]);

  // Trending models for homepage (highest 12 popularity or viewers)
  const trendingModels = useMemo(() => {
    return [...MOCK_MODELS]
      .sort((a, b) => b.popularity - a.popularity)
      .slice(0, 12);
  }, []);

  // Category selection handler on homepage
  const handleCategoryClick = (category: string) => {
    setSelectedCategory(category);
    setActiveTab('categories');
  };

  // Model click handler
  const handleModelClick = (model: CamModel) => {
    setSelectedModel(model);
  };

  // Models in the same category for Detail Page "More Models Like This"
  const relatedModels = useMemo(() => {
    if (!selectedModel) return [];
    return MOCK_MODELS
      .filter((m) => m.category === selectedModel.category && m.id !== selectedModel.id)
      .slice(0, 6);
  }, [selectedModel]);

  // Quick navigation helpers
  const handleExploreCamsClick = () => {
    setActiveTab('categories');
    setSelectedCategory(null);
  };

  return (
    <div className="min-h-screen flex flex-col bg-zinc-950 text-zinc-100">
      
      {/* 🚀 WordPress Theme Developer Dashboard Panel */}
      <div className="bg-zinc-950 border-b border-zinc-900 sticky top-0 z-50 shadow-xl shadow-black/40">
        <div className="mx-auto max-w-7xl px-4 py-3.5 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
          
          <div className="flex items-center space-x-3 text-center sm:text-left">
            <div className="h-9 w-9 rounded-xl bg-gradient-to-tr from-bordeaux-800 to-bordeaux-600 flex items-center justify-center text-white font-black text-sm border border-bordeaux-500/20 shadow-md shadow-bordeaux-950/50">
              WP
            </div>
            <div>
              <div className="flex items-center space-x-2 justify-center sm:justify-start">
                <span className="text-xs font-black tracking-widest text-bordeaux-400 uppercase">WordPress Theme Compiled</span>
                <span className="h-1.5 w-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
              </div>
              <p class="text-xs text-zinc-400 font-semibold mt-0.5">
                BangaCams theme package has been generated successfully!
              </p>
            </div>
          </div>

          <div className="flex items-center space-x-2 bg-zinc-900 p-1 rounded-xl border border-zinc-800">
            <button 
              onClick={() => setDashboardTab('preview')}
              className={`rounded-lg px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer flex items-center space-x-1.5 ${
                dashboardTab === 'preview' 
                  ? 'bg-bordeaux-850 text-white shadow shadow-bordeaux-950/50' 
                  : 'text-zinc-400 hover:text-zinc-200'
              }`}
            >
              <Tv className="h-3.5 w-3.5" />
              <span>Live Mock Preview</span>
            </button>
            <button 
              onClick={() => setDashboardTab('installer')}
              className={`rounded-lg px-3.5 py-1.5 text-xs font-bold transition-all cursor-pointer flex items-center space-x-1.5 ${
                dashboardTab === 'installer' 
                  ? 'bg-bordeaux-850 text-white shadow shadow-bordeaux-950/50' 
                  : 'text-zinc-400 hover:text-zinc-200'
              }`}
            >
              <FolderOpen className="h-3.5 w-3.5" />
              <span>Theme Files & Guide</span>
            </button>
          </div>

        </div>
      </div>

      {dashboardTab === 'installer' ? (
        /* ==================== 📁 WORDPRESS FILES & INSTALLER GUIDE ==================== */
        <div className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 flex-1 flex flex-col justify-center">
          
          <div className="grid gap-10 lg:grid-cols-12 items-start">
            
            {/* Left sidebar: File Tree Explorer */}
            <div className="lg:col-span-4 space-y-6">
              
              <div className="rounded-2xl border border-zinc-900 bg-zinc-900/10 p-5">
                <div className="flex items-center space-x-2 text-zinc-300 font-bold text-sm mb-4 pb-3 border-b border-zinc-900">
                  <Terminal className="h-4.5 w-4.5 text-bordeaux-500" />
                  <span>WordPress Theme Files</span>
                </div>

                <div className="space-y-1.5">
                  <div className="text-[10px] text-zinc-600 font-extrabold uppercase tracking-widest pl-2 mb-2">Folder: /bangacams</div>
                  
                  {THEME_FILES_DOCUMENTATION.map((file, idx) => (
                    <button
                      key={file.name}
                      onClick={() => setActiveThemeFile(idx)}
                      className={`w-full flex items-center justify-between text-left px-3.5 py-3 rounded-xl text-xs font-bold transition-all border cursor-pointer ${
                        activeThemeFile === idx 
                          ? 'bg-bordeaux-950/30 text-bordeaux-300 border-bordeaux-800/40' 
                          : 'bg-transparent text-zinc-400 hover:bg-zinc-900/50 hover:text-zinc-200 border-transparent'
                      }`}
                    >
                      <div className="flex items-center space-x-2 truncate">
                        <FileCode className={`h-4 w-4 ${activeThemeFile === idx ? 'text-bordeaux-400' : 'text-zinc-600'}`} />
                        <span className="truncate">{file.name}</span>
                      </div>
                      <ChevronRight className="h-3.5 w-3.5 opacity-50" />
                    </button>
                  ))}
                </div>
              </div>

              {/* Install and Export Quick-Guide */}
              <div className="rounded-2xl border border-zinc-900 bg-zinc-900/10 p-5">
                <div className="flex items-center space-x-2 text-zinc-300 font-bold text-sm mb-4 pb-3 border-b border-zinc-900">
                  <HelpCircle className="h-4.5 w-4.5 text-bordeaux-500" />
                  <span>How to Download Theme</span>
                </div>
                
                <div className="space-y-4 text-xs font-light text-zinc-400 leading-relaxed">
                  <div className="flex items-start space-x-2.5">
                    <span className="h-5 w-5 rounded-full bg-zinc-900 border border-zinc-800 text-[10px] font-bold text-zinc-300 flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                    <span>Click the standard AI Studio <strong>Settings</strong> gear or <strong>Export menu</strong> in the top right.</span>
                  </div>
                  <div className="flex items-start space-x-2.5">
                    <span className="h-5 w-5 rounded-full bg-zinc-900 border border-zinc-800 text-[10px] font-bold text-zinc-300 flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                    <span>Select <strong>Export to ZIP</strong>. This packages the entire workspace, including the complete ready-to-upload <code>/bangacams</code> theme folder.</span>
                  </div>
                  <div className="flex items-start space-x-2.5">
                    <span className="h-5 w-5 rounded-full bg-zinc-900 border border-zinc-800 text-[10px] font-bold text-zinc-300 flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                    <span>Extract the ZIP and upload the <code>bangacams</code> folder directly to your WordPress <code>wp-content/themes/</code> directory.</span>
                  </div>
                </div>
              </div>

            </div>

            {/* Right container: Code Display & Install Guide */}
            <div className="lg:col-span-8 space-y-6">
              
              {/* Active Code Explorer Box */}
              <div className="rounded-2xl border border-zinc-900 bg-zinc-900/20 overflow-hidden flex flex-col">
                <div className="bg-zinc-900/60 border-b border-zinc-900 px-5 py-4 flex items-center justify-between">
                  <div>
                    <h3 className="text-sm font-bold text-zinc-200">
                      File: <span className="font-mono text-bordeaux-400">/bangacams/{THEME_FILES_DOCUMENTATION[activeThemeFile].name}</span>
                    </h3>
                    <p className="text-xs text-zinc-500 mt-0.5 font-light">
                      {THEME_FILES_DOCUMENTATION[activeThemeFile].description}
                    </p>
                  </div>
                  <div className="rounded-lg bg-zinc-950 px-2.5 py-1 text-[10px] font-mono text-zinc-400 border border-zinc-850">
                    {THEME_FILES_DOCUMENTATION[activeThemeFile].language.toUpperCase()}
                  </div>
                </div>

                <div className="p-5 bg-zinc-950 font-mono text-[11px] text-zinc-400 overflow-x-auto leading-relaxed border-b border-zinc-900/60 max-h-[380px] overflow-y-auto">
                  <pre>{THEME_FILES_DOCUMENTATION[activeThemeFile].code}</pre>
                </div>
                
                <div className="bg-zinc-900/20 px-5 py-3.5 text-xs font-medium text-zinc-500 flex items-center justify-between">
                  <span>File generated & optimized for WordPress 6+</span>
                  <span className="text-bordeaux-400 font-bold">✓ Complete File Ready</span>
                </div>
              </div>

              {/* Comprehensive Installation Instructions */}
              <div className="rounded-2xl border border-zinc-900 bg-zinc-900/10 p-6 sm:p-8">
                <h3 className="font-display text-xl font-bold text-white mb-6 flex items-center space-x-2">
                  <CheckCircle2 className="h-5.5 w-5.5 text-bordeaux-500" />
                  <span>Stappenplan: Theme Activeren & Content Importeren</span>
                </h3>

                <div className="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                  
                  <div className="p-4 bg-zinc-950 rounded-xl border border-zinc-900">
                    <div className="text-bordeaux-500 font-black font-display text-xl">01.</div>
                    <h4 className="text-xs font-bold text-zinc-200 mt-2">Uploaden naar Server</h4>
                    <p className="text-xs text-zinc-500 font-light mt-1.5 leading-relaxed">
                      Upload de map <code>/bangacams</code> direct via FTP naar <code>wp-content/themes/</code> of verpak hem als <code>bangacams.zip</code> en upload via de WP-admin.
                    </p>
                  </div>

                  <div className="p-4 bg-zinc-950 rounded-xl border border-zinc-900">
                    <div className="text-bordeaux-500 font-black font-display text-xl">02.</div>
                    <h4 className="text-xs font-bold text-zinc-200 mt-2">Thema Activeren</h4>
                    <p className="text-xs text-zinc-500 font-light mt-1.5 leading-relaxed">
                      Log in op je WordPress Dashboard, ga naar <strong>Weergave &gt; Thema's</strong>, zoek naar <em>BangaCams</em> en klik op de knop <strong>Activeren</strong>.
                    </p>
                  </div>

                  <div className="p-4 bg-zinc-950 rounded-xl border border-zinc-900">
                    <div className="text-bordeaux-500 font-black font-display text-xl">03.</div>
                    <h4 className="text-xs font-bold text-zinc-200 mt-2">Magische Auto-import</h4>
                    <p className="text-xs text-zinc-500 font-light mt-1.5 leading-relaxed">
                      Bij het activeren importeert de ingebouwde hook in <code>functions.php</code> direct alle models, platforms, blog-gidsen en filtertags. Geen XML import vereist!
                    </p>
                  </div>

                </div>

              </div>

            </div>

          </div>

        </div>
      ) : (
        /* ==================== 💻 INTERACTIVE LIVE PREVIEW INTERFACE ==================== */
        <div className="flex-1 flex flex-col">
          
          {/* Sticky Header inside sandbox */}
          <Header 
            activeTab={activeTab} 
            setActiveTab={(tab) => {
              setActiveTab(tab);
              setSelectedModel(null); // Close model page when navigating
            }} 
            searchQuery={searchQuery}
            setSearchQuery={setSearchQuery}
            setSelectedCategory={setSelectedCategory}
          />

          {/* Main Content Area with Page Transitions */}
          <main className="flex-1">
            <AnimatePresence mode="wait">
              
              {/* 1. MODEL DETAIL VIEW OVERLAY */}
              {selectedModel ? (
                <motion.div
                  key="detail-view"
                  initial={{ opacity: 0, y: 15 }}
                  animate={{ opacity: 1, y: 0 }}
                  exit={{ opacity: 0, y: -15 }}
                  transition={{ duration: 0.3 }}
                  className="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8"
                >
                  {/* Back breadcrumb button */}
                  <button
                    id="back-to-list-btn"
                    onClick={() => setSelectedModel(null)}
                    className="group mb-8 inline-flex items-center space-x-2 text-sm font-semibold text-zinc-400 hover:text-white transition-colors cursor-pointer"
                  >
                    <ArrowLeft className="h-5 w-5 transition-transform group-hover:-translate-x-1" />
                    <span>Terug naar overzicht</span>
                  </button>

                  {/* Grid Layout for details */}
                  <div id="detail-card-layout" className="grid gap-8 lg:grid-cols-12 bg-zinc-900/20 border border-zinc-900 rounded-3xl p-6 sm:p-8 lg:p-12">
                    
                    {/* Left Side: Gorgeous Preview Picture */}
                    <div className="lg:col-span-5">
                      <div className="relative overflow-hidden rounded-2xl border border-zinc-855 bg-zinc-950 aspect-[3/4] w-full">
                        <img 
                          src={selectedModel.image} 
                          alt={selectedModel.name}
                          referrerPolicy="no-referrer"
                          className="h-full w-full object-cover object-top"
                        />
                        
                        {/* Floating live indicator */}
                        <div className="absolute top-4 left-4 flex gap-2">
                          {selectedModel.isOnline ? (
                            <span className="inline-flex items-center space-x-1 rounded-md bg-bordeaux-700 px-3 py-1 text-xs font-bold tracking-widest text-white uppercase shadow-lg">
                              <span className="relative flex h-2 w-2 mr-1">
                                <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                                <span className="relative inline-flex rounded-full h-2 w-2 bg-white"></span>
                              </span>
                              LIVE
                            </span>
                          ) : (
                            <span className="inline-flex items-center rounded-md bg-zinc-800 px-3 py-1 text-xs font-bold tracking-widest text-zinc-400 uppercase">
                              OFFLINE
                            </span>
                          )}
                          
                          <span className="inline-flex items-center rounded-md bg-zinc-950/80 backdrop-blur-md px-3 py-1 text-xs font-semibold text-bordeaux-400 border border-bordeaux-500/30">
                            {selectedModel.platform}
                          </span>
                        </div>

                        {selectedModel.isOnline && (
                          <div className="absolute bottom-4 left-4 rounded-xl bg-zinc-950/80 backdrop-blur-md px-4 py-2 text-sm font-bold text-zinc-100 flex items-center space-x-2">
                            <Eye className="h-4 w-4 text-bordeaux-500" />
                            <span>{selectedModel.viewers.toLocaleString('nl-NL')} actieve kijkers</span>
                          </div>
                        )}
                      </div>
                    </div>

                    {/* Right Side: Detailed descriptive info & actions */}
                    <div className="lg:col-span-7 flex flex-col justify-between">
                      <div>
                        {/* Category pill */}
                        <span className="inline-block rounded-full bg-bordeaux-550/10 px-3 py-1 text-xs font-bold text-bordeaux-400 border border-bordeaux-500/20">
                          {selectedModel.category}
                        </span>

                        {/* Model Name & Star Rating */}
                        <div className="mt-4 flex flex-wrap items-baseline justify-between gap-4">
                          <h1 className="font-display text-4xl font-extrabold tracking-tight text-white sm:text-5xl">
                            {selectedModel.name}
                          </h1>
                          <div className="flex items-center space-x-1.5 rounded-lg bg-yellow-500/10 border border-yellow-500/20 px-3 py-1 text-yellow-500">
                            <Star className="h-4.5 w-4.5 fill-current" />
                            <span className="font-bold text-sm">{selectedModel.rating.toFixed(1)} / 5.0</span>
                          </div>
                        </div>

                        {/* Metadata chips */}
                        <div className="mt-6 grid grid-cols-2 gap-4 border-y border-zinc-900 py-5 text-sm">
                          <div className="flex items-center space-x-2">
                            <span className="text-zinc-500 font-medium">Leeftijd:</span>
                            <span className="text-zinc-200 font-bold">{selectedModel.age || '22'} jaar</span>
                          </div>
                          <div className="flex items-center space-x-2">
                            <Globe className="h-4 w-4 text-bordeaux-400" />
                            <span className="text-zinc-500 font-medium">Land:</span>
                            <span className="text-zinc-200 font-bold">{selectedModel.country || 'Nederland'}</span>
                          </div>
                          <div className="col-span-2 flex items-center space-x-2">
                            <span className="text-zinc-500 font-medium">Talen:</span>
                            <div className="flex gap-1.5 flex-wrap">
                              {(selectedModel.languages || ['Nederlands', 'Engels']).map((lang, i) => (
                                <span key={i} className="rounded bg-zinc-900 px-2 py-0.5 text-xs text-zinc-300 font-semibold border border-zinc-850">
                                  {lang}
                                </span>
                              ))}
                            </div>
                          </div>
                        </div>

                        {/* Model bio/description */}
                        <div className="mt-6">
                          <h3 className="font-display text-base font-bold text-zinc-300">Over {selectedModel.name}</h3>
                          <p className="mt-2.5 text-sm text-zinc-400 leading-relaxed font-light">
                            {selectedModel.description}
                          </p>
                        </div>

                        {/* Custom tags list */}
                        <div className="mt-6">
                          <h4 className="text-xs font-bold text-zinc-500 uppercase tracking-wider">Tags & Interesses</h4>
                          <div className="mt-2.5 flex flex-wrap gap-2">
                            {selectedModel.tags.map((tag, idx) => (
                              <span
                                key={idx}
                                onClick={() => {
                                  setSelectedCategory(null);
                                  setSearchQuery(tag);
                                  setActiveTab('categories');
                                  setSelectedModel(null);
                                }}
                                className="cursor-pointer rounded-full bg-zinc-900 border border-zinc-800/60 px-3.5 py-1 text-xs text-zinc-400 hover:text-white hover:border-bordeaux-500 transition-all font-medium"
                              >
                                #{tag}
                              </span>
                            ))}
                          </div>
                        </div>
                      </div>

                      {/* Primary & Secondary CTA actions */}
                      <div className="mt-10 space-y-4">
                        {/* Watch Live CTA (affiliate link redirect) */}
                        <a
                          id={`detail-primary-affiliate-btn-${selectedModel.id}`}
                          href={selectedModel.affiliate_url}
                          target="_blank"
                          rel="noopener noreferrer"
                          className="affiliate-btn flex w-full items-center justify-center space-x-2.5 rounded-2xl bg-gradient-to-r from-bordeaux-800 to-bordeaux-600 hover:from-bordeaux-700 hover:to-bordeaux-550 py-4.5 text-center text-base font-extrabold text-white shadow-[0_0_20px_rgba(107,7,26,0.3)] transition-all hover:scale-[1.01]"
                        >
                          <span>Watch Live Now</span>
                          <ExternalLink className="h-5 w-5" />
                        </a>

                        <div className="text-center">
                          <p className="text-[11px] text-zinc-500 font-light">
                            Je wordt discreet doorverwezen naar de officiële, beveiligde chatroom op {selectedModel.platform}.
                          </p>
                        </div>
                      </div>

                    </div>
                  </div>

                  {/* Secondary CTA: "More Models Like This" */}
                  <div id="more-models-section" className="mt-16">
                    <div className="flex items-center space-x-2 border-b border-zinc-900 pb-4 mb-8">
                      <Heart className="h-6 w-6 text-bordeaux-500 fill-current animate-pulse" />
                      <h2 className="font-display text-2xl font-bold text-white tracking-tight">
                        More Models Like This
                      </h2>
                    </div>

                    {relatedModels.length > 0 ? (
                      <div className="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                        {relatedModels.map((model) => (
                          <ModelCard 
                            key={model.id} 
                            model={model} 
                            onCardClick={(m) => setSelectedModel(m)} 
                          />
                        ))}
                      </div>
                    ) : (
                      <p className="text-sm text-zinc-500 italic">Geen vergelijkbare modellen online op dit moment.</p>
                    )}
                  </div>

                </motion.div>
              ) : (
                <>
                  
                  {/* 2. HOMEPAGE TAB */}
                  {activeTab === 'home' && (
                    <motion.div
                      key="home-tab"
                      initial={{ opacity: 0 }}
                      animate={{ opacity: 1 }}
                      exit={{ opacity: 0 }}
                      transition={{ duration: 0.3 }}
                    >
                      {/* Hero section */}
                      <Hero onExploreClick={handleExploreCamsClick} />

                      {/* Trending section */}
                      <section id="trending-section" className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
                        <div className="flex flex-col sm:flex-row sm:items-baseline sm:justify-between gap-2 border-b border-zinc-900 pb-5 mb-8">
                          <div className="flex items-center space-x-2.5">
                            <div className="rounded-lg bg-bordeaux-500/10 p-1.5 text-bordeaux-500 border border-bordeaux-500/20">
                              <Flame className="h-5.5 w-5.5 text-bordeaux-500" />
                            </div>
                            <h2 class="font-display text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                              Trending Now
                            </h2>
                          </div>
                          <p className="text-sm text-zinc-400 font-light font-sans">De meest actieve live shows op dit moment</p>
                        </div>

                        {/* Responsive model grid with smaller compact thumbnails */}
                        <div id="trending-grid" className="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                          {trendingModels.map((model) => (
                            <ModelCard 
                              key={model.id} 
                              model={model} 
                              onCardClick={handleModelClick} 
                            />
                          ))}
                        </div>
                      </section>

                      {/* Top Categories section */}
                      <section id="categories-section" className="border-y border-zinc-900 bg-zinc-950/40 py-16">
                        <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                          <div className="text-center mb-10">
                            <h2 className="font-display text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                              Top Categories
                            </h2>
                            <p className="mt-2 text-sm text-zinc-400 font-light font-sans">Ontdek direct wat het beste bij jouw stemming past</p>
                          </div>

                          {/* Flex/grid layout of beautiful, colored buttons */}
                          <div id="categories-grid" className="grid gap-4 grid-cols-2 sm:grid-cols-3 lg:grid-cols-5">
                            {categories.map((cat, idx) => {
                              const gradients = [
                                'from-bordeaux-950/60 to-bordeaux-900/40 hover:from-bordeaux-900 hover:to-bordeaux-800 border-bordeaux-500/20',
                                'from-zinc-900/60 to-bordeaux-950/40 hover:from-bordeaux-950 hover:to-bordeaux-900 border-bordeaux-500/20',
                                'from-bordeaux-900/60 to-zinc-900/40 hover:from-bordeaux-900 hover:to-zinc-900 border-bordeaux-500/10',
                                'from-zinc-900/85 to-bordeaux-950/80 hover:from-bordeaux-900 hover:to-bordeaux-950 border-bordeaux-500/20',
                                'from-bordeaux-950/80 to-zinc-900/80 hover:from-bordeaux-900 hover:to-bordeaux-950 border-bordeaux-500/20'
                              ];
                              return (
                                <button
                                   key={cat}
                                   id={`category-btn-home-${idx}`}
                                   onClick={() => handleCategoryClick(cat)}
                                   className={`flex flex-col items-center justify-center p-6 rounded-2xl bg-gradient-to-br ${gradients[idx % gradients.length]} border text-center transition-all duration-300 hover:scale-103 group cursor-pointer`}
                                >
                                  <span className="font-display text-base font-bold text-white group-hover:underline">
                                    {cat}
                                  </span>
                                  <span className="mt-2 text-[10px] font-semibold tracking-widest text-zinc-450 group-hover:text-zinc-200 uppercase flex items-center space-x-1">
                                    <span>Bekijk Cams</span>
                                    <ChevronRight className="h-3 w-3" />
                                  </span>
                                </button>
                              );
                            })}
                          </div>
                        </div>
                      </section>

                      {/* Recommended Platforms section */}
                      <section id="platforms-section" className="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8">
                        <div className="flex items-center space-x-2.5 border-b border-zinc-900 pb-5 mb-10">
                          <Award className="h-6 w-6 text-bordeaux-500" />
                          <h2 className="font-display text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                            Recommended Platforms
                          </h2>
                        </div>

                        <div id="recommended-platforms-grid" className="grid gap-6 sm:grid-cols-2">
                          {MOCK_PLATFORMS.slice(0, 4).map((plat) => (
                            <PlatformReview 
                              key={plat.id} 
                              platform={plat} 
                              compact={true} 
                            />
                          ))}
                        </div>

                        <div className="mt-10 text-center">
                          <button
                            onClick={() => setActiveTab('platforms')}
                            className="inline-flex items-center space-x-1.5 text-sm font-bold text-bordeaux-400 hover:text-bordeaux-300 transition-colors cursor-pointer"
                          >
                            <span>Bekijk alle platform vergelijkingen & reviews</span>
                            <ChevronRight className="h-4 w-4" />
                          </button>
                        </div>
                      </section>

                    </motion.div>
                  )}

                  {/* 3. CATEGORY / DIRECTORY PAGE TAB */}
                  {activeTab === 'categories' && (
                    <motion.div
                      key="categories-tab"
                      initial={{ opacity: 0 }}
                      animate={{ opacity: 1 }}
                      exit={{ opacity: 0 }}
                      transition={{ duration: 0.3 }}
                      className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8"
                    >
                      <div className="text-center sm:text-left">
                        <h1 className="font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                          Live Webcam <span className="bg-gradient-to-r from-bordeaux-500 to-bordeaux-300 bg-clip-text text-transparent">Modellen</span>
                        </h1>
                        <p className="mt-2 text-sm text-zinc-400 font-light">
                          Filter en sorteer door duizenden actieve streams om je favoriete model te vinden.
                        </p>
                      </div>

                      {/* Filter & Sort Bar */}
                      <div className="mt-10 flex flex-col gap-4 rounded-2xl border border-zinc-900 bg-zinc-900/20 p-4 sm:p-6 lg:flex-row lg:items-center lg:justify-between">
                        
                        {/* Category selectors */}
                        <div className="flex flex-wrap items-center gap-1.5">
                          <button
                            id="category-pill-all"
                            onClick={() => setSelectedCategory(null)}
                            className={`rounded-full px-4 py-2 text-xs font-bold transition-all cursor-pointer ${
                              selectedCategory === null 
                                ? 'bg-bordeaux-800 text-white shadow-md shadow-bordeaux-950/40' 
                                : 'bg-zinc-900 text-zinc-400 hover:bg-zinc-800 hover:text-zinc-200'
                            }`}
                          >
                            Alle Cams
                          </button>
                          {categories.map((cat, idx) => (
                            <button
                              key={cat}
                              id={`category-pill-${idx}`}
                              onClick={() => setSelectedCategory(cat)}
                              className={`rounded-full px-4 py-2 text-xs font-bold transition-all cursor-pointer ${
                                selectedCategory === cat 
                                  ? 'bg-bordeaux-800 text-white shadow-md shadow-bordeaux-950/40' 
                                  : 'bg-zinc-900 text-zinc-400 hover:bg-zinc-800 hover:text-zinc-200'
                              }`}
                            >
                              {cat}
                            </button>
                          ))}
                        </div>

                        {/* Sorting selectors */}
                        <div className="flex items-center justify-between gap-4 border-t border-zinc-900 pt-4 lg:border-t-0 lg:pt-0">
                          <div className="flex items-center space-x-1.5 text-xs text-zinc-500">
                            <Filter className="h-4 w-4" />
                            <span>Sorteer op:</span>
                          </div>
                          <select
                            id="sort-select"
                            value={sortBy}
                            onChange={(e) => setSortBy(e.target.value)}
                            className="rounded-xl border border-zinc-800 bg-zinc-950 px-3.5 py-2 text-xs font-bold text-zinc-200 outline-none focus:border-bordeaux-700 cursor-pointer"
                          >
                            <option value="popularity">Populariteit</option>
                            <option value="rating">Beoordeling</option>
                            <option value="viewers">Aantal Kijkers</option>
                          </select>
                        </div>

                      </div>

                      {/* Active search or category indicators */}
                      {(searchQuery || selectedCategory) && (
                        <div className="mt-6 flex flex-wrap items-center justify-between gap-4 rounded-xl bg-zinc-900/40 px-4 py-3 text-xs">
                          <div className="flex flex-wrap items-center gap-2">
                            <span className="text-zinc-500">Actieve filters:</span>
                            {selectedCategory && (
                              <span className="rounded bg-bordeaux-500/10 border border-bordeaux-500/20 px-2.5 py-1 text-bordeaux-400 font-bold">
                                Categorie: {selectedCategory}
                              </span>
                            )}
                            {searchQuery && (
                              <span className="rounded bg-zinc-900 border border-zinc-800 px-2.5 py-1 text-zinc-300 font-bold">
                                Zoekopdracht: "{searchQuery}"
                              </span>
                            )}
                          </div>
                          <button
                            onClick={() => {
                              setSelectedCategory(null);
                              setSearchQuery('');
                            }}
                            className="text-bordeaux-400 hover:text-bordeaux-300 font-bold cursor-pointer"
                          >
                            Herstel filters
                          </button>
                        </div>
                      )}

                      {/* Main Grid View */}
                      <div className="mt-8">
                        {sortedAndFilteredModels.length > 0 ? (
                          <div id="category-grid" className="grid gap-4 grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6">
                            {sortedAndFilteredModels.map((model) => (
                              <ModelCard 
                                key={model.id} 
                                model={model} 
                                onCardClick={handleModelClick} 
                              />
                            ))}
                          </div>
                        ) : (
                          <div id="no-results" className="rounded-3xl border border-dashed border-zinc-850 p-16 text-center">
                            <p className="text-zinc-500 text-base">Geen live modellen gevonden die voldoen aan je zoekcriteria.</p>
                            <button
                              onClick={() => {
                                setSelectedCategory(null);
                                setSearchQuery('');
                              }}
                              className="mt-4 rounded-full bg-bordeaux-800 px-6 py-2.5 text-xs font-bold text-white hover:bg-bordeaux-700 cursor-pointer"
                            >
                              Toon alle live cams
                            </button>
                          </div>
                        )}
                      </div>

                    </motion.div>
                  )}

                  {/* 4. RECOMMENDED PLATFORMS DETAILED COMPARISON PAGE TAB */}
                  {activeTab === 'platforms' && (
                    <motion.div
                      key="platforms-tab"
                      initial={{ opacity: 0 }}
                      animate={{ opacity: 1 }}
                      exit={{ opacity: 0 }}
                      transition={{ duration: 0.3 }}
                      className="mx-auto max-w-4xl px-4 py-12 sm:px-6"
                    >
                      <div className="text-center mb-12">
                        <h1 className="font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
                          Beste Live Cam <span class="bg-gradient-to-r from-bordeaux-500 to-bordeaux-300 bg-clip-text text-transparent">Platforms</span> 2026
                        </h1>
                        <p className="mx-auto mt-4 max-w-2xl text-sm text-zinc-400 font-light font-sans">
                          Wij vergelijken de meest betrouwbare en veilige cam platforms van dit moment. Onze reviews zijn gebaseerd op camera-kwaliteit, model-diversiteit en privacy.
                        </p>
                      </div>

                      <div id="platforms-list-full" className="space-y-12">
                        {MOCK_PLATFORMS.map((plat) => (
                          <PlatformReview 
                            key={plat.id} 
                            platform={plat} 
                            compact={false} 
                          />
                        ))}
                      </div>
                    </motion.div>
                  )}

                  {/* 5. SEO BLOG / ARTICLE TAB */}
                  {activeTab === 'blog' && (
                    <motion.div
                      key="blog-tab"
                      initial={{ opacity: 0 }}
                      animate={{ opacity: 1 }}
                      exit={{ opacity: 0 }}
                      transition={{ duration: 0.3 }}
                    >
                      <BlogSection onBackToHome={() => setActiveTab('home')} />
                    </motion.div>
                  )}

                </>
              )}

            </AnimatePresence>
          </main>

          {/* Footer disclaimer and references */}
          <footer id="app-footer" className="mt-20 border-t border-zinc-900 bg-zinc-950 px-4 py-12 text-zinc-500">
            <div className="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
              
              {/* Top of footer */}
              <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-6 pb-8 border-b border-zinc-900/60">
                <div className="flex items-center space-x-2">
                  <div className="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-tr from-bordeaux-800 to-bordeaux-600 text-white font-bold text-sm">
                    B
                  </div>
                  <span className="font-display text-lg font-black tracking-tight text-zinc-200">
                    BANGA<span className="text-bordeaux-500">CAMS</span>
                  </span>
                </div>
                
                <div className="flex flex-wrap gap-x-6 gap-y-2 text-xs font-semibold">
                  <button onClick={() => { setActiveTab('home'); setSelectedModel(null); }} className="hover:text-zinc-300 cursor-pointer">Trending</button>
                  <button onClick={() => { setActiveTab('categories'); setSelectedModel(null); }} className="hover:text-zinc-300 cursor-pointer">Cams</button>
                  <button onClick={() => { setActiveTab('platforms'); setSelectedModel(null); }} className="hover:text-zinc-300 cursor-pointer">Top Platforms</button>
                  <button onClick={() => { setActiveTab('blog'); setSelectedModel(null); }} className="hover:text-zinc-300 cursor-pointer">Blog</button>
                </div>
              </div>

              {/* Core affiliate disclaimer & warning */}
              <div className="mt-8 space-y-4 text-xs leading-relaxed font-light text-zinc-650">
                <p className="flex items-start">
                  <ShieldAlert className="h-5 w-5 text-bordeaux-700 mr-2 flex-shrink-0 mt-0.5" />
                  <span>
                    <strong>18+ Leeftijdsgrens:</strong> De content op deze website en de doorgelinkte platformen zijn uitsluitend bestemd voor personen van 18 jaar en ouder. Door onze website te gebruiken, verklaar je dat je ten minste 18 jaar oud bent en wettelijk bevoegd bent om dergelijke inhoud te bekijken in jouw rechtsgebied.
                  </span>
                </p>
                <p>
                  <strong>Affiliate Disclosure:</strong> BangaCams is een onafhankelijk vergelijkings- en reviewportaal. Wij bieden zelf geen streamingdiensten aan. De knoppen gemarkeerd met "Watch Live Now" of andere doorklik-links zijn affiliate links. Dit houdt in dat wij een vergoeding kunnen ontvangen van het cam-platform wanneer je doorklikt en je registreert. Dit kost jou als gebruiker niets extra's, maar stelt ons in staat om de website gratis, actueel en optimaal te onderhouden.
                </p>
                <p>
                  © {new Date().getFullYear()} BangaCams. Alle rechten voorbehouden. Bezoek cam platforms discreet en speel bewust.
                </p>
              </div>

            </div>
          </footer>

        </div>
      )}

    </div>
  );
}
