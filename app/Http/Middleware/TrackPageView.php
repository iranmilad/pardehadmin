<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\PageView;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TrackPageView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // ثبت بازدید پس از پردازش درخواست
        if ($request->isMethod('get')) {
            PageView::create([
                'page_url' => $request->fullUrl(),
                'view_date' => Carbon::now()->toDateString(),
                'hour' => Carbon::now()->hour,
            ]);
        }

        return $response;
    }
}
