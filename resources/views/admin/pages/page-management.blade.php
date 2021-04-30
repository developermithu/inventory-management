@extends('layouts.backend.app')
@section('title', 'Page Management | Dashboard')

@push('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.css"/>
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
                    <i class="pe-7s-news-paper icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>
                   {{ isset($page) ? 'Edit' : 'Create' }} page
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.pages.index')}}" class="btn-shadow btn btn-danger">
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
        <form action="{{ isset($page) ? route('admin.pages.update', $page->id) : route('admin.pages.store') }}" enctype="multipart/form-data"  method="POST">
            @csrf
            @isset($page)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-8">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Page</h5>
                        
                                <div class="position-relative form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{ $page->name ?? old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        
                                <div class="position-relative form-group">
                                    <label for="excerpt">Excerpt</label>
                                    <textarea name="excerpt" id="excerpt" class="form-control @error('excerpt') is-invalid @enderror">
                                        {{ $page->excerpt ?? old('excerpt')}}
                                    </textarea>

                                    @error('excerpt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                        
                                <div class="position-relative form-group">
                                    <label for="body">Body</label>
                                    <textarea id="summernote" name="body" class="form-control @error('body') is-invalid @enderror">
                                        {{ $page->body ?? old('body')}}
                                    </textarea>

                                    @error('body')
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

                <div class="col-md-4">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Page Role</h5>

                                <div class="form-group">
                                    <label for="image">Image 
                                        <span class="text-muted">(optional)</span>
                                    </label>
                                 <input type="file" id="image" name="image" class="dropify form-control @error('image') is-invalid @enderror" data-default-file="{{ isset($page) ? $page->getFirstMediaUrl('image') : '' }}">

                                    @error('image')
                                        <span class="text-danger" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status" @isset($page) {{ $page->status == true ? 'checked' : '' }} @endisset>
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
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Meta Info</h5>

                            <div class="position-relative form-group">
                                <label for="meta_description">Meta Description 
                                    <span class="text-muted">(optional)</span>
                                </label>
                                <textarea name="meta_description" id="meta_description" class="form-control @error('meta_description') is-invalid @enderror">
                                    {{ $page->meta_description ?? old('meta_description')}}
                                </textarea>

                                @error('meta_description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="position-relative form-group">
                                <label for="meta_keywords">
                                    Meta Keywords <span class="text-muted">(separate by comma)</span>
                                 </label>
                                <textarea name="meta_keywords" id="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror">
                                    {{ $page->meta_keywords ?? old('meta_keywords')}}
                                </textarea>

                                @error('meta_keywords')
                                    <span class="invalid-feedback" role="alert">
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-lite.min.js"></script>
<script>
    $(document).ready(function() {
    // dropify
    $('.dropify').dropify();

    // summernote
    $('#summernote').summernote({
        minHeight: 120,
    });
    });
</script>
@endpush