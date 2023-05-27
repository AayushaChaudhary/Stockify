<?php

namespace App\Charts;

use App\Models\Purchase;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class ThisWeekPurchaseChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        // get purchase amount of last 7 days
        $purchase = Purchase::where('status', 1)->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
            ->orderBy('date')->get();

        $purchaseAmount = [];
        $purchaseDate = [];
        // get the purchase amount for each day of last 7 days even if there is no purchase
        for ($i = 0; $i < 7; $i++) {
            $purchaseAmount[$i] = 0;
            $purchaseDate[$i] = Carbon::now()->subDays(6 - $i)->format('l');
            foreach ($purchase as $p) {
                $date = $p->date ? Carbon::parse($p->date)->format('Y-m-d') : $p->date;
                if ($date == Carbon::now()->subDays(6 - $i)->format('Y-m-d')) {
                    $purchaseAmount[$i] += $p->buying_price;
                }
            }
        }

        return $this->chart->barChart()
            ->setTitle('Purchase Amount Report of Last 7 Days')
            ->addData('Purchase Amount', $purchaseAmount)
            ->setXAxis($purchaseDate);
    }
}
