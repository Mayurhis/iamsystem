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
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <g clip-path="url(#clip0_2002_4)">
                  <path d="M8 0C4.691 0 2 2.691 2 6C2 9.309 4.691 12 8 12C11.309 12 14 9.309 14 6C14 2.691 11.309 0 8 0ZM8 11C5.243 11 3 8.757 3 6C3 3.243 5.243 1 8 1C10.757 1 13 3.243 13 6C13 8.757 10.757 11 8 11ZM11.942 15.599C11.814 15.844 11.511 15.937 11.267 15.807C10.267 15.279 9.138 15 8 15C4.14 15 1 18.14 1 22V23.5C1 23.776 0.776 24 0.5 24C0.224 24 0 23.776 0 23.5V22C0 17.589 3.589 14 8 14C9.3 14 10.591 14.319 11.734 14.923C11.978 15.052 12.072 15.354 11.942 15.598V15.599ZM22 15.339V13.501C22 11.571 20.43 10.001 18.5 10.001C16.57 10.001 15 11.571 15 13.501V15.339C13.819 15.902 13 17.108 13 18.501V20.501C13 22.431 14.57 24.001 16.5 24.001H20.5C22.43 24.001 24 22.431 24 20.501V18.501C24 17.108 23.181 15.902 22 15.339ZM16 13.501C16 12.123 17.122 11.001 18.5 11.001C19.878 11.001 21 12.123 21 13.501V15.037C20.837 15.014 20.67 15.001 20.5 15.001H16.5C16.33 15.001 16.163 15.013 16 15.037V13.501ZM23 20.501C23 21.879 21.878 23.001 20.5 23.001H16.5C15.122 23.001 14 21.879 14 20.501V18.501C14 17.123 15.122 16.001 16.5 16.001H20.5C21.878 16.001 23 17.123 23 18.501V20.501ZM19.5 19.501C19.5 20.053 19.052 20.501 18.5 20.501C17.948 20.501 17.5 20.053 17.5 19.501C17.5 18.949 17.948 18.501 18.5 18.501C19.052 18.501 19.5 18.949 19.5 19.501Z" fill="white"/>
                  </g>
                  <defs>
                  <clipPath id="clip0_2002_4">
                  <rect width="24" height="24" fill="white"/>
                  </clipPath>
                  </defs>
                </svg>
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
