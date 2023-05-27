<?php

namespace App\Charts;

use App\Models\Category;
use App\Models\Product;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class StockByCategoryChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $allCategories = Category::with('products')->get();

        $categoryName = $allCategories->pluck('name')->toArray();
        $productCount = [];

        foreach ($allCategories as $category) {
            $productCount[] = $category->products->sum('quantity');
        }

        return $this->chart->pieChart()
            ->setTitle('Product Stock % by Category')
            ->addData($productCount)
            ->setLabels($categoryName);
    }
}
