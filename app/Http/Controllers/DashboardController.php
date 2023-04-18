<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Visitor;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $today_count = Visitor::where('datetime_in', '<=', date('Y-m-d') . ' 23:59:59')
            ->where('datetime_in', '>=', date('Y-m-d') . ' 00:00:00')
            ->count();

        $today_count_out = Visitor::where('datetime_in', '<=', date('Y-m-d') . ' 23:59:59')
            ->where('datetime_in', '>=', date('Y-m-d') . ' 00:00:00')
            ->whereNotNull('datetime_out')
            ->count();

        $today_in_now = Visitor::where('datetime_in', '<=', date('Y-m-d') . ' 23:59:59')
            ->where('datetime_in', '>=', date('Y-m-d') . ' 00:00:00')
            ->whereNull('datetime_out')
            ->count();

        $to_date_count = Visitor::where('datetime_in', '<=', date('Y-m-d') . ' 23:59:59')
            ->count();

        $todayDate = Carbon::now();
        $startMonth = $todayDate->startOfMonth()->toDateString();
        $endMonth = $todayDate->endOfMonth()->toDateString();
        $month_count = Visitor::where('datetime_in', '<=', $endMonth . ' 23:59:59')
            ->where('datetime_in', '>=', $startMonth . ' 00:00:00')
            ->count();

        return view('visitor.dashboard', ['today_count' => $today_count, 'today_in_now' => $today_in_now, 'today_count_out' => $today_count_out, 'month_count' => $month_count, 'to_date_count' => $to_date_count]);
    }
}
