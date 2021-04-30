@extends('layouts.backend.app')
@section('title', 'Inventory Management | Dashboard')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-smile icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                    @role('admin')
                        Admin Dashboard
                       @else
                       User Dashboard
                    @endrole
                </div>
            </div>
        </div>
    </div>           
     <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3 widget-content bg-danger">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Page</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span> {{ $pageCount }} </span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3 widget-content bg-info">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Role</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span> {{ $roleCount }} </span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3 widget-content bg-midnight-bloom">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total Menu</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span> {{ $menuCount }} </span></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3 widget-content bg-primary">
                <div class="widget-content-wrapper text-white">
                    <div class="widget-content-left">
                        <div class="widget-heading">Total User</div>
                    </div>
                    <div class="widget-content-right">
                        <div class="widget-numbers text-white"><span> {{ $userCount }} </span></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Recent Users
                    <div class="btn-actions-pane-right">
                        <div role="group" class="btn-group-sm btn-group">
                            <button class="active btn btn-focus">Last Week</button>
                            <button class="btn btn-focus">All Month</button>
                        </div>
                    </div>
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
