@extends('layouts.backend.app')
@section('title', 'Roles | Dashboard')

@push('css')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-check icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    Roles 
                </div>
            </div>
            
            @if (Auth::user()->hasPermission('admin.roles.create'))
                <div class="page-title-actions">
                    <a href="{{route('admin.roles.create')}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle "></i>
                        </span>
                        Add Role
                    </a>
                </div> 
            @endif

        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All User Roles
                    {{-- <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                        </div>
                    </div> --}}
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Permission</th>
                            <th class="text-center">Updated At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($roles as $key=>$role)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td class="text-center text-muted"> {{$role->name}} </td>   
                                <td class="text-center">
                                   @if ($role->permissions->count() > 0)
                                    <div class="badge badge-info"> 
                                        {{$role->permissions->count()}} 
                                    </div>
                                   @else
                                    <div class="badge badge-danger"> 
                                       No permission found 
                                    </div>
                                   @endif
                                </td>
                                <td class="text-center">
                                    {{$role->updated_at->diffForHumans()}} 
                                </td>
                                <td class="text-center">
                            @if (Auth::user()->hasPermission('admin.roles.edit'))
                                   <a href="{{route('admin.roles.edit', $role->id)}}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit mr-1"></i> Edit
                                   </a>
                             @endif
                        @if ($role->deletable == true)
                            @if (Auth::user()->hasPermission('admin.roles.destroy'))
                                 <button type="button" onclick="removeData('{{$role->id}}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                                <form id="delete-form-{{$role->id}}" action="{{route('admin.roles.destroy', $role->id)}}" method="post" style="display: none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                                @endif
                            @endif

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