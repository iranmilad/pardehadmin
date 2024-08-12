<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PageView;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PageViewController extends Controller
{
    public function trackPageView(Request $request)
    {
        $pageUrl = $request->input('page_url');
        $currentDate = Carbon::now()->toDateString();
        $currentHour = Carbon::now()->hour;

        PageView::create([
            'page_url' => $pageUrl,
            'view_date' => $currentDate,
            'hour' => $currentHour,
        ]);

        return response()->json(['success' => true]);
    }

    public function getDailyPageViews()
    {
        $pageViews = PageView::select(DB::raw('view_date, hour, COUNT(*) as views_count'))
                            ->groupBy('view_date', 'hour')
                            ->orderBy('view_date', 'asc')
                            ->orderBy('hour', 'asc')
                            ->get();

        return view('page_views.daily', compact('pageViews'));
    }

    public function getHourlyPageViews($date)
    {
        $pageViews = PageView::select(DB::raw('hour, COUNT(*) as views_count'))
                            ->where('view_date', $date)
                            ->groupBy('hour')
                            ->orderBy('hour', 'asc')
                            ->get();

        return view('page_views.hourly', compact('pageViews'));
    }


    public function getViewStat($range)
    {
        $query = PageView::query();

        switch ($range) {
            case '3days':
                $query->where('created_at', '>=', Carbon::now()->subDays(3));
                $groupByFormat = '%Y-%m-%d %H:00:00'; // Group by hour within 3 days
                break;
            case 'week':
                $query->where('created_at', '>=', Carbon::now()->subWeek());
                $groupByFormat = '%Y-%m-%d'; // Group by day within 1 week
                break;
            case 'month':
                $query->where('created_at', '>=', Carbon::now()->subMonth());
                $groupByFormat = '%Y-%m-%d'; // Group by day within 1 month
                break;
            case 'year':
                $query->where('created_at', '>=', Carbon::now()->subYear());
                $groupByFormat = '%Y-%m'; // Group by month within 1 year
                break;
            default:
                $query->whereDate('created_at', Carbon::today());
                $groupByFormat = '%H:00:00'; // Group by hour for today
                break;
        }

        $pageViews = $query->select(DB::raw("DATE_FORMAT(created_at, '$groupByFormat') as time"), DB::raw('COUNT(*) as views_count'))
                            ->groupBy('time')
                            ->orderBy('time', 'asc')
                            ->get();

        // Format the result to fit the required structure for the chart
        $formattedData = $pageViews->map(function($view) {
            return [
                'x' => $view->time,
                'y' => $view->views_count,
            ];
        });

        return response()->json($formattedData);
    }



}
