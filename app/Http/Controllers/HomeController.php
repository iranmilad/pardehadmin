<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\Review;
use App\Models\Payment;
use Events\UserEditInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\OrderController;

class HomeController extends Controller
{
    public function index() {

        $orders = Order::orderBy('created_at', 'desc')->limit(5)->get();

        $reviews = Review::orderBy('created_at', 'desc')->take(5)->get();


        return view('index', compact('orders','reviews'));
    }


    public function getSellStat($range)
    {
        $query = Payment::query()->where('status', 'completed'); // فقط پرداخت‌های با وضعیت "completed"

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

        $sales = $query->select(DB::raw("DATE_FORMAT(created_at, '$groupByFormat') as time"), DB::raw('SUM(amount) as total_sales'))
                        ->groupBy('time')
                        ->orderBy('time', 'asc')
                        ->get();

        // Format the result to fit the required structure for the chart
        $formattedData = $sales->map(function($sale) {
            return [
                'x' => $sale->time,
                'y' => $sale->total_sales,
            ];
        });

        return response()->json($formattedData);
    }


}
