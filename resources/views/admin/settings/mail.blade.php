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
                  Mail Settings (  <code> White space not allowed</code> )
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

                            <form method="POST" action="{{ route('admin.settings.mail.update') }}">
                                @csrf
                                @method('PUT')

                                <div class="form-row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mail_mailer">Mail Mailer</label>
                                            <input name="mail_mailer" id="mail_mailer" value="{{ setting('mail_mailer') ?? old('mail_mailer')}}" type="text" class="form-control @error('mail_mailer') is-invalid @enderror" placeholder="ex: smtp">
        
                                            @error('mail_mailer')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mail_host">Mail Host</label>
                                            <input name="mail_host" id="mail_host" value="{{ setting('mail_host') ?? old('mail_host')}}" type="text" class="form-control @error('mail_host') is-invalid @enderror"
                                            placeholder="ex: smtp.mailtrap.io">
        
                                            @error('mail_host')
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
                                            <label for="mail_port">Mail Port</label>
                                            <input name="mail_port" id="mail_port" value="{{ setting('mail_port') ?? old('mail_port')}}" type="text" class="form-control @error('mail_port') is-invalid @enderror"
                                            placeholder="ex: 2525">
        
                                            @error('mail_port')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mail_username">Mail Username</label>
                                            <input name="mail_username" id="mail_username" value="{{ setting('mail_username') ?? old('mail_username')}}" type="text" class="form-control @error('mail_username') is-invalid @enderror"
                                            placeholder="ex: username">
        
                                            @error('mail_username')
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
                                            <label for="mail_password">Mail Password</label>
                                            <input name="mail_password" id="mail_password" value="{{ setting('mail_password') ?? old('mail_password')}}" type="password" class="form-control @error('mail_password') is-invalid @enderror"
                                            placeholder="ex: password">
        
                                            @error('mail_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mail_encryption">Mail Encryption</label>
                                            <input name="mail_encryption" id="mail_encryption" value="{{ setting('mail_encryption') ?? old('mail_encryption')}}" type="text" class="form-control @error('mail_encryption') is-invalid @enderror"
                                            placeholder="ex: tls">
        
                                            @error('mail_encryption')
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
                                            <label for="mail_from_address">Mail From Address</label>
                                            <input name="mail_from_address" id="mail_from_address" value="{{ setting('mail_from_address') ?? old('mail_from_address')}}" type="text" class="form-control @error('mail_from_address') is-invalid @enderror"
                                            placeholder="ex: test@gmail.com">
        
                                            @error('mail_from_address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="mail_from_name">Mail From Name</label>
                                            <input name="mail_from_name" id="mail_from_name" value="{{ setting('mail_from_name') ?? old('mail_from_name')}}" type="text" class="form-control @error('mail_from_name') is-invalid @enderror"
                                            placeholder="ex: app_name">
        
                                            @error('mail_from_name')
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
