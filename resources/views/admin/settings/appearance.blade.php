@extends('layouts.backend.app')

@push('css')
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
                    <i class="pe-7s-settings icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                  Appearance Settings
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

                            <form method="POST" action="{{ route('admin.settings.appearance.update') }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                            <!-- Here setting() is a helper function -->
                                    <div class="form-group">
                                        <label for="site_logo">Site Logo 
                                            <code>{ name:site_logo } ( Storage::url(setting('site_logo')) )</code>
                                        </label>
                                        <input type="file" id="site_logo" name="site_logo" class="dropify form-control @error('site_logo') is-invalid @enderror" data-default-file="{{ setting('site_logo') != null ? Storage::url(setting('site_logo')) : '' }}">

                                        @error('site_logo')
                                            <span class="text-danger" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="site_favicon">Site Favicon 
                                            <code>{ name:site_favicon }</code>
                                        </label>
                                        <input type="file" id="site_favicon" name="site_favicon" class="dropify form-control @error('site_favicon') is-invalid @enderror" data-default-file="{{ setting('site_favicon') != null ? Storage::url(setting('site_favicon')) : '' }}">

                                        @error('site_favicon')
                                            <span class="text-danger" role="alert">
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

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
    $('.dropify').dropify();
    });
</script>
@endpush