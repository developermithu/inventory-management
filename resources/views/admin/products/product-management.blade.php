@extends('layouts.backend.app')
@section('title', 'Product Management | Dashboard')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                   {{ isset($product) ? 'Edit' : 'Create' }} Product
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.products.index')}}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-arrow-circle-left"></i>
                        </span>
                       Go  Back
                    </a>
            </div>    
        </div>
    </div>       

    <div class="row">

    <div class="col-md-12">
        <form action="{{ isset($product) ? route('admin.products.update', $product->id) : route('admin.products.store') }}" method="POST">
            @csrf
            @isset($product)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Product</h5>
                        
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label>Supplier Name</label>
                                        <select name="supplier_name" class="form-control">
                                            <option value="">Select Supplier</option>
                                           @foreach ($suppliers as $supplier)
                                           <option value="{{$supplier->id}}"
                                            @isset($product)
                                            {{$product->supplier->id == $supplier->id ? 'selected' : '' }}
                                            @endisset
                                            >
                                            {{$supplier->name}}
                                        </option>
                                           @endforeach
                                        </select>
                                        @error('supplier_name')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label>Unit Name</label>
                                        <select name="unit_name" class="form-control">
                                            <option value="">Select Unit</option>
                                           @foreach ($units as $unit)
                                           <option value="{{$unit->id}}"
                                            @isset($product)
                                            {{$product->unit->id == $unit->id ? 'selected' : '' }}
                                            @endisset
                                            >
                                            {{$unit->name}}
                                        </option>
                                           @endforeach
                                        </select>
                                        @error('unit_name')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                        @enderror     
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label>Category Name</label>
                                        <select name="category_name" class="form-control">
                                            <option value="">Select Category</option>
                                           @foreach ($categories as $category)
                                           <option value="{{$category->id}}"
                                            @isset($product)
                                            {{$product->category->id == $category->id ? 'selected' : '' }}
                                            @endisset
                                            >
                                            {{$category->name}}
                                        </option>
                                           @endforeach
                                           @error('category_name')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                           @enderror
                                        </select>
                                        @error('category_name')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                        @enderror                  
                                    </div>
                                </div>
                            </div>

                               <div class="form-row">
                                   <div class="col-md-8">
                                    <div class="position-relative form-group">
                                        <label for="name">Name</label>
                                        <input name="name" id="name" value="{{ $product->name ?? old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   </div>
                                   <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="qty">qty</label>
                                        <input name="qty" id="qty" value="{{ $product->qty ?? old('qty')}}" type="number" class="form-control @error('qty') is-invalid @enderror">
                                        @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   </div>
                               </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status" @isset($product) {{ $product->status == true ? 'checked' : '' }} @endisset>
                                        <label class="custom-control-label" for="status">Status</label> 
                                      </div>
                                </div>
                                     
                                    @isset($product)
                                        <button type="submit" class="mt-1 btn btn-success">
                                            <i class="fas fa-save mr-1"></i> 
                                                Save Changes
                                        </button>
                                        @else
                                        <button type="submit" class="mt-1 btn btn-primary">
                                            <i class="fas fa-plus-circle mr-1"></i> 
                                            Submit
                                        </button>
                                    @endisset
                               
                        </div>
                    </div>
                </div>
            </div>
</form>
</div>
</div>
@endsection
