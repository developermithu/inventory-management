@extends('layouts.backend.app')
@section('title', 'Purchase purchases | Dashboard')

@push('css')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

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
                    Purchase purchases 
                </div>
            </div>

                <div class="page-title-actions">
                    <a href="{{route('admin.purchases.create')}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle "></i>
                        </span>
                        Add Purchase
                    </a>
                </div> 

        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Purchase List
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless">
                        <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Purchase No.</th>
                            <th class="text-center">Supplier </th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Product</th>
                            <th class="text-center">Qty</th>
                            <th class="text-center">Unit Price</th>
                            <th class="text-center">Total Price</th>
                            <th class="text-center">Buying Date</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($purchases as $key=>$purchase)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td class="text-center text-muted"> {{$purchase->purchase_no}} </td>   
                                <td class="text-center text-muted"> {{$purchase->supplier->name}} </td>   
                                <td class="text-center text-muted"> {{$purchase->category->name}} </td>   
                                <td class="text-center text-muted"> {{$purchase->product->name}} </td>   
                                <td class="text-center text-muted"> {{$purchase->qty}} </td>    
                                <td class="text-center text-muted"> {{$purchase->unit_price}} </td>    
                                <td class="text-center text-muted"> {{$purchase->total_price}} </td>    
                                <td class="text-center text-muted"> 
                                    {{Carbon::parse($purchase->date)->format('Y-m-d')}} 
                                </td>    
                                <td class="text-center">
                                    @if ($purchase->status == 1)
                                     <div class="badge badge-info"> 
                                        Approved
                                     </div>
                                    @else
                                     <div class="badge badge-danger"> 
                                       Pending
                                     </div>
                                    @endif
                                 </td>
                                <td class="text-center">
                                   <a href="{{route('admin.purchases.edit', $purchase->id)}}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit mr-1"></i> Edit
                                   </a>

                                 <button type="button" onclick="removeData('{{$purchase->id}}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                                <form id="delete-form-{{$purchase->id}}" action="{{route('admin.purchases.destroy', $purchase->id)}}" method="post" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script>
@endpush
