<?php

namespace App\Charts;

use App\Models\Invoice;
use App\Models\InvoiceDetail;
use App\Models\Purchase;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\LineChart;
use Illuminate\Support\Facades\DB;

class MonthlyProfitChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        // get purchases by month
        $purchases = Purchase::select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(buying_price) as total'))
            ->groupBy('month')
            ->get();

        // get sales by month
        $sales = InvoiceDetail::select(DB::raw('MONTH(created_at) as month'), DB::raw('sum(selling_price) as total'))
            ->groupBy('month')
            ->get();

        // get profit for every month from jan to dec if no sales or purchases for that month then 0
        $profit = [];
        for ($i = 1; $i <= 12; $i++) {
            $profit[$i] = 0;
            foreach ($purchases as $purchase) {
                if ($purchase->month == $i) {
                    $profit[$i] -= $purchase->total;
                }
            }
            foreach ($sales as $sale) {
                if ($sale->month == $i) {
                    $profit[$i] += $sale->total;
                }
            }
        }

        // set chart properties
        return $this->chart->lineChart()
            ->setTitle('Monthly Profit Report')
            ->setSubtitle('Wins during season 2021.')
            ->addData('Purchase Amount', $profit)
            ->setXAxis([
                'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September',
                'October', 'November', 'December'
            ]);
    }
}
