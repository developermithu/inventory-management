@extends('layouts.backend.app')

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
                   @isset($role)
                       Edit Role
                       @else 
                       Create Role
                   @endisset
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.roles.index')}}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-arrow-circle-left    "></i>
                        </span>
                        Back
                    </a>
            </div>    
        </div>
    </div>       

    <div class="row">
        <div class="col-md-10 m-auto">
            <div class="main-card mb-3 card">
                <div class="card-body">
                    <h5 class="card-title">Manage Role</h5>
                    <form action="{{ isset($role) ? route('admin.roles.update', $role->id) : route('admin.roles.store') }}"  method="POST">
                        @csrf

                        @isset($role)
                            @method('PUT')
                        @endisset

                        <div class="position-relative form-group">
                            <input name="name" value="{{ $role->name ?? old('name')}}" 
                            placeholder="Type role name.." type="text" class="form-control @error('name') is-invalid @enderror">
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="text-center">
                            <strong>Manage permissions for role</strong>
                        </div>

                        <div class="text-center text-danger">
                            @error('permissions')
                                <strong>{{ $message }}</strong>
                        @enderror
                        </div>

                        <div class="mt-4">
                            <div class="custom-checkbox custom-control">
                                <input type="checkbox" id="select-all" class="custom-control-input">
                                <label class="custom-control-label" for="select-all">Select All</label>
                            </div>
                        </div>

                        <div class="my-2 ">
                            @forelse ($modules->chunk(3) as $chunks)
                                <div class="form-row my-3">
                                    @foreach ($chunks as $module)
                                        <div class="col">
                                            <h5>Module: {{$module->name}} </h5>
                                            @foreach ($module->permissions as $permission)
                                                <div class="mb-1">
                                                    <div class="custom-checkbox custom-control">
                                                        <input name="permissions[]" value="{{$permission->id}}" type="checkbox" id="permission-{{$permission->id}}" class="custom-control-input"
                                                        @isset($role)
                                                            @foreach($role->permissions as $rolePermission)
                                                                {{ $permission->id == $rolePermission->id ? 'checked' : '' }}
                                                            @endforeach
                                                        @endisset
                                                        >
                                                        <label class="custom-control-label" for="permission-{{$permission->id}}">{{$permission->name}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                </div>
                            @empty
                                <div class="row">
                                    <div class="col text-center">
                                        <strong>No module found.</strong>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <button type="submit" class="mt-1 btn btn-primary">      
                            @isset($role)
                            <i class="fas fa-save mr-1"></i> 
                                Save
                                @else
                                <i class="fas fa-plus-circle mr-1"></i> 
                                Submit
                            @endisset
                        </button>
                    </form>
                </div>
            </div>
    </div>

</div>
@endsection

@push('js')
    <script>
        $('#select-all').click( function(e) {
            if (this.checked) {
                $(':checkbox').each( function (){
                    this.checked = true;
                });
            } else {
                $(':checkbox').each( function (){
                    this.checked = false;
                });
            }
        })
    </script>
@endpush