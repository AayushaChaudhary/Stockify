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

        $totalProducts = Product::sum('quantity');
        $categoryName = $allCategories->pluck('name')->toArray();
        $productCount = [];

        foreach ($allCategories as $category) {
            $quantitySum = $category->products->sum('quantity');
            $productCount[] =  round(($quantitySum / $totalProducts) * 100, 2);
        }

        return $this->chart->pieChart()
            ->setTitle('Product Stock % by Category')
            ->addData($productCount)
            ->setLabels($categoryName);
    }
}
