@extends('layouts.backend.app')

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
                  General Settings
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.dashboard')}}" class="btn-shadow btn btn-danger">
                        <span class="btn-icon-wrapper pr-1 opacity-7">
                           <i class="fas fa-home    "></i>
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
                            <h5 class="card-title">How to use !</h5>
                            <p>You can output a menu anywhere on your site by calling <code>setting('key')</code></p>
                        </div>
                    </div>   

                    <div class="main-card mb-3 card">
                        <div class="card-body">

                            <form method="POST" action="{{ route('admin.settings.general.update') }}">
                                @csrf
                                @method('PUT')
                            {{-- Here setting() is a helper function --}}
                                <div class="position-relative form-group">
                                    <label for="site_title">Site Name
                                        <code>{ setting('site_title') } (white space not allowed)</code>
                                    </label>
                                    <input name="site_title" id="site_title" value="{{ setting('site_title') ?? old('site_title')}}" type="text" class="form-control @error('site_title') is-invalid @enderror">

                                    @error('site_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_description">Site Description 
                                        <code>{ setting('site_description') }</code>
                                    </label>
                                    <textarea name="site_description" id="site_description"
                                       class="form-control pl-0 @error('site_description') is-invalid @enderror" rows="3">
                                       {{ setting('site_description') ?? old('site_description') }}
                                    </textarea>
                                    @error('site_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="site_address">Site Address 
                                        <code>{ setting('site_address') }</code>
                                    </label>
                                    <textarea name="site_address" id="site_address"
                                       class="form-control @error('site_address') is-invalid @enderror" rows="3">
                                       {{ setting('site_address') ?? old('site_address') }}
                                    </textarea>
                                    @error('site_address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
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
