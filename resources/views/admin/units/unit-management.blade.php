@extends('layouts.backend.app')
@section('title', 'Unit Management | Dashboard')

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
                   {{ isset($unit) ? 'Edit' : 'Create' }} Unit
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.units.index')}}" class="btn-shadow btn btn-danger">
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
        <form action="{{ isset($unit) ? route('admin.units.update', $unit->id) : route('admin.units.store') }}" method="POST">
            @csrf
            @isset($unit)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Unit</h5>
                        
                                <div class="position-relative form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{ $unit->name ?? old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status" @isset($unit) {{ $unit->status == true ? 'checked' : '' }} @endisset>
                                        <label class="custom-control-label" for="status">Status</label> 
                                      </div>
                                      @error('status')
                                      <span class="text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                                     
                                    @isset($unit)
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
