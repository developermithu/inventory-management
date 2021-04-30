@extends('layouts.backend.app')
@section('title', 'Menus | Dashboard')

@push('css')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-menu icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    Menus 
                </div>
            </div>

            @if (Auth::user()->hasPermission('admin.menus.create'))
                <div class="page-title-actions">
                    <a href="{{route('admin.menus.create')}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle "></i>
                        </span>
                        Create Menu
                    </a>
                </div> 
            @endif

        </div>
    </div>           

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All menus 
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
                            <th class="text-center">Description</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($menus as $key=>$menu)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td class="text-center text-danger"> {{$menu->name}} </td>   
                                <td class="text-muted"> {{$menu->description}} </td>   
                                <td class="text-center">
                                    @if (Auth::user()->hasPermission('admin.menus.builder'))
                                        <a href="{{route('admin.menus.builder', $menu->id)}}" class="btn btn-success btn-sm">
                                            <i class="fas fa-list-ul  mr-1"></i> Builder
                                        </a>
                                    @endif

                                    @if (Auth::user()->hasPermission('admin.menus.edit'))
                                        <a href="{{route('admin.menus.edit', $menu->id)}}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                    @endif

                                @if (Auth::user()->hasPermission('admin.menus.destroy') && $menu->deletable == true)
                                    <button type="button" onclick="removeData('{{$menu->id}}')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                    <form id="delete-form-{{$menu->id}}" action="{{route('admin.menus.destroy', $menu->id)}}" method="post" style="display: none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
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


