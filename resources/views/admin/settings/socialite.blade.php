@extends('layouts.backend.app')
@section('title', 'Socialite Settings | Dashboard')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                  Socialite Settings (  <code> White space not allowed </code> )
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.dashboard')}}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                           <i class="fas fa-home "></i>
                        </span>
                       Go  Back
                    </a>
            </div>    
        </div>
    </div>       

    <div class="row">
    <div class="col-md-12">
            <div class="row">

                <div class="col-md-3">
                    @include('admin.settings.sidebar')
                </div>

                <div class="col-md-9"> 

                    <div class="main-card mb-3 card">
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.settings.socialite.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="facebook_client_id">Facebook Client Id</label>
                                            <input name="facebook_client_id" id="facebook_client_id" value="{{ setting('facebook_client_id') ?? old('facebook_client_id')}}" type="text" class="form-control @error('facebook_client_id') is-invalid @enderror">
        
                                            @error('facebook_client_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="facebook_client_secret">Facebook Client Secret</label>
                                            <input name="facebook_client_secret" id="facebook_client_secret" value="{{ setting('facebook_client_secret') ?? old('facebook_client_secret')}}" type="text" class="form-control @error('facebook_client_secret') is-invalid @enderror">
        
                                            @error('facebook_client_secret')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="google_client_id">Google Client Id</label>
                                            <input name="google_client_id" id="google_client_id" value="{{ setting('google_client_id') ?? old('google_client_id')}}" type="text" class="form-control @error('google_client_id') is-invalid @enderror">
        
                                            @error('google_client_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="google_client_secret">Google Client Secret</label>
                                            <input name="google_client_secret" id="google_client_secret" value="{{ setting('google_client_secret') ?? old('google_client_secret')}}" type="text" class="form-control @error('google_client_secret') is-invalid @enderror">
        
                                            @error('google_client_secret')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="github_client_id">Github Client Id</label>
                                            <input name="github_client_id" id="github_client_id" value="{{ setting('github_client_id') ?? old('github_client_id')}}" type="text" class="form-control @error('github_client_id') is-invalid @enderror">
        
                                            @error('github_client_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="github_client_secret">Github Client Secret</label>
                                            <input name="github_client_secret" id="github_client_secret" value="{{ setting('github_client_secret') ?? old('github_client_secret')}}" type="text" class="form-control @error('github_client_secret') is-invalid @enderror">
        
                                            @error('github_client_secret')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                        <button type="submit" class="mt-1 btn btn-success">
                                            <i class="fas fa-save  mr-1 "></i>
                                            Update
                                        </button>    
                            </form>
                                
                        </div>
                    </div>
                </div>

            </div>
</div>
</div>
@endsection
