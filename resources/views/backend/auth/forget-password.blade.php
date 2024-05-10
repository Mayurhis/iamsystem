@extends('layouts.auth')

@section('title', trans('auth.forgetPasswordPage.title'))

@section('main-content')

  <div class="login-wrapper">
    <div class="container">
        <div class="form-box">
          <form id="ForgotPasswordForm" class="form_wrapper" method="POST" action="{{route("admin.submitForgotPassword")}}">
              @csrf
              <div class="top-content-login">
                <h3 class="login-title logo-name mb-5">
                  <x-svg-icons icon="user_lock"></x-svg-icons>
                  {{ config('app.name') }}
                </h3>
                <h3 class="login-title text-left">@lang('auth.forgetPasswordPage.title')</h3>
              </div>          
              <div class="mb-4">
                <label for="email" class="form-label">@lang('auth.forgetPasswordPage.fields.email')<span class="mailstar" style="color: red;">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="{{ trans('auth.forgetPasswordPage.fields.email_placeholder')}}" id="email" aria-describedby="emailHelp">
                @error('email')
                <span class="invalid-feedback d-block">
                    {{ $message }}
                </span>
                @enderror
              </div>
              <button type="submit" class="nbtn nextstepbtn submitBtn">@lang('global.submit')</button>
              <a href="{{ route('admin.login') }}" class="mt-5 text-center d-block backLogin">Back To Login</a>
          </form>
        </div>
    </div>
  </div>
  
@endsection

@section('customJS')

@endsection
