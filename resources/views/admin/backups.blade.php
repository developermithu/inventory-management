@extends('layouts.backend.app')
@section('title', 'Backups Management | Dashboard')

@push('css')
    <link href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-cloud icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                   Backup
                </div>
            </div>
            
            @if (Auth::user()->hasPermission('admin.backups.create'))
                <div class="page-title-actions">
                    <button type="button" onclick="event.preventDefault();
                        document.getElementById('clean-old-backup').submit();"
                    class="btn-shadow btn btn-danger mr-2">
                    <span class="btn-icon-wrapper pr-2 opacity-7">
                        <i class="fas fa-trash fa-w-20"></i>
                    </span>
                    Clean Old Backup
                </button>
                    <form id="clean-old-backup" action="{{ route('admin.backups.clean') }}" method="POST" style="display: none;">
                        @csrf
                        @method('DELETE')
                    </form>

                    <button type="button" onclick="event.preventDefault();
                          document.getElementById('new-backup-form').submit();"
                       class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-2 opacity-7">
                            <i class="fas fa-plus-circle fa-w-20"></i>
                        </span>
                        Create Backup
                    </button>
                    <form id="new-backup-form" action="{{ route('admin.backups.store') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div> 
            @endif

        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All User Roles
                </div>
                <div class="table-responsive">
                    <table id="datatable" class="align-middle mb-0 table table-borderless">
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">File Name</th>
                            <th class="text-center">File Size</th>
                            <th class="text-center">Created At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($backups as $key=>$backup)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td class="text-center text-muted"> 
                                    <code>{{$backup['file_name']}}</code>
                                 </td>   
                                <td class="text-center text-muted"> {{$backup['file_size']}} </td>   
                                <td class="text-center">{{$backup['created_at']}}</td>
                                <td class="text-center">
                            @if (Auth::user()->hasPermission('admin.backups.index'))
                                   <a href="{{route('admin.backups.download', $backup['file_name'])}}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-download mr-1"></i> Download
                                   </a>
                             @endif
                        
                             @if (Auth::user()->hasPermission('admin.backups.destroy'))
                                 <button type="button" onclick="removeData({{$key}})" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                                <form id="delete-form-{{$key}}" action="{{route('admin.backups.destroy', $backup['file_name'])}}" method="post" style="display: none">
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