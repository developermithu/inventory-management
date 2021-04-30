@extends('layouts.backend.app')
@section('title', 'Users | Dashboard')

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
                    Users 
                </div>
            </div>

            @if (Auth::user()->hasPermission('admin.users.create'))
                <div class="page-title-actions">
                    <a href="{{route('admin.users.create')}}" class="btn-shadow btn btn-primary">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-plus-circle "></i>
                        </span>
                        Add User
                    </a>
                </div> 
            @endif

        </div>
    </div>       

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All User 
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
                            <th class="text-center">Email</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Joined At</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                       
                            @foreach ($users as $key=>$user)
                            <tr>
                                <td class="text-center text-muted">{{$key +1}}</td>
                                <td>
                                    <div class="widget-content p-0">
                                        <div class="widget-content-wrapper">
                                            <div class="widget-content-left mr-3">
                                                <div class="widget-content-left">
                                                <a href="{{$user->getFirstMediaUrl('avatar')}}" target="_blank">
                                                    <img width="40" class="rounded-circle" src="{{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar') : config('app.placeholder').'160.png'}}" alt="user image">
                                                </a>
                                                </div>
                                            </div>
                                            <div class="widget-content-left flex2">
                                                <div class="widget-heading">{{$user->name}}</div>
                                                <div class="widget-subheading opacity-7">
                                                    <div class="badge badge-info"> 
                                                    {{$user->role->name}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center text-muted"> {{$user->email}} </td>   
                                <td class="text-center">
                                   @if ($user->status)
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
                                    {{$user->created_at->diffForHumans()}} 
                                </td>
                                <td class="text-center">

                                    <button type="button" class="btn btn-sm btn-alternate" data-toggle="modal" data-target=".showData-{{$user->id}}">
                                        <i class="fas fa-eye mr-1"></i> 
                                        Show
                                    </button>

                            @if (Auth::user()->hasPermission('admin.users.edit'))
                                   <a href="{{route('admin.users.edit', $user->id)}}" class="btn btn-primary btn-sm">
                                       <i class="fas fa-edit mr-1"></i> Edit
                                   </a>
                             @endif

                            @if (Auth::user()->hasPermission('admin.users.destroy'))
                                 <button type="button" onclick="removeData('{{$user->id}}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash mr-1"></i> Delete
                                </button>
                                <form id="delete-form-{{$user->id}}" action="{{route('admin.users.destroy', $user->id)}}" method="post" style="display: none">
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


<!-- Show modal -->
@foreach ($users as $user)
<div class="modal fade showData-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">User Info</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <div class="row py-3">
                  <div class="col-md-4">
                       <img src=" {{ $user->getFirstMediaUrl('avatar') != null ? $user->getFirstMediaUrl('avatar') : config('app.placeholder').'250.png' }}" alt="" class="img-fluid">
                  </div>
                  <div class="col-md-8">
                        <table class="table table-hover">
                            <tr>
                                <th>Name</th>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <th>Role</th>
                                <td>
                                    <div class="badge badge-primary">{{$user->role->name}}</div>
                                </td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    @if ($user->status)
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
                                <td>{{$user->updated_at->diffForHumans()}}</td>
                            </tr>
                            <tr>
                                <th>Joined At</th>
                                <td>{{$user->created_at->diffForHumans()}}</td>
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
@endforeach
