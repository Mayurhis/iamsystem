@extends('layouts.auth')

@section('title', trans('auth.loginPage.title'))

@section('main-content')

  <div class="login-wrapper">
    <div class="container">
        <div class="form-box">
          <form id="loginForm" class="form_wrapper" method="POST" action="{{route("admin.login")}}">
              @csrf
              <div class="top-content-login">
                {{-- <img src="{{ asset('backend/images/logo.png') }}" alt="logo" title="logo-img"> --}}
                <h3 class="login-title logo-name mb-5">
                  <x-svg-icons icon="user_lock"></x-svg-icons>
                  {{ config('app.name') }}
                </h3>
                <h3 class="login-title text-left">@lang('auth.loginPage.title')</h3>
              </div>          
              <div class="mb-3">
                <label for="email" class="form-label">@lang('auth.loginPage.fields.email')<span class="mailstar" style="color: red;">*</span></label>
                <input type="email" name="email" class="form-control" placeholder="{{ trans('auth.loginPage.fields.email_placeholder')}}" id="email" aria-describedby="emailHelp">
                @error('email')
                <span class="invalid-feedback d-block">
                    {{ $message }}
                </span>
                @enderror
              </div>
              
              <div class="mb-3">
                  <label for="password">@lang('auth.loginPage.fields.password')<span class="mailstar" style="color: red;">*</span></label>
                  <div class="input-password-wrap">
                      <input type="password" name="password"  placeholder="{{ trans('auth.loginPage.fields.password_placeholder')}}" class="form-control" id="password" autocomplete="off">
                      <i class="fa fa-eye-slash" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                  </div>
                  @error('password')
                  <span class="invalid-feedback d-block">
                      {{ $message }}
                  </span>
                  @enderror
              </div>

              <div class="d-flex justify-content-between align-items-start">
                <div class="mb-3 form-check">
                  {{-- <input type="checkbox" name="remember_me" class="form-check-input" id="remember_me">
                  <label class="form-check-label" for="remember_me">@lang('global.remember_me')</label> --}}
                </div>
                <p class="m-0 text-end forgot-text"><a href="{{ route('admin.showForgotPassword') }}">Forgot Password</a></p>
              </div>
              
              <button type="submit" class="nbtn nextstepbtn submitBtn">@lang('global.submit')</button>
          </form>
        </div>
    </div>
  </div>
  
@endsection

@section('customJS')
<script>
  
  document.addEventListener("DOMContentLoaded", () => {
          const togglePassword = document.querySelector('#togglePassword');
          const password = document.querySelector('#password');
          togglePassword.addEventListener('click', function (e) {
              // toggle the type attribute
              const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
              password.setAttribute('type', type);
              // toggle the eye slash icon
              this.classList.toggle('fa-eye');
          });
      });
</script>
@endsection
