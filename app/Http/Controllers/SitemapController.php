<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Models\Article;
use App\Models\Announcement;
use App\Models\Gallery;
use App\Models\PenaKarsa;
use App\Models\Author;
use App\Models\Category;

class SitemapController extends Controller
{
    /**
     * Generate the XML sitemap.
     */
    public function index(): Response
    {
        $baseUrl = url('/');

        // Determine latest updates for listing pages (for lastmod)
        $latestArticleTs = Article::published()->max('updated_at') ?: Article::published()->max('published_at');
        $latestAnnouncementTs = Announcement::published()->max('updated_at') ?: Announcement::published()->max('published_at');
        $latestGalleryTs = Gallery::published()->max('updated_at') ?: Gallery::published()->max('created_at');
        $latestPenaKarsaTs = PenaKarsa::published()->max('updated_at') ?: PenaKarsa::published()->max('published_at');

        // Format helper for lastmod values
        $toAtom = function ($ts) {
            if (!$ts) return null;
            try {
                return Carbon::parse($ts)->toAtomString();
            } catch (\Throwable $e) {
                return null;
            }
        };

        // Compute home lastmod as the freshest among modules
        $homeLastMods = array_filter([
            $toAtom($latestArticleTs),
            $toAtom($latestAnnouncementTs),
            $toAtom($latestGalleryTs),
            $toAtom($latestPenaKarsaTs),
        ]);
        $homeLastmod = null;
        if (!empty($homeLastMods)) {
            sort($homeLastMods);
            $homeLastmod = end($homeLastMods) ?: null;
        }

        // Static pages with lastmod
        $staticUrls = [
            [ 'loc' => route('home'), 'lastmod' => $homeLastmod, 'changefreq' => 'daily', 'priority' => '1.0' ],
            [ 'loc' => route('articles.index'), 'lastmod' => $toAtom($latestArticleTs), 'changefreq' => 'daily', 'priority' => '0.9' ],
            [ 'loc' => route('announcements.index'), 'lastmod' => $toAtom($latestAnnouncementTs), 'changefreq' => 'hourly', 'priority' => '0.9' ],
            [ 'loc' => route('galleries.index'), 'lastmod' => $toAtom($latestGalleryTs), 'changefreq' => 'daily', 'priority' => '0.8' ],
            [ 'loc' => route('pena-karsa.index'), 'lastmod' => $toAtom($latestPenaKarsaTs), 'changefreq' => 'daily', 'priority' => '0.8' ],
            [ 'loc' => route('documents.index'), 'lastmod' => $toAtom($latestAnnouncementTs), 'changefreq' => 'weekly', 'priority' => '0.7' ],
            [ 'loc' => route('contact'), 'lastmod' => null, 'changefreq' => 'yearly', 'priority' => '0.3' ],
            [ 'loc' => route('ppdb.index'), 'lastmod' => null, 'changefreq' => 'daily', 'priority' => '0.9' ],
        ];

        // Dynamic pages
        $articles = Article::published()->latest('updated_at')->get();
        $announcements = Announcement::published()->latest('updated_at')->get();
        $galleries = Gallery::published()->latest('updated_at')->get();
        $penaKarsa = PenaKarsa::published()->latest('updated_at')->get();
        $authors = Author::active()->latest('updated_at')->get();

        // Build XML
        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:image="http://www.google.com/schemas/sitemap-image/1.1">';

        // Helper to ensure absolute URL
        $toAbsolute = function (?string $path) use ($baseUrl) {
            if (!$path) return null;
            if (str_starts_with($path, 'http://') || str_starts_with($path, 'https://')) {
                return $path;
            }
            return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
        };

        // Helper to append url nodes (with optional images)
        $append = function(string $loc, ?string $lastmod, string $changefreq, string $priority, array $images = []) use (&$xml, $toAbsolute) {
            $xml[] = '  <url>';
            $xml[] = '    <loc>' . htmlspecialchars($loc, ENT_XML1) . '</loc>';
            if ($lastmod) {
                $xml[] = '    <lastmod>' . htmlspecialchars($lastmod, ENT_XML1) . '</lastmod>';
            }
            $xml[] = '    <changefreq>' . $changefreq . '</changefreq>';
            $xml[] = '    <priority>' . $priority . '</priority>';
            foreach ($images as $imgUrl) {
                $abs = $toAbsolute($imgUrl);
                if ($abs) {
                    $xml[] = '    <image:image>';
                    $xml[] = '      <image:loc>' . htmlspecialchars($abs, ENT_XML1) . '</image:loc>';
                    $xml[] = '    </image:image>';
                }
            }
            $xml[] = '  </url>';
        };

        // Static
        foreach ($staticUrls as $u) {
            $append($u['loc'], $u['lastmod'] ?? null, $u['changefreq'], $u['priority']);
        }

        // Articles
        foreach ($articles as $item) {
            $append(
                route('article.detail', $item->slug),
                optional($item->updated_at ?? $item->published_at)->toAtomString(),
                'weekly',
                '0.8',
                [$item->image]
            );
        }

        // Announcements
        foreach ($announcements as $item) {
            $append(route('announcements.show', $item), optional($item->updated_at ?? $item->published_at)->toAtomString(), 'daily', '0.8');
        }

        // Galleries
        foreach ($galleries as $item) {
            $append(
                route('galleries.show', $item),
                optional($item->updated_at ?? $item->created_at)->toAtomString(),
                'weekly',
                '0.6',
                array_filter([$item->image, $item->thumbnail])
            );
        }

        // Pena Karsa
        foreach ($penaKarsa as $item) {
            $append(
                route('pena-karsa.show', $item->slug),
                optional($item->updated_at ?? $item->published_at ?? $item->created_at)->toAtomString(),
                'weekly',
                '0.7',
                [$item->image]
            );
        }

        // Categories (article categories)
        $categories = Category::active()->ordered()->get();
        foreach ($categories as $category) {
            $append(
                route('category.show', $category->slug),
                optional($category->updated_at ?? $category->created_at)->toAtomString(),
                'weekly',
                '0.6'
            );
        }

        // Authors
        foreach ($authors as $author) {
            $append(route('author.show', $author->slug), optional($author->updated_at ?? $author->created_at)->toAtomString(), 'weekly', '0.5');
        }

        // Pagination URLs for listing pages (limited to reasonable number)
        $appendPagination = function (string $routeName, int $perPage, int $total, string $changefreq, string $priority, ?string $lastmodTs = null) use (&$append) {
            $pages = (int) ceil(max(0, $total - 0) / max(1, $perPage));
            if ($pages <= 1) return;
            for ($i = 2; $i <= $pages; $i++) {
                $append(route($routeName, ['page' => $i]), $lastmodTs, $changefreq, $priority);
            }
        };

        $appendPagination('articles.index', 12, Article::published()->count(), 'daily', '0.6', $toAtom($latestArticleTs));
        $appendPagination('announcements.index', 10, Announcement::published()->count(), 'hourly', '0.7', $toAtom($latestAnnouncementTs));
        $appendPagination('galleries.index', 12, Gallery::published()->count(), 'weekly', '0.5', $toAtom($latestGalleryTs));
        $appendPagination('pena-karsa.index', 12, PenaKarsa::published()->count(), 'weekly', '0.5', $toAtom($latestPenaKarsaTs));
        $appendPagination('documents.index', 8, \App\Models\AnnouncementAttachment::whereHas('announcement', function($q){ $q->published(); })->count(), 'weekly', '0.4', $toAtom($latestAnnouncementTs));

        $xml[] = '</urlset>';

        return response(implode("\n", $xml), 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
        ]);
    }
}


