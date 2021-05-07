<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{

    public function getCategory(Request $request)
    {
        // groupBy korle multiple category item 1 bar show korbe
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id', $request->supplier_name)->groupBy('category_id')->get();
        // dd($allCategory->toArray());
        return response()->json($allCategory);
    }

    public function getProduct(Request $request)
    {
        // return 'ok';
        $category_id = $request->category_name;
        $allProduct = Product::where('category_id', $category_id)->get();
        dd($allProduct);
        // return response()->json($allProduct);
    }
}
