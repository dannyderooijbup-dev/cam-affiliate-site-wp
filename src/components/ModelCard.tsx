import React from 'react';
import { Eye, Star, Tv, ArrowRight } from 'lucide-react';
import { CamModel } from '../types';

interface ModelCardProps {
  key?: string;
  model: CamModel;
  onCardClick: (model: CamModel) => void;
}

export default function ModelCard({ model, onCardClick }: ModelCardProps) {
  // Prevent card click when clicking the direct affiliate link button
  const handleAffiliateClick = (e: React.MouseEvent) => {
    e.stopPropagation();
  };

  return (
    <div
      id={`model-card-${model.id}`}
      onClick={() => onCardClick(model)}
      className="group relative cursor-pointer overflow-hidden rounded-2xl border border-zinc-900 bg-zinc-900/30 transition-all duration-300 hover:-translate-y-1 hover:border-bordeaux-950 hover:bg-zinc-900/60 hover:shadow-[0_8px_30px_rgba(64,1,12,0.4)]"
    >
      {/* Thumbnail Frame */}
      <div className="relative aspect-[4/5] w-full overflow-hidden bg-zinc-950">
        {/* Glow effect background */}
        <div className="absolute inset-0 z-0 bg-gradient-to-t from-zinc-950 via-zinc-950/25 to-transparent opacity-90 group-hover:opacity-75 transition-opacity"></div>
        
        {/* Model Picture */}
        <img
          src={model.image}
          alt={model.name}
          loading="lazy"
          referrerPolicy="no-referrer"
          className="h-full w-full object-cover object-top transition-transform duration-700 ease-out group-hover:scale-105"
        />

        {/* Live Indicator Badges */}
        <div className="absolute top-3 left-3 flex flex-wrap gap-1.5 z-10">
          {model.isOnline ? (
            <div className="flex items-center space-x-1 rounded-md bg-bordeaux-700 px-2 py-0.5 text-[10px] font-bold tracking-wider text-white uppercase shadow-sm">
              <span className="relative flex h-1.5 w-1.5">
                <span className="animate-ping absolute inline-flex h-full w-full rounded-full bg-white opacity-75"></span>
                <span className="relative inline-flex rounded-full h-1.5 w-1.5 bg-white"></span>
              </span>
              <span>LIVE</span>
            </div>
          ) : (
            <div className="rounded-md bg-zinc-800/90 px-2 py-0.5 text-[10px] font-bold tracking-wider text-zinc-400 uppercase">
              OFFLINE
            </div>
          )}

          <div className="rounded-md bg-zinc-950/75 backdrop-blur-sm px-2 py-0.5 text-[10px] font-medium text-zinc-300 flex items-center space-x-1">
            <Tv className="h-2.5 w-2.5 text-bordeaux-400" />
            <span>{model.platform}</span>
          </div>
        </div>

        {/* Viewers Badge - if live */}
        {model.isOnline && (
          <div className="absolute bottom-3 left-3 z-10 flex items-center space-x-1 rounded-md bg-zinc-950/80 backdrop-blur-xs px-2 py-0.5 text-[11px] font-semibold text-zinc-200">
            <Eye className="h-3.5 w-3.5 text-zinc-400" />
            <span>{model.viewers.toLocaleString('nl-NL')} kijkers</span>
          </div>
        )}

        {/* Play Icon/Overlay on Hover */}
        <div className="absolute inset-0 flex items-center justify-center bg-black/40 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
          <div className="flex h-11 w-11 items-center justify-center rounded-full bg-bordeaux-700 text-white shadow-lg transform scale-90 transition-transform duration-300 group-hover:scale-100">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              fill="currentColor"
              viewBox="0 0 24 24"
              strokeWidth="1.5"
              stroke="currentColor"
              className="w-5 h-5 fill-current ml-0.5"
            >
              <path strokeLinecap="round" strokeLinejoin="round" d="M5.25 5.653c0-.856.917-1.398 1.667-.986l11.54 6.347a1.125 1.125 0 0 1 0 1.972l-11.54 6.347a1.125 1.125 0 0 1-1.667-.986V5.653Z" />
            </svg>
          </div>
        </div>
      </div>

      {/* Model Information Area */}
      <div className="p-3.5">
        {/* Category & Rating */}
        <div className="flex items-center justify-between text-xs text-zinc-400">
          <span className="font-semibold text-bordeaux-400">{model.category}</span>
          <div className="flex items-center space-x-1 text-yellow-500 font-medium">
            <Star className="h-3 w-3 fill-current" />
            <span>{model.rating.toFixed(1)}</span>
          </div>
        </div>

        {/* Name */}
        <h3 className="mt-1 text-base font-bold text-zinc-100 group-hover:text-white group-hover:underline decoration-bordeaux-500">
          {model.name}
        </h3>

        {/* Tags */}
        <div className="mt-2 flex flex-wrap gap-1">
          {model.tags.slice(0, 3).map((tag, idx) => (
            <span
              key={idx}
              className="rounded bg-zinc-900/80 px-1.5 py-0.5 text-[10px] font-medium text-zinc-400 border border-zinc-800/40"
            >
              #{tag}
            </span>
          ))}
        </div>

        {/* CTA Direct Affiliate Button */}
        <div className="mt-3.5">
          <a
            id={`affiliate-btn-${model.id}`}
            href={model.affiliate_url}
            target="_blank"
            rel="noopener noreferrer"
            onClick={handleAffiliateClick}
            className="affiliate-btn flex w-full items-center justify-center space-x-1.5 rounded-xl bg-bordeaux-950/40 hover:bg-bordeaux-800 border border-bordeaux-700/30 hover:border-bordeaux-600 py-2.5 text-center text-xs font-bold text-bordeaux-300 hover:text-white transition-all duration-200"
          >
            <span>Watch Live Now</span>
            <ArrowRight className="h-3.5 w-3.5" />
          </a>
        </div>
      </div>
    </div>
  );
}
