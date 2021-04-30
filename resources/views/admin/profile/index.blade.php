@extends('layouts.backend.app')
@section('title',  Auth::user()->name.' Profile | Dashboard')

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
                    <i class="pe-7s-users icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                  Profile Info
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
        <form action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"  method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="{{ Auth::user()->getFirstMediaUrl('avatar')}}" alt="">
                        <div class="card-body">
                            <h4 class="card-title">
                                Name :  <strong class="ml-3"> {{Auth::user()->name}} </strong>
                            </h4>
                            <h4 class="card-title">
                                Email :  <strong class="ml-3"> {{Auth::user()->email}} </strong>
                            </h4>
                            <h4 class="card-title">
                                Role :  <strong class="ml-3 badge badge-info"> {{Auth::user()->role->name}} </strong>
                            </h4>
                            <h4 class="card-title">
                                Status :  
                                    @if (Auth::user()->status == true)
                                    <strong class="ml-2 badge badge-primary"> Active </strong>
                                    @else
                                    <strong class="ml-2 badge badge-secondary"> Disabled </strong>
                                    @endif
                            </h4>
                            <h4 class="card-title">
                                Joined :  <span class="ml-3"> {{Auth::user()->created_at->diffForHumans()}} </span>
                            </h4>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="avatar">Avatar</label>
                             <input type="file" id="avatar" name="avatar" class="dropify form-control @error('avatar') is-invalid @enderror" data-default-file="{{ Auth::user()->getFirstMediaUrl('avatar')}}">

                                @error('avatar')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        
                                <div class="position-relative form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{ Auth::user()->name }}" type="text" class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="email">Email</label>
                                    <input name="email" id="email" value="{{ Auth::user()->email }}" type="text" class="form-control @error('email') is-invalid @enderror">
                                    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                     
                                        <button type="submit" class="mt-1 btn btn-success">
                                            <i class="fas fa-save mr-1"></i> 
                                                Save Changes
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    $('.dropify').dropify();
    });
</script>
@endpush