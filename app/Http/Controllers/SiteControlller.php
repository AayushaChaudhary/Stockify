<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pos\SupplierController;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SiteControlller extends Controller
{
    public function index()
    {
        $supplier = Supplier::count();
        return view('admin.index', compact('supplier'));
    }
}
