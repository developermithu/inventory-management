<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class PageController extends Controller
{

    public function index()
    {
        Gate::authorize('admin.pages.index');
        $pages = Page::latest('id')->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        Gate::authorize('admin.pages.create');
        return view('admin.pages.page-management');
    }

    public function store(Request $request)
    {
        Gate::authorize('admin.pages.create');
        $this->validate($request, [
            'name' => 'required | string | max:120 | unique:pages',
            'body' => 'required',
            'image' => 'nullable | image | mimes:png,jpg,jpeg | max:2048',
        ]);

        $page = Page::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->filled('status'),
        ]);

        // Image Upload
        if ($request->hasFile('image')) {
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        Toastr::success('Page created successfully');
        return redirect()->route('admin.pages.index');
    }

    public function show(Page $page)
    {
        //
    }

    public function edit(Page $page)
    {
        Gate::authorize('admin.pages.edit');
        return view('admin.pages.page-management', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        Gate::authorize('admin.pages.edit');
        $this->validate($request, [
            'name' => 'required | string | max:120 | unique:pages,name,' . $page->id,
            'body' => 'required',
            'image' => 'nullable | image | mimes:png,jpg,jpeg | max:2048',
        ]);

        $page->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'excerpt' => $request->excerpt,
            'body' => $request->body,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->filled('status'),
        ]);

        // Image Upload
        if ($request->hasFile('image')) {
            $page->addMedia($request->image)->toMediaCollection('image');
        }

        Toastr::success('Page updated successfully!');
        return redirect()->route('admin.pages.index');
    }

    public function destroy(Page $page)
    {
        Gate::authorize('admin.pages.destroy');
        $page->delete();
        Toastr::success('Page deleted successfully');
        return back();
    }
}
