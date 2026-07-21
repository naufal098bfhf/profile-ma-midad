<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\User;
use App\Models\PageView;
use App\Models\Announcement;
use App\Models\Gallery;
use App\Models\PenaKarsa;
use App\Models\Slider;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            // Articles
            'total_articles' => Article::count(),
            'published_articles' => Article::where('status', 'published')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            
            // Authors & Users
            'total_authors' => Author::count(),
            'active_authors' => Author::where('is_active', true)->count(),
            'total_users' => User::count(),
            
            // Announcements
            'total_announcements' => Announcement::count(),
            'published_announcements' => Announcement::where('is_published', true)->count(),
            'draft_announcements' => Announcement::where('is_published', false)->count(),
            
            // Galleries
            'total_galleries' => Gallery::count(),
            'published_galleries' => Gallery::where('is_published', true)->count(),
            'featured_galleries' => Gallery::where('is_featured', true)->count(),
            
            // Pena Karsa
            'total_pena_karsa' => PenaKarsa::count(),
            'published_pena_karsa' => PenaKarsa::where('status', 'published')->count(),
            'featured_pena_karsa' => PenaKarsa::where('is_featured', true)->count(),
            
            // Sliders
            'total_sliders' => Slider::count(),
            'active_sliders' => Slider::where('is_active', true)->count(),
            
            // Contact Messages
            'total_contact_messages' => ContactMessage::count(),
            'unread_contact_messages' => ContactMessage::where('status', 'unread')->count(),
            'replied_contact_messages' => ContactMessage::where('status', 'replied')->count(),
        ];

        // Page views statistics
        $pageViewsStats = [
            'today' => PageView::getStats('today'),
            'week' => PageView::getStats('week'),
            'month' => PageView::getStats('month'),
            'year' => PageView::getStats('year'),
        ];

        // Daily page views for chart (last 30 days)
        $dailyViews = PageView::getDailyViews(30);

        $recent_articles = Article::with('author')
            ->latest()
            ->take(5)
            ->get();

        $recent_authors = Author::withCount('articles')
            ->latest()
            ->take(5)
            ->get();

        // Recent activities
        $recent_announcements = Announcement::with('category')
            ->latest()
            ->take(3)
            ->get();

        $recent_galleries = Gallery::with('category')
            ->latest()
            ->take(3)
            ->get();

        $recent_pena_karsa = PenaKarsa::latest()
            ->take(3)
            ->get();

        // Alerts & Notifications
        $alerts = [
            'unread_messages' => ContactMessage::where('status', 'unread')->count(),
            'draft_articles' => Article::where('status', 'draft')->count(),
            'draft_announcements' => Announcement::where('is_published', false)->count(),
        ];

        return view('admin.dashboard', compact(
            'stats', 
            'recent_articles', 
            'recent_authors',
            'recent_announcements',
            'recent_galleries',
            'recent_pena_karsa',
            'alerts',
            'pageViewsStats',
            'dailyViews'
        ));
    }

    /**
     * Get top pages statistics via AJAX
     */
    public function getTopPages(Request $request)
    {
        $period = $request->get('period', 'month');
        $limit = $request->get('limit', 10);
        
        $stats = PageView::getStats($period);
        $topPages = $stats['top_pages']->take($limit);
        
        return response()->json([
            'success' => true,
            'data' => $topPages,
            'period' => $period,
            'total' => $stats['total_views']
        ]);
    }

    /**
     * Unified visitor stats for a given period.
     */
    public function getVisitorStats(Request $request)
    {
        $period = $request->get('period', 'month');
        $days = (int) $request->get('days', 30);

        // Base stats (total, unique, top pages)
        $stats = PageView::getStats($period);

        // Hourly trend for today or daily trend for N days
        if ($period === 'today') {
            $driver = \DB::connection()->getDriverName();

            // Use the same "today" definition as PageView model
            $query = PageView::today();

            if ($driver === 'mysql') {
                // Data already in Asia/Jakarta timezone, just extract hour
                $hourExpr = "HOUR(viewed_at)";
            } elseif ($driver === 'pgsql') {
                $hourExpr = "EXTRACT(HOUR FROM viewed_at)";
            } else { // sqlite and others - data already in local timezone
                $hourExpr = "strftime('%H', viewed_at)";
            }

            $hourly = $query->selectRaw($hourExpr . ' as hour, COUNT(*) as views')
                ->groupBy('hour')
                ->orderBy('hour')
                ->get();
            $trend = collect(range(0, 23))->map(function ($h) use ($hourly) {
                $hStr = str_pad((string) $h, 2, '0', STR_PAD_LEFT);
                $found = $hourly->first(function ($row) use ($h, $hStr) {
                    return (string) $row->hour === (string) $h || (string) $row->hour === $hStr;
                });
                return [
                    'label' => sprintf('%02d:00', $h),
                    'views' => $found->views ?? 0,
                ];
            });
        } else {
            $daily = PageView::getDailyViews($days > 0 ? $days : 30);
            $trend = $daily->map(function ($row) {
                return [
                    'label' => $row['date'],
                    'views' => (int) $row['views'],
                ];
            });
        }

        // Referrers top 10
        $referrers = PageView::query()
            ->when($period === 'today', function ($q) { $q->today(); })
            ->when($period === 'week', function ($q) { $q->thisWeek(); })
            ->when($period === 'month', function ($q) { $q->thisMonth(); })
            ->when($period === 'year', function ($q) { $q->thisYear(); })
            ->whereNotNull('referer')
            ->where('referer', '!=', '')
            ->selectRaw('referer, COUNT(*) as views')
            ->groupBy('referer')
            ->orderByDesc('views')
            ->limit(10)
            ->get();

        // Browser breakdown (simple UA parsing)
        $userAgents = PageView::query()
            ->when($period === 'today', function ($q) { $q->today(); })
            ->when($period === 'week', function ($q) { $q->thisWeek(); })
            ->when($period === 'month', function ($q) { $q->thisMonth(); })
            ->when($period === 'year', function ($q) { $q->thisYear(); })
            ->pluck('user_agent');

        $browsers = [
            'Chrome' => 0,
            'Firefox' => 0,
            'Safari' => 0,
            'Edge' => 0,
            'Opera' => 0,
            'Other' => 0,
        ];

        foreach ($userAgents as $ua) {
            $u = $ua ?? '';
            if (stripos($u, 'OPR') !== false || stripos($u, 'Opera') !== false) {
                $browsers['Opera']++;
            } elseif (stripos($u, 'Edg') !== false || stripos($u, 'Edge') !== false) {
                $browsers['Edge']++;
            } elseif (stripos($u, 'Chrome') !== false && stripos($u, 'Chromium') === false && stripos($u, 'Edg') === false) {
                $browsers['Chrome']++;
            } elseif (stripos($u, 'Firefox') !== false) {
                $browsers['Firefox']++;
            } elseif (stripos($u, 'Safari') !== false && stripos($u, 'Chrome') === false) {
                $browsers['Safari']++;
            } else {
                $browsers['Other']++;
            }
        }

        return response()->json([
            'success' => true,
            'period' => $period,
            'totals' => [
                'total_views' => $stats['total_views'] ?? 0,
                'unique_visitors' => $stats['unique_visitors'] ?? 0,
            ],
            'top_pages' => $stats['top_pages'] ?? [],
            'trend' => $trend,
            'referrers' => $referrers,
            'browsers' => $browsers,
        ]);
    }
}
