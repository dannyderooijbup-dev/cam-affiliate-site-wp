import React, { useState } from 'react';
import { Camera, Search, Flame, BookOpen, Layers, Award, Menu, X } from 'lucide-react';

interface HeaderProps {
  activeTab: string;
  setActiveTab: (tab: string) => void;
  searchQuery: string;
  setSearchQuery: (query: string) => void;
  setSelectedCategory: (category: string | null) => void;
}

export default function Header({
  activeTab,
  setActiveTab,
  searchQuery,
  setSearchQuery,
  setSelectedCategory
}: HeaderProps) {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);

  const handleNavClick = (tab: string) => {
    setActiveTab(tab);
    setIsMobileMenuOpen(false);
    if (tab === 'categories') {
      setSelectedCategory(null); // Reset category filter when clicking Category page tab to show all initially
    }
  };

  return (
    <header id="app-header" className="sticky top-0 z-50 w-full border-b border-zinc-800 bg-zinc-950/90 backdrop-blur-md">
      <div className="mx-auto flex max-w-7xl items-center justify-between px-4 py-3 sm:px-6 lg:px-8">
        
        {/* Logo */}
        <div 
          id="logo-container"
          onClick={() => handleNavClick('home')} 
          className="flex cursor-pointer items-center space-x-2 group"
        >
          <div className="relative flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-tr from-bordeaux-950 via-bordeaux-800 to-bordeaux-600 shadow-md transition-transform group-hover:scale-105">
            <Camera className="h-5.5 w-5.5 text-white" />
            <span className="absolute -top-1 -right-1 flex h-3 w-3">
              <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-bordeaux-400 opacity-75"></span>
              <span className="relative inline-flex rounded-full h-3 w-3 bg-bordeaux-600"></span>
            </span>
          </div>
          <span className="font-display text-xl font-black tracking-tight text-white sm:text-2xl">
            BANGA<span className="bg-gradient-to-r from-bordeaux-500 to-bordeaux-300 bg-clip-text text-transparent">CAMS</span>
          </span>
        </div>

        {/* Search Bar - Desktop */}
        <div className="hidden md:relative md:block md:w-64 lg:w-80">
          <div className="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <Search className="h-4 w-4 text-zinc-400" />
          </div>
          <input
            id="desktop-search-input"
            type="text"
            placeholder="Zoek model of tag..."
            value={searchQuery}
            onChange={(e) => {
              setSearchQuery(e.target.value);
              // Auto route to categories page if they are typing from somewhere else, so they see instant results
              if (activeTab !== 'categories' && activeTab !== 'home') {
                setActiveTab('categories');
              }
            }}
            className="w-full rounded-full border border-zinc-800 bg-zinc-900/60 py-2 pl-9 pr-4 text-sm text-zinc-200 placeholder-zinc-500 outline-none transition-colors focus:border-bordeaux-700 focus:bg-zinc-900 focus:ring-1 focus:ring-bordeaux-700"
          />
          {searchQuery && (
            <button 
              onClick={() => setSearchQuery('')}
              className="absolute inset-y-0 right-0 flex items-center pr-3 text-xs text-zinc-500 hover:text-zinc-300"
            >
              Wissen
            </button>
          )}
        </div>

        {/* Navigation - Desktop */}
        <nav className="hidden items-center space-x-1 md:flex">
          <button
            id="nav-home"
            onClick={() => handleNavClick('home')}
            className={`flex items-center space-x-1 rounded-lg px-2.5 py-2 text-sm font-semibold transition-colors ${
              activeTab === 'home' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900/50 hover:text-white'
            }`}
          >
            <Flame className="h-4 w-4" />
            <span>Trending</span>
          </button>
          <button
            id="nav-categories"
            onClick={() => handleNavClick('categories')}
            className={`flex items-center space-x-1 rounded-lg px-2.5 py-2 text-sm font-semibold transition-colors ${
              activeTab === 'categories' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900/50 hover:text-white'
            }`}
          >
            <Layers className="h-4 w-4" />
            <span>Cams</span>
          </button>
          <button
            id="nav-platforms"
            onClick={() => handleNavClick('platforms')}
            className={`flex items-center space-x-1 rounded-lg px-2.5 py-2 text-sm font-semibold transition-colors ${
              activeTab === 'platforms' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900/50 hover:text-white'
            }`}
          >
            <Award className="h-4 w-4" />
            <span>Platforms</span>
          </button>
          <button
            id="nav-blog"
            onClick={() => handleNavClick('blog')}
            className={`flex items-center space-x-1 rounded-lg px-2.5 py-2 text-sm font-semibold transition-colors ${
              activeTab === 'blog' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900/50 hover:text-white'
            }`}
          >
            <BookOpen className="h-4 w-4" />
            <span>Blog</span>
          </button>
        </nav>

        {/* Mobile menu trigger & mobile search icon */}
        <div className="flex items-center space-x-2 md:hidden">
          <button 
            id="mobile-search-toggle"
            onClick={() => {
              setActiveTab('categories');
              // Focus mobile search or just open menu
            }}
            className="rounded-lg p-2 text-zinc-400 hover:bg-zinc-900 hover:text-white"
          >
            <Search className="h-5 w-5" />
          </button>
          <button
            id="mobile-menu-toggle"
            onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)}
            className="rounded-lg p-2 text-zinc-400 hover:bg-zinc-900 hover:text-white"
            aria-label="Toggle Menu"
          >
            {isMobileMenuOpen ? <X className="h-6 w-6" /> : <Menu className="h-6 w-6" />}
          </button>
        </div>
      </div>

      {/* Mobile Menu */}
      {isMobileMenuOpen && (
        <div id="mobile-menu" className="border-t border-zinc-900 bg-zinc-950 px-4 py-4 md:hidden">
          {/* Mobile Search Input */}
          <div className="relative mb-4">
            <div className="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
              <Search className="h-4 w-4 text-zinc-400" />
            </div>
            <input
              id="mobile-search-input"
              type="text"
              placeholder="Zoek model, categorie..."
              value={searchQuery}
              onChange={(e) => setSearchQuery(e.target.value)}
              className="w-full rounded-lg border border-zinc-800 bg-zinc-900 py-2 pl-9 pr-4 text-sm text-zinc-200 outline-none"
            />
          </div>

          <nav className="flex flex-col space-y-1">
            <button
              id="mobile-nav-home"
              onClick={() => handleNavClick('home')}
              className={`flex items-center space-x-2 rounded-lg px-4 py-3 text-base font-semibold ${
                activeTab === 'home' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900'
              }`}
            >
              <Flame className="h-5 w-5 text-bordeaux-500" />
              <span>Trending</span>
            </button>
            <button
              id="mobile-nav-categories"
              onClick={() => handleNavClick('categories')}
              className={`flex items-center space-x-2 rounded-lg px-4 py-3 text-base font-semibold ${
                activeTab === 'categories' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900'
              }`}
            >
              <Layers className="h-5 w-5 text-bordeaux-500" />
              <span>Cams</span>
            </button>
            <button
              id="mobile-nav-platforms"
              onClick={() => handleNavClick('platforms')}
              className={`flex items-center space-x-2 rounded-lg px-4 py-3 text-base font-semibold ${
                activeTab === 'platforms' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900'
              }`}
            >
              <Award className="h-5 w-5 text-bordeaux-500" />
              <span>Platforms</span>
            </button>
            <button
              id="mobile-nav-blog"
              onClick={() => handleNavClick('blog')}
              className={`flex items-center space-x-2 rounded-lg px-4 py-3 text-base font-semibold ${
                activeTab === 'blog' ? 'bg-zinc-900 text-bordeaux-400' : 'text-zinc-300 hover:bg-zinc-900'
              }`}
            >
              <BookOpen className="h-5 w-5 text-bordeaux-500" />
              <span>Blog</span>
            </button>
          </nav>

          <div className="mt-6 border-t border-zinc-900 pt-4 text-center">
            <p className="text-xs text-zinc-500">18+ | Bezoek discreet | Vind de beste deals</p>
          </div>
        </div>
      )}
    </header>
  );
}
