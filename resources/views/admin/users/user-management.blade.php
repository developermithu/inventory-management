@extends('layouts.backend.app')
@section('title', 'User Management | Dashboard')

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
<style>
    .dropify-wrapper .dropify-message p{
        font-size: initial;
    }
</style>
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
                   {{ isset($user) ? 'Edit' : 'Create' }} User
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.users.index')}}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-arrow-circle-left"></i>
                        </span>
                       Go  Back
                    </a>
            </div>    
        </div>
    </div>       

    <div class="row">

    <div class="col-md-12">
        <form action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}" enctype="multipart/form-data"  method="POST">
            @csrf
            @isset($user)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage User</h5>
                        
                                <div class="position-relative form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{ $user->name ?? old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="email">Email</label>
                                    <input name="email" id="email" value="{{ $user->email ?? old('email')}}" type="text" class="form-control @error('email') is-invalid @enderror">
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="password">Password</label>
                                    <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control">
                                </div>

                                     
                                    @isset($user)
                                        <button type="submit" class="mt-1 btn btn-success">
                                            <i class="fas fa-save mr-1"></i> 
                                                Save
                                        </button>
                                        @else
                                        <button type="submit" class="mt-1 btn btn-primary">
                                            <i class="fas fa-plus-circle mr-1"></i> 
                                            Submit
                                        </button>
                                    @endisset
                               
                                
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage User Role</h5>

                                <div class="form-group">
                                    <label for="role">Select Role</label>
                                    <select name="role_id" id="role" class="js-example-basic-single form-control" required>
                                       @foreach ($roles as $role)
                                       <option value="{{$role->id}}"
                                        @isset($user)
                                            {{$user->role->id == $role->id ? 'selected' : '' }}
                                        @endisset
                                        >{{$role->name}}</option>
                                       @endforeach

                                       @error('role_id')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="avatar">Avatar</label>
                                 <input type="file" id="avatar" name="avatar" class="dropify form-control @error('avatar') is-invalid @enderror" data-default-file="{{ isset($user) ? $user->getFirstMediaUrl('avatar') : '' }}">

                                    @error('avatar')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status" @isset($user) {{ $user->status == true ? 'checked' : '' }} @endisset>
                                        <label class="custom-control-label" for="status">Status</label> 
                                      </div>
                                      @error('status')
                                      <span class="text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>

                        </div>
                    </div>
                </div>
            </div>
</form>
</div>
</div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.dropify').dropify();
    });
</script>
@endpush