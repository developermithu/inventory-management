@extends('layouts.backend.app')
@section('title', 'Units | Dashboard')

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
                    Units 
                </div>
            </div>

                <div class="page-title-actions">
                    <a href="{{route('admin.units.create')}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle "></i>
                        </span>
                        Add Unit
                    </a>
                </div> 

        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Unit List
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Created By</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($units as $key=>$unit)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td class="text-center text-muted"> {{$unit->name}} </td>   
                                <td class="text-center text-muted"> {{$unit->created_by}} </td>    
                                <td class="text-center">
                                    @if ($unit->status)
                                     <div class="badge badge-info"> 
                                        Active
                                     </div>
                                    @else
                                     <div class="badge badge-danger"> 
                                       Inactive
                                     </div>
                                    @endif
                                 </td>
                                <td class="text-center">
                                   <a href="{{route('admin.units.edit', $unit->id)}}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit mr-1"></i> Edit
                                   </a>

                                 <button type="button" onclick="removeData('{{$unit->id}}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                                <form id="delete-form-{{$unit->id}}" action="{{route('admin.units.destroy', $unit->id)}}" method="post" style="display: none">
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
