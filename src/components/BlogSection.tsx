import React, { useState, useEffect } from 'react';
import { Calendar, User, Clock, ChevronLeft, ArrowRight, Share2 } from 'lucide-react';
import { BlogArticle } from '../types';
import { MOCK_BLOG_ARTICLES } from '../data';

interface BlogSectionProps {
  onBackToHome?: () => void;
}

export default function BlogSection({ onBackToHome }: BlogSectionProps) {
  const [selectedArticle, setSelectedArticle] = useState<BlogArticle | null>(null);

  // Scroll to top of blog layout when selecting an article
  useEffect(() => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  }, [selectedArticle]);

  // Schema.org Structured Data Generator
  const renderSchemaMarkup = (article: BlogArticle) => {
    const schemaData = {
      "@context": "https://schema.org",
      "@type": "BlogPosting",
      "headline": article.title,
      "image": [article.image],
      "datePublished": "2026-06-25T10:12:00+02:00",
      "author": {
        "@type": "Person",
        "name": article.author
      },
      "description": article.excerpt,
      "publisher": {
        "@type": "Organization",
        "name": "BangaCams Affiliate Directory",
        "logo": {
          "@type": "ImageObject",
          "url": "https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&q=80&w=150&h=150"
        }
      }
    };

    return (
      <script
        type="application/ld+json"
        dangerouslySetInnerHTML={{ __html: JSON.stringify(schemaData) }}
      />
    );
  };

  const parseContentToHtml = (content: string) => {
    // Basic parser for mock Markdown (converting ## headers and * bullets)
    return content.split('\n\n').map((block, index) => {
      if (block.startsWith('## ')) {
        return (
          <h2 key={index} className="mt-8 mb-4 font-display text-2xl font-bold text-white tracking-tight border-b border-zinc-900 pb-2">
            {block.replace('## ', '')}
          </h2>
        );
      }
      if (block.startsWith('### ')) {
        return (
          <h3 key={index} className="mt-6 mb-3 font-display text-xl font-bold text-bordeaux-400">
            {block.replace('### ', '')}
          </h3>
        );
      }
      if (block.startsWith('* ')) {
        return (
          <ul key={index} className="my-4 list-disc pl-5 space-y-2 text-zinc-300">
            {block.split('\n').map((line, lIdx) => (
              <li key={lIdx} className="leading-relaxed">
                {line.replace('* ', '')}
              </li>
            ))}
          </ul>
        );
      }
      if (block.match(/^\d+\./)) {
        return (
          <ol key={index} className="my-4 list-decimal pl-5 space-y-2 text-zinc-300">
            {block.split('\n').map((line, lIdx) => (
              <li key={lIdx} className="leading-relaxed">
                {line.replace(/^\d+\.\s*/, '')}
              </li>
            ))}
          </ol>
        );
      }
      return (
        <p key={index} className="mb-4 text-base text-zinc-300 leading-relaxed font-light">
          {block}
        </p>
      );
    });
  };

  if (selectedArticle) {
    return (
      <div id="blog-reader-view" className="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        {/* Dynamic Schema.org structured data */}
        {renderSchemaMarkup(selectedArticle)}

        {/* Back Link */}
        <button
          id="blog-back-btn"
          onClick={() => setSelectedArticle(null)}
          className="group mb-8 inline-flex items-center space-x-2 text-sm font-medium text-zinc-400 hover:text-white transition-colors"
        >
          <ChevronLeft className="h-5 w-5 transition-transform group-hover:-translate-x-1" />
          <span>Terug naar alle artikelen</span>
        </button>

        {/* Article Meta */}
        <div className="flex flex-wrap items-center gap-4 text-xs text-zinc-500 mb-4 font-medium">
          <div className="flex items-center space-x-1.5">
            <Calendar className="h-4 w-4 text-bordeaux-500" />
            <span>{selectedArticle.publishedAt}</span>
          </div>
          <div className="flex items-center space-x-1.5">
            <User className="h-4 w-4 text-bordeaux-500" />
            <span>{selectedArticle.author}</span>
          </div>
          <div className="flex items-center space-x-1.5">
            <Clock className="h-4 w-4 text-bordeaux-500" />
            <span>{selectedArticle.readTime}</span>
          </div>
        </div>

        {/* Heading */}
        <h1 className="font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl md:text-5xl leading-tight">
          {selectedArticle.title}
        </h1>

        {/* Banner Image */}
        <div className="mt-8 overflow-hidden rounded-2xl border border-zinc-900 bg-zinc-950 aspect-video max-h-[400px] w-full">
          <img
            src={selectedArticle.image}
            alt={selectedArticle.title}
            referrerPolicy="no-referrer"
            className="h-full w-full object-cover"
          />
        </div>

        {/* Tags */}
        <div className="mt-6 flex flex-wrap gap-2">
          {selectedArticle.tags.map((tag, idx) => (
            <span
              key={idx}
              className="rounded-full bg-zinc-900 border border-zinc-800 px-3.5 py-1 text-xs text-zinc-400 font-semibold"
            >
              {tag}
            </span>
          ))}
        </div>

        {/* Content Area */}
        <article className="mt-8 prose prose-invert max-w-none">
          {parseContentToHtml(selectedArticle.content)}
        </article>

        {/* Call-to-action bar inside blog to convert SEO traffic to affiliate revenue */}
        <div className="mt-12 rounded-2xl bg-gradient-to-r from-bordeaux-950/50 via-zinc-900 to-zinc-950 border border-bordeaux-500/20 p-6 sm:p-8 text-center sm:text-left flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6">
          <div>
            <h3 className="font-display text-xl font-bold text-white">Wil je live cams in actie zien?</h3>
            <p className="mt-1 text-sm text-zinc-400">Bekijk duizenden geverifieerde modellen op ons top-aanbevolen platform.</p>
          </div>
          <a
            href="https://external.directlink.com/aff/jerkmate?subid=seo_blog_cta"
            target="_blank"
            rel="noopener noreferrer"
            className="affiliate-btn inline-flex items-center justify-center space-x-2 rounded-xl bg-bordeaux-800 hover:bg-bordeaux-700 px-6 py-3 text-sm font-bold text-white transition-all duration-200"
          >
            <span>Start Live Cams</span>
            <ArrowRight className="h-4.5 w-4.5" />
          </a>
        </div>

        {/* Footer info disclosure */}
        <div className="mt-12 border-t border-zinc-900 pt-6 text-xs text-zinc-600 italic">
          Disclaimer: Dit artikel is uitsluitend bedoeld voor educatieve en amusementsdoeleinden. Sommige van de links in deze post zijn affiliate links waarmee wij een commissie verdienen bij registratie, zonder extra kosten voor jou.
        </div>
      </div>
    );
  }

  return (
    <div id="blog-listing-view" className="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
      <div className="text-center">
        <h1 className="font-display text-3xl font-extrabold tracking-tight text-white sm:text-4xl lg:text-5xl">
          Premium Cam Gidsen & SEO <span className="bg-gradient-to-r from-bordeaux-500 to-bordeaux-300 bg-clip-text text-transparent">Nieuws</span>
        </h1>
        <p className="mx-auto mt-4 max-w-2xl text-sm text-zinc-400 sm:text-base">
          Leer meer over de nieuwste technologische innovaties op webcamgebied, reviews van vooraanstaande platforms en de heetste trends in de live cam industrie.
        </p>
      </div>

      {/* Grid of Articles */}
      <div className="mt-12 grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
        {MOCK_BLOG_ARTICLES.map((article) => (
          <div
            key={article.id}
            id={`blog-card-${article.id}`}
            onClick={() => setSelectedArticle(article)}
            className="flex cursor-pointer flex-col overflow-hidden rounded-2xl border border-zinc-900 bg-zinc-900/20 transition-all duration-300 hover:-translate-y-1 hover:border-zinc-800 hover:bg-zinc-900/40"
          >
            {/* Thumbnail */}
            <div className="aspect-video overflow-hidden bg-zinc-950">
              <img
                src={article.image}
                alt={article.title}
                referrerPolicy="no-referrer"
                className="h-full w-full object-cover transition-transform duration-500 hover:scale-102"
              />
            </div>

            {/* Content */}
            <div className="flex flex-1 flex-col p-6">
              <div className="flex items-center space-x-3 text-[11px] font-semibold text-zinc-500">
                <span className="text-bordeaux-400">{article.publishedAt}</span>
                <span>•</span>
                <span>{article.readTime}</span>
              </div>

              <h2 className="mt-3 font-display text-lg font-bold text-zinc-100 group-hover:text-white line-clamp-2 leading-snug">
                {article.title}
              </h2>

              <p className="mt-2 text-xs text-zinc-400 line-clamp-3 leading-relaxed font-sans">
                {article.excerpt}
              </p>

              {/* Bottom footer bar of card */}
              <div className="mt-auto pt-6 flex items-center justify-between border-t border-zinc-900/60">
                <span className="text-xs font-semibold text-zinc-500 flex items-center space-x-1">
                  <User className="h-3.5 w-3.5 text-zinc-500" />
                  <span>{article.author}</span>
                </span>

                <span className="text-xs font-bold text-bordeaux-400 flex items-center space-x-1 group">
                  <span>Lees artikel</span>
                  <ArrowRight className="h-3.5 w-3.5 transition-transform group-hover:translate-x-1" />
                </span>
              </div>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}
