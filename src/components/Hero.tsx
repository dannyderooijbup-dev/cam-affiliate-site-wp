import React from 'react';
import { Play, Sparkles, Shield, UserCheck } from 'lucide-react';
import { motion } from 'motion/react';

interface HeroProps {
  onExploreClick: () => void;
}

export default function Hero({ onExploreClick }: HeroProps) {
  return (
    <section id="hero-section" className="relative overflow-hidden bg-zinc-950 py-16 sm:py-24 lg:py-32">
      {/* Absolute colored gradients for premium streaming ambience */}
      <div className="absolute inset-0 z-0 pointer-events-none opacity-25">
        <div className="absolute -top-40 -left-40 h-[600px] w-[600px] rounded-full bg-bordeaux-900/60 blur-[150px]"></div>
        <div className="absolute top-20 -right-40 h-[500px] w-[500px] rounded-full bg-bordeaux-950/60 blur-[130px]"></div>
      </div>

      <div className="relative z-10 mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 text-center">
        {/* Badge */}
        <motion.div
          initial={{ opacity: 0, y: -10 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.5 }}
          className="inline-flex items-center space-x-2 rounded-full border border-zinc-850 bg-zinc-900/80 px-3 py-1 text-xs font-semibold text-bordeaux-400 backdrop-blur-sm sm:text-sm"
        >
          <Sparkles className="h-3.5 w-3.5 text-bordeaux-500 animate-pulse" />
          <span>Beste Live Cam Selectie van 2026</span>
        </motion.div>

        {/* Headline */}
        <motion.h1
          initial={{ opacity: 0, y: 15 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.6, delay: 0.1 }}
          className="mt-6 font-display text-4xl font-extrabold tracking-tight text-white sm:text-5xl md:text-6xl lg:text-7xl"
        >
          Discover Live Cam <br />
          <span className="bg-gradient-to-r from-bordeaux-600 via-bordeaux-500 to-bordeaux-700 bg-clip-text text-transparent">
            Models & Platforms
          </span>
        </motion.h1>

        {/* Subtext targeted on entertainment discovery */}
        <motion.p
          initial={{ opacity: 0 }}
          animate={{ opacity: 1 }}
          transition={{ duration: 0.8, delay: 0.3 }}
          className="mx-auto mt-6 max-w-2xl text-base text-zinc-400 sm:text-lg md:text-xl font-light leading-relaxed"
        >
          Welkom bij <strong>BangaCams</strong>. Vind en vergelijk de best gewaardeerde premium cam models en onafhankelijke live webcam platforms. Of je nu zoekt naar gratis amateurkamers of ultra-high-definition VIP-shows, ontdek hier jouw perfecte interactieve entertainmentervaring.
        </motion.p>

        {/* Action Button */}
        <motion.div
          initial={{ opacity: 0, scale: 0.9 }}
          animate={{ opacity: 1, scale: 1 }}
          transition={{ duration: 0.5, delay: 0.5 }}
          className="mt-10 flex flex-col items-center justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4"
        >
          <button
            id="hero-explore-btn"
            onClick={onExploreClick}
            className="flex items-center space-x-2.5 rounded-full bg-gradient-to-r from-bordeaux-800 to-bordeaux-600 px-8 py-4 text-base font-bold text-white shadow-[0_0_20px_rgba(107,7,26,0.5)] transition-all hover:scale-105 hover:from-bordeaux-700 hover:to-bordeaux-500 hover:shadow-[0_0_30px_rgba(107,7,26,0.8)] active:scale-95 cursor-pointer"
          >
            <Play className="h-5 w-5 fill-current" />
            <span>Explore Live Cams</span>
          </button>
        </motion.div>

        {/* Feature benefits bar */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          animate={{ opacity: 1, y: 0 }}
          transition={{ duration: 0.7, delay: 0.6 }}
          className="mx-auto mt-16 max-w-4xl border-t border-zinc-900/80 pt-8"
        >
          <div className="grid grid-cols-2 gap-y-6 sm:grid-cols-3 md:gap-y-0 md:divide-x md:divide-zinc-900 text-center text-zinc-500">
            <div className="px-4 flex flex-col items-center">
              <Shield className="h-6 w-6 text-bordeaux-600 mb-2" />
              <span className="text-sm font-semibold text-zinc-300">100% Discreet & Veilig</span>
              <span className="text-xs text-zinc-500 mt-0.5">Alleen geverifieerde partners</span>
            </div>
            <div className="px-4 flex flex-col items-center">
              <UserCheck className="h-6 w-6 text-bordeaux-600 mb-2" />
              <span className="text-sm font-semibold text-zinc-300">Geverifieerde Modellen</span>
              <span className="text-xs text-zinc-500 mt-0.5">Echte foto's & live status trackers</span>
            </div>
            <div className="col-span-2 sm:col-span-1 px-4 flex flex-col items-center">
              <div className="flex space-x-1 mb-2">
                <span className="text-yellow-500 font-bold text-lg leading-none">★</span>
                <span className="text-yellow-500 font-bold text-lg leading-none">★</span>
                <span className="text-yellow-500 font-bold text-lg leading-none">★</span>
                <span className="text-yellow-500 font-bold text-lg leading-none">★</span>
                <span className="text-yellow-500 font-bold text-lg leading-none">★</span>
              </div>
              <span className="text-sm font-semibold text-zinc-300">Top Rated Affiliate</span>
              <span className="text-xs text-zinc-500 mt-0.5">Exclusieve signup bonussen</span>
            </div>
          </div>
        </motion.div>

      </div>
    </section>
  );
}
