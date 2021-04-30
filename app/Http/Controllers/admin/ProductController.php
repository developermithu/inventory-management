<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\Unit;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['supplier', 'unit', 'category'])->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $data['suppliers'] = Supplier::orderBy('name', 'asc')->get();
        $data['units'] = Unit::orderBy('name', 'asc')->get();
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        return view('admin.products.product-management', $data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required | unique:products',
            'qty' => 'required | integer',
            'supplier_name' => 'required | integer',
            'unit_name' => 'required | integer',
            'category_name' => 'required | integer',
        ]);

        Product::create([
            'name' => $request->name,
            'supplier_id' => $request->supplier_name,
            'unit_id' => $request->unit_name,
            'category_id' => $request->category_name,
            'qty' => $request->qty,
            'created_by' => Auth::id(),
            'status' => $request->filled('status'),
        ]);

        Toastr::success('Product created successfully');
        return redirect()->route('admin.products.index');
    }

    public function show(Product $product)
    {
        //
    }

    public function edit(Product $product)
    {
        $data['suppliers'] = Supplier::orderBy('name', 'asc')->get();
        $data['units'] = Unit::orderBy('name', 'asc')->get();
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        return view('admin.products.product-management', $data, compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required | unique:products,name,' . $product->id,
            'qty' => 'required | integer',
            'supplier_name' => 'required | integer',
            'unit_name' => 'required | integer',
            'category_name' => 'required | integer',
        ]);

        $product->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_name,
            'unit_id' => $request->unit_name,
            'category_id' => $request->category_name,
            'qty' => $request->qty,
            'updated_by' => Auth::id(),
            'status' => $request->filled('status'),
        ]);

        Toastr::success('Product updated successfully');
        return redirect()->route('admin.products.index');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        Toastr::success('Product deleted successfully');
        return back();
    }
}
