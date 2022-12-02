@extends('layout')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">{{ __('Register') }}</div>

        <div class="card-body">
          <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group row">
              <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

              <div class="col-md-6">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

              <div class="col-md-6">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

              <div class="col-md-6">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>

            <div class="form-group row">
              <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

              <div class="col-md-6">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
              </div>
            </div>

            <div class="form-group row">
              <label for="cuit" class="col-md-4 col-form-label text-md-right">{{ __('cuit') }}</label>
              <div class="col-md-6">
                <input id="cuit" type="text" class="form-control @error('cuit') is-invalid @enderror" 
                      name="cuit" value="{{ old('cuit') }}" required autocomplete="cuit">
                @error('cuit')
                  <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
              </div>
            </div>           
            
            <div class="form-group row">
              <label for="condition" class="col-md-4 col-form-label text-md-right">{{ __('condition') }}</label>
              <div class="col-md-6">
                <input id="condition" type="text" class="form-control @error('condition') is-invalid @enderror" 
                      name="condition" value="{{ old('condition') }}" required autocomplete="condition">
                @error('cuit')
                  <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
              </div>
            </div>  

            <div class="form-group row">
              <label for="direction" class="col-md-4 col-form-label text-md-right">{{ __('direction') }}</label>
              <div class="col-md-6">
                <input id="direction" type="text" class="form-control @error('direction') is-invalid @enderror" 
                      name="direction" value="{{ old('direction') }}" required autocomplete="direction">
                @error('direction')
                  <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
              </div>
            </div> 

            <div class="form-group row">
              <label for="activity_start" class="col-md-4 col-form-label text-md-right">{{ __('activity_start') }}</label>
              <div class="col-md-6">
                <input id="activity_start" type="text" class="form-control @error('activity_start') is-invalid @enderror" 
                      name="activity_start" value="{{ old('activity_start') }}" required autocomplete="activity_start">
                @error('activity_start')
                  <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
              </div>
            </div> 

            <div class="form-group row">
              <label for="gross_receipts_tax" class="col-md-4 col-form-label text-md-right">{{ __('gross_receipts_tax') }}</label>
              <div class="col-md-6">
                <input id="gross_receipts_tax" type="text" class="form-control @error('gross_receipts_tax') is-invalid @enderror" 
                      name="gross_receipts_tax" value="{{ old('gross_receipts_tax') }}" required autocomplete="gross_receipts_tax">
                @error('gross_receipts_tax')
                  <span class="invalid-feedback" role="alert"> <strong>{{ $message }}</strong> </span>
                @enderror
              </div>
            </div> 
































            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">
                  {{ __('Register') }}
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection