<?php

namespace App\Services;

use App\Models\Insurance;
use Carbon\Carbon;

class CalculateSales
{
    /**
     * Get daily sale
     *
     * @return int
     */
    public function calculateDailySale(): int
    {
        return Insurance::where('created_at','>=', today())->sum('budget');
    }

    /**
     * Get Weekly sale
     * @return int
     */
    public function calculateWeeklySale(): int
    {
        return Insurance::where('created_at', '>=', Carbon::now()->subDays(7))->sum('budget');
    }

    /**
     * Compare sale with last week sale
     *
     * @return float
     */
    public function compareSaleWithLastWeek(): float
    {
        $currentWeekStart = Carbon::now()->startOfWeek();
        $currentWeekEnd = Carbon::now()->endOfWeek();
        $lastWeekStart = Carbon::now()->subWeek()->startOfWeek();
        $lastWeekEnd = Carbon::now()->subWeek()->endOfWeek();

        $currentWeekTotal = Insurance::whereBetween('created_at', [$currentWeekStart, $currentWeekEnd])
            ->sum('budget');

        $lastWeekTotal = Insurance::whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
            ->sum('budget');

        if ($lastWeekTotal == 0) {
            return 0;
        }

        $difference = $currentWeekTotal - $lastWeekTotal;

        return ($difference / $lastWeekTotal) * 100;
    }

    /**
     * Compare sale with yesterday sale
     * @return float
     */
    public function compareSaleWithYesterday(): float
    {
        $today = Carbon::now()->today();
        $yesterday = Carbon::now()->yesterday();

        $todaySale = Insurance::whereDate('created_at',$today)->sum('budget');
        $yesterdaySale = Insurance::whereDate('created_at',$yesterday)->sum('budget');
        $salesDifference = $todaySale - $yesterdaySale;

        if ($yesterdaySale == 0) {
            return 0;
        }

        return round(($salesDifference / $yesterdaySale) * 100, 2);
    }
}
