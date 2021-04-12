@extends('layouts.backend.app')

@section('content')
<div class="app-main__inner">
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                   {{ isset($menu) ? 'Edit' : 'Create' }} Menu
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.menus.index')}}" class="btn-shadow btn btn-danger">
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
        <form action="{{ isset($menu) ? route('admin.menus.update', $menu->id) : route('admin.menus.store') }}" method="POST">
            @csrf
            @isset($menu)
                @method('PUT')
            @endisset

            <div class="row mb-5">
                <div class="col-md-8 m-auto">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Menu</h5>
                        
                                <div class="position-relative form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{ $menu->name ?? old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        
                                <div class="position-relative form-group">
                                    <label for="description">Description 
                                        <span>(optional)</span>
                                    </label>
                                    <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror">
                                        {{ $menu->description ?? old('description')}}
                                    </textarea>

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        
                                    @isset($page)
                                        <button type="submit" class="mt-1 btn btn-success">
                                            <i class="fas fa-save mr-1"></i> 
                                                Save Changes
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
            </div>
</form>
</div>
</div>
@endsection
