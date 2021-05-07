@extends('layouts.backend.app')
@section('title', 'Product Purchase Management | Dashboard')

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
                   {{ isset($purchase) ? 'Edit' : 'Create' }} Purchase Product
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.purchases.index')}}" class="btn-shadow btn btn-danger">
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
        <form action="{{ isset($purchase) ? route('admin.purchases.update', $purchase->id) : route('admin.purchases.store') }}" method="POST">
            @csrf
            @isset($purchase)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Purchase Product</h5>
                        
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Date</label>
                                        <input type="date" name="date" value="{{$purchase->date ?? old('date')}}" class="form-control">
                                        @error('date')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Purchase Number</label>
                                        <input type="number" name="purchase_no" value="{{$purchase->purchase_no ?? old('purchase_no')}}" class="form-control">
                                        @error('purchase_no')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label>Supplier Name</label>
                                        <select name="supplier_name" id="supplier_name" class="form-control">
                                            <option value="">Select Supplier</option>
                                           @foreach ($suppliers as $supplier)
                                           <option value="{{$supplier->id}}"
                                            @isset($purchase)
                                            {{$purchase->supplier->id == $supplier->id ? 'selected' : '' }}
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
                                        <label>Category Name</label>
                                        <select name="category_name" id="category_name" class="form-control">
                                         <option value="">No Category Available</option>
                                           {{-- Load from Ajax --}}
                                        </select>
                                        @error('category_name')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                        @enderror                  
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label>Product Name</label>
                                        <select name="product_name" id="product_name" class="form-control">
                                            <option value="">No Product Available</option>
                                            {{-- From Ajax --}}
                                        </select>
                                        @error('product_name')
                                           <span class="text-danger" role="alert">
                                               <strong>{{ $message }}</strong>
                                           </span>
                                        @enderror     
                                    </div>
                                </div>
                            </div>

                               <div class="form-row">
                                   {{-- <div class="col-md-8">
                                    <div class="position-relative form-group">
                                        <label for="name">Name</label>
                                        <input name="name" id="name" value="{{ $purchase->name ?? old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   </div> --}}
                                   <div class="col-md-4">
                                    <div class="position-relative form-group">
                                        <label for="qty">qty</label>
                                        <input name="qty" id="qty" value="{{ $purchase->qty ?? old('qty')}}" type="number" class="form-control @error('qty') is-invalid @enderror">
                                        @error('qty')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                   </div>
                               </div>

                                     
                                    @isset($purchase)
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


@push('js')
<script>
    $(function(){
        $('#supplier_name').on('change', function(){
            var supplier_name = $(this).val();
            $.ajax({
                url: "{{ route('admin.get-category') }}",
                type: "GET",
                data: {supplier_name:supplier_name},
                success: function(data){
                    var html = ' <option value="">Select Category</option>';
                    $.each(data, function(key, value){
                        html+=  '<option value="'+value.category_name+'">'+value.category.name+'</option>';
                    });
                    $('#category_name').html(html);
                }
            });
        })

        $('#category_name').on('change', function(){
            var category_name = $(this).val();
            $.ajax({
                url: "{{ route('admin.get-product') }}",
                type: "GET",
                data: {category_name:category_name},
                success: function(data){
                    var html = ' <option value="">Select Product</option>';
                    $.each(data, function(key, value){
                        // html+=  '<option value="'+value.id+'">'+value.name+'</option>';
                    });
                    $('#product_name').html(html);
                }
            });
        })

    });
</script>
@endpush