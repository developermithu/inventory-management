@extends('layouts.backend.app')

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
                    Suppliers 
                </div>
            </div>

                <div class="page-title-actions">
                    <a href="{{route('admin.suppliers.create')}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle "></i>
                        </span>
                        Add Supplier
                    </a>
                </div> 

        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All User 
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Mobile</th>
                            <th class="text-center">Address</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($suppliers as $key=>$supplier)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td class="text-center text-muted"> {{$supplier->name}} </td>   
                                <td class="text-center text-muted"> {{$supplier->email}} </td>   
                                <td class="text-center text-muted"> {{$supplier->mobile}} </td>   
                                <td class="text-center text-muted"> {{$supplier->address}} </td>   
                                <td class="text-center">
                                    {{-- <button type="button" class="btn btn-sm btn-alternate" data-toggle="modal" data-target=".showData-{{$supplier->id}}">
                                        <i class="fas fa-eye mr-1"></i> 
                                        Show
                                    </button> --}}

                                   <a href="{{route('admin.suppliers.edit', $supplier->id)}}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit mr-1"></i> Edit
                                   </a>

                                 <button type="button" onclick="removeData('{{$supplier->id}}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                                <form id="delete-form-{{$supplier->id}}" action="{{route('admin.suppliers.destroy', $supplier->id)}}" method="post" style="display: none">
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


<!-- Show modal -->
{{-- @foreach ($suppliers as $supplier)
<div class="modal fade showData-{{$supplier->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">supplier Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row py-3">
                  <div class="col-md-4">
                       <img src=" {{ $supplier->getFirstMediaUrl('avatar') != null ? $supplier->getFirstMediaUrl('avatar') : config('app.placeholder').'250.png' }}" alt="" class="img-fluid">
                  </div>
                  <div class="col-md-8">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <td>{{$supplier->name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$supplier->email}}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    <div class="badge badge-primary">{{$supplier->role->name}}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($supplier->status)
                                    <div class="badge badge-info"> 
                                       Active
                                    </div>
                                   @else
                                    <div class="badge badge-danger"> 
                                      Inactive
                                    </div>
                                   @endif
                                </td>
                            </tr>
                            <tr>
                                <th>Last Modified</th>
                                <td>{{$supplier->updated_at->diffForHumans()}}</td>
                            </tr>
                            <tr>
                                <th>Joined At</th>
                                <td>{{$supplier->created_at->diffForHumans()}}</td>
                            </tr>

                        </table>
                  </div>
              </div>
            </div>
            <div class="modal-footer bg-white">
                <button type="button" class="btn-transition btn btn-outline-danger" data-dismiss="modal"> <i class="fas fa-times-circle"></i> &nbsp; Close</button>
            </div>
        </div>
    </div>
</div>
@endforeach --}}
