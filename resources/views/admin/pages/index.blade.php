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
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    Pages 
                </div>
            </div>

            @if (Auth::user()->hasPermission('admin.pages.create'))
                <div class="page-title-actions">
                    <a href="{{route('admin.pages.create')}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle "></i>
                        </span>
                        Create Page
                    </a>
                </div> 
            @endif

        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All Pages 
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
                            <th class="text-center">URL</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Modified At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($pages as $key=>$page)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td class="text-center text-muted"> {{$page->name}} </td>   
                                <td class="text-center"> 
                                    <a href="{{route('page', $page->slug)}}"> {{$page->slug}} </a>
                                 </td>   
                                <td class="text-center">
                                   @if ($page->status == true)
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
                                    {{$page->updated_at->diffForHumans()}} 
                                </td>
                                <td class="text-center">

                            @if (Auth::user()->hasPermission('admin.pages.edit'))
                                   <a href="{{route('admin.pages.edit', $page->id)}}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit mr-1"></i> Edit
                                   </a>
                             @endif

                            @if (Auth::user()->hasPermission('admin.pages.destroy'))
                                 <button type="button" onclick="removeData('{{$page->id}}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                                <form id="delete-form-{{$page->id}}" action="{{route('admin.pages.destroy', $page->id)}}" method="post" style="display: none">
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


