export interface CamModel {
  id: string;
  name: string;
  image: string;
  category: 'Live Girls' | 'Couples' | 'Amateur' | 'Premium Shows' | 'Free Cams';
  rating: number; // e.g. 4.9
  affiliate_url: string;
  description: string;
  popularity: number; // higher is more popular
  tags: string[];
  isOnline: boolean;
  viewers: number;
  platform: string; // which platform they stream on
  age?: number;
  country?: string;
  languages?: string[];
}

export interface CamPlatform {
  id: string;
  name: string;
  logo: string;
  rating: number;
  affiliate_url: string;
  description: string;
  features: string[];
  pros: string[];
  cons: string[];
  signupBonus: string;
  category: string;
}

export interface BlogArticle {
  id: string;
  slug: string;
  title: string;
  excerpt: string;
  content: string; // Markdown or rich text
  publishedAt: string;
  author: string;
  readTime: string;
  image: string;
  tags: string[];
}
