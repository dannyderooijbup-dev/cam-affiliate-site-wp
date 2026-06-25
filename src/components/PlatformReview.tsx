import React from 'react';
import { Star, ShieldCheck, CheckCircle2, AlertCircle, Gift, ArrowUpRight } from 'lucide-react';
import { CamPlatform } from '../types';

interface PlatformReviewProps {
  key?: string;
  platform: CamPlatform;
  compact?: boolean;
}

export default function PlatformReview({ platform, compact = false }: PlatformReviewProps) {
  if (compact) {
    return (
      <div 
        id={`platform-card-compact-${platform.id}`}
        className="relative overflow-hidden rounded-2xl border border-zinc-900 bg-zinc-950 p-5 transition-all duration-300 hover:border-zinc-800 hover:bg-zinc-900/40"
      >
        <div className="flex items-start justify-between">
          <div className="flex items-center space-x-3">
            <img 
              src={platform.logo} 
              alt={platform.name}
              referrerPolicy="no-referrer"
              className="h-12 w-12 rounded-xl object-cover border border-zinc-800"
            />
            <div>
              <h3 className="font-display text-lg font-bold text-zinc-100">{platform.name}</h3>
              <div className="flex items-center space-x-1 mt-0.5 text-yellow-500">
                <Star className="h-3.5 w-3.5 fill-current" />
                <span className="text-xs font-bold">{platform.rating.toFixed(1)} / 5.0</span>
              </div>
            </div>
          </div>
          
          <div className="rounded-full bg-bordeaux-500/10 px-2.5 py-1 text-[11px] font-bold text-bordeaux-400 border border-bordeaux-500/20">
            {platform.category}
          </div>
        </div>

        <p className="mt-4 text-xs text-zinc-400 line-clamp-2 leading-relaxed">
          {platform.description}
        </p>

        {/* Bonus badge */}
        <div className="mt-4 flex items-center space-x-1.5 rounded-lg bg-bordeaux-500/10 border border-bordeaux-500/20 px-3 py-1.5 text-xs font-semibold text-bordeaux-400">
          <Gift className="h-3.5 w-3.5 flex-shrink-0" />
          <span className="truncate">{platform.signupBonus}</span>
        </div>

        <div className="mt-4">
          <a
            id={`platform-btn-compact-${platform.id}`}
            href={platform.affiliate_url}
            target="_blank"
            rel="noopener noreferrer"
            className="affiliate-btn flex w-full items-center justify-center space-x-1 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 py-2.5 text-center text-xs font-bold text-white transition-all duration-200"
          >
            <span>Bezoek {platform.name}</span>
            <ArrowUpRight className="h-3.5 w-3.5" />
          </a>
        </div>
      </div>
    );
  }

  return (
    <div 
      id={`platform-card-full-${platform.id}`}
      className="overflow-hidden rounded-2xl border border-zinc-900 bg-zinc-900/20 p-6 md:p-8 transition-all hover:border-zinc-800"
    >
      <div className="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
        
        {/* Left info */}
        <div className="flex items-center space-x-4">
          <img 
            src={platform.logo} 
            alt={platform.name} 
            referrerPolicy="no-referrer"
            className="h-16 w-16 rounded-2xl object-cover border border-zinc-800 shadow-md"
          />
          <div>
            <div className="flex items-center space-x-2.5 flex-wrap gap-y-1">
              <h2 className="font-display text-2xl font-bold text-white">{platform.name}</h2>
              <span className="rounded-md bg-bordeaux-600/15 border border-bordeaux-500/20 px-2 py-0.5 text-xs font-bold text-bordeaux-400">
                {platform.category}
              </span>
            </div>
            
            <div className="flex items-center space-x-4 mt-1.5">
              <div className="flex items-center space-x-1 text-yellow-500">
                <Star className="h-4 w-4 fill-current" />
                <span className="text-sm font-bold">{platform.rating.toFixed(1)}</span>
                <span className="text-zinc-500 text-xs">/ 5.0</span>
              </div>
              <span className="text-zinc-600">|</span>
              <div className="flex items-center space-x-1 text-green-400 text-xs font-medium">
                <ShieldCheck className="h-3.5 w-3.5" />
                <span>Geverifieerd Secure</span>
              </div>
            </div>
          </div>
        </div>

        {/* Signup Bonus banner */}
        <div className="rounded-2xl bg-gradient-to-r from-bordeaux-950/50 via-bordeaux-900/40 to-zinc-900/30 border border-bordeaux-500/20 px-5 py-4 flex items-center space-x-3 md:max-w-xs w-full">
          <div className="rounded-lg bg-bordeaux-700 p-2 text-white">
            <Gift className="h-5 w-5" />
          </div>
          <div>
            <div className="text-[10px] font-bold text-bordeaux-400 uppercase tracking-wider">AANMELDINGSBONUS</div>
            <div className="text-xs font-bold text-zinc-100">{platform.signupBonus}</div>
          </div>
        </div>

      </div>

      <p className="mt-6 text-sm text-zinc-300 leading-relaxed">
        {platform.description}
      </p>

      {/* Grid of Pros, Cons & Features */}
      <div className="mt-8 grid gap-6 md:grid-cols-2">
        {/* Pros */}
        <div className="rounded-xl bg-zinc-950/80 p-5 border border-zinc-900/60">
          <h3 className="font-display text-sm font-bold text-green-400 flex items-center space-x-1.5 uppercase tracking-wider">
            <CheckCircle2 className="h-4 w-4" />
            <span>Voordelen (Pros)</span>
          </h3>
          <ul className="mt-3.5 space-y-2.5 text-xs text-zinc-300">
            {platform.pros.map((pro, index) => (
              <li key={index} className="flex items-start space-x-2">
                <span className="text-green-500 font-bold mt-0.5">✓</span>
                <span>{pro}</span>
              </li>
            ))}
          </ul>
        </div>

        {/* Cons */}
        <div className="rounded-xl bg-zinc-950/80 p-5 border border-zinc-900/60">
          <h3 className="font-display text-sm font-bold text-red-400 flex items-center space-x-1.5 uppercase tracking-wider">
            <AlertCircle className="h-4 w-4" />
            <span>Nadelen (Cons)</span>
          </h3>
          <ul className="mt-3.5 space-y-2.5 text-xs text-zinc-300">
            {platform.cons.map((con, index) => (
              <li key={index} className="flex items-start space-x-2">
                <span className="text-red-500 font-bold mt-0.5">✗</span>
                <span>{con}</span>
              </li>
            ))}
          </ul>
        </div>
      </div>

      {/* Features bullet list */}
      <div className="mt-6 flex flex-wrap gap-2">
        {platform.features.map((feat, index) => (
          <span 
            key={index} 
            className="rounded-full bg-zinc-900 border border-zinc-800 px-3.5 py-1 text-xs text-zinc-400 font-medium"
          >
            • {feat}
          </span>
        ))}
      </div>

      {/* Primary Action Button */}
      <div className="mt-8 pt-6 border-t border-zinc-900">
        <a
          id={`platform-btn-full-${platform.id}`}
          href={platform.affiliate_url}
          target="_blank"
          rel="noopener noreferrer"
          className="affiliate-btn flex w-full items-center justify-center space-x-2 rounded-xl bg-gradient-to-r from-bordeaux-800 via-bordeaux-700 to-bordeaux-600 hover:from-bordeaux-700 hover:to-bordeaux-500 py-4 text-center text-sm font-bold text-white shadow-lg transition-all duration-200 hover:scale-[1.01]"
        >
          <span>Bezoek {platform.name} Live Platform</span>
          <ArrowUpRight className="h-4.5 w-4.5" />
        </a>
      </div>
    </div>
  );
}
