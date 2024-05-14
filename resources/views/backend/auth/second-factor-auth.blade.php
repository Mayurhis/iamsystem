@extends('layouts.auth')

@section('title', trans('auth.2faPage.title'))

@section('main-content')

  <div class="login-wrapper">
    <div class="container">
        <div class="form-box">
          <form id="2FA_Form" class="form_wrapper" method="POST" action="{{route("admin.2fa.verify")}}">
              @csrf
              <div class="top-content-login">
                <h3 class="login-title logo-name mb-5">
                  <x-svg-icons icon="user_lock"></x-svg-icons>
                  {{ config('app.name') }}
                </h3>
                <h3 class="login-title text-left">@lang('auth.2faPage.title')</h3>
              </div>          
              <div class="mb-4">
                <label for="code" class="form-label">@lang('auth.2faPage.fields.code')<span class="mailstar" style="color: red;">*</span></label>
                <input type="text" name="verification_code" class="form-control" placeholder="{{ trans('auth.2faPage.fields.code_placeholder')}}" id="verification_code" autocomplete="off">
                @error('verification_code')
                <span class="invalid-feedback d-block">
                    {{ $message }}
                </span>
                @enderror
              </div>
            

              <button type="submit" class="nbtn nextstepbtn submitBtn">@lang('global.submit')</button>
            
              <div class="d-flex mt-5 justify-content-between">
                <a href="{{ route('admin.login') }}" class="d-block backLogin">Back To Login</a>
                <a href="javascript:void(0);" class="d-block backLogin resendBtn">Resend</a>
              </div>
              
          </form>
        </div>
    </div>
  </div>
  
@endsection

@section('customJS')

<script type="text/javascript">

  $(document).on('click','.resendBtn',function(e){

    e.preventDefault();

    $(".resendBtn").attr('disabled', true);
    loaderShow();

        $.ajax({
            type: 'post',
            url: "{{ route('admin.2fa.resendcode') }}",
            headers: {
                'X-CSRF-TOKEN':"{{ csrf_token() }}"
            },
            data: {},
            success: function (response) {
                
                if(response.success) {
    
                    fireSuccessSwal(response.title,response.message);

                    // toasterAlert('success',response.message);
                }
            },
            error: function (response) {
                loaderHide();

                if(response.responseJSON.error_type == 'something_error'){
                    toasterAlert('error', response.responseJSON.error);
                }else if(response.responseJSON.error_type == 'unauthorized'){
                    toasterAlert('error',response.responseJSON.error);
                    window.location.href = "{{ route('admin.login') }}";
                }
            },
            complete: function(res){
                $(".resendBtn").attr('disabled', false);
                loaderHide();
            }
        });

  });

</script>

@endsection
