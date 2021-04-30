@extends('layouts.backend.app')
@section('title', 'Change Password | Dashboard')

@push('css')

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
                 Change Password
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.dashboard')}}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                            <i class="fas fa-arrow-circle-left"></i>
                        </span>
                      Dashboard
                    </a>
            </div>    
        </div>
    </div>       

    <div class="row">

    <div class="col-md-12">
        <form action="{{ route('admin.profile.password.update') }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row mb-5">
                <div class="col-md-6 m-auto">
                    <div class="main-card mb-3 card">
                        <div class="card-body">

                                <div class="position-relative form-group">
                                    <label for="old_password">Old Password</label>
                                    <input name="old_password" id="old_password" type="password" class="form-control @error('old_password') is-invalid @enderror">

                                    @error('old_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="password">New Password</label>
                                    <input name="password" id="password" type="password" class="form-control @error('password') is-invalid @enderror">
                                    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input name="password_confirmation" id="password_confirmation" type="password" class="form-control @error('password') is-invalid @enderror">    
                                </div>
                                     
                                        <button type="submit" class="mt-1 btn btn-primary">
                                            <i class="fas fa-save mr-1"></i> 
                                              Change Password
                                        </button>          
                                
                        </div>
                    </div>
                </div>
            </div>
</form>
</div>
</div>
@endsection

@push('js')

@endpush