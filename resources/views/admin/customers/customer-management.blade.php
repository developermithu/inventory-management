@extends('layouts.backend.app')

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
                   {{ isset($customer) ? 'Edit' : 'Create' }} Customer
                </div>
            </div>
            <div class="page-title-actions">
                    <a href="{{route('admin.customers.index')}}" class="btn-shadow btn btn-danger">
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
        <form action="{{ isset($customer) ? route('admin.customers.update', $customer->id) : route('admin.customers.store') }}" method="POST">
            @csrf
            @isset($customer)
                @method('PUT')
            @endisset

            <div class="row">
                <div class="col-md-8 offset-2">
                    <div class="main-card mb-3 card">
                        <div class="card-body">
                            <h5 class="card-title">Manage Customer</h5>
                        
                                <div class="position-relative form-group">
                                    <label for="name">Name</label>
                                    <input name="name" id="name" value="{{ $customer->name ?? old('name')}}" type="text" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="email">Email <span>(Optional)</span></label>
                                    <input name="email" id="email" value="{{ $customer->email ?? old('email')}}" type="text" class="form-control @error('email') is-invalid @enderror">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="mobile">Mobile</label>
                                    <input name="mobile" id="mobile" maxlength="11" minlength="11" value="{{ $customer->mobile ?? old('mobile')}}" type="number" class="form-control @error('mobile') is-invalid @enderror">
                                    @error('mobile')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="position-relative form-group">
                                    <label for="address">Address</label>
                                    <input name="address" id="address" value="{{ $customer->address ?? old('address')}}" type="text" class="form-control @error('address') is-invalid @enderror">
                                    @error('address')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" name="status" class="custom-control-input" id="status" @isset($customer) {{ $customer->status == true ? 'checked' : '' }} @endisset>
                                        <label class="custom-control-label" for="status">Status</label> 
                                      </div>
                                      @error('status')
                                      <span class="text-danger" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                                </div>
                                     
                                    @isset($customer)
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
