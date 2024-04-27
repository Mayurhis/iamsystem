@extends('layouts.app')
@section('title', trans('global.change_password'))
@section('custom_CSS')
@endsection

@section('main-content')

    <div class="dash-right-area">
        <div class="mobile-header d-md-none">
            <div class="mob-logo">
                <a href="javascript:void(0);" title="logo"><img src="{{ asset('backend/images/logo.png') }}" alt="logo" class="img-fluid"></a>
            </div>
            <div class="humberger-icon">
                <img src="{{ asset('backend/images/humberger-icon.svg') }}" alt="humberger-icon">
            </div>
        </div>
        <div class="dash-title">
            <h2 class="main-title">@lang('global.change_password')</h2>
        </div>

        <div class="card">
            <div class="card-body">

                <form id="changePasswordForm" method="POST" action="{{ route('admin.updatePassword') }}">
                    @csrf
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group detail-fields">
                                <label>Current Password</label>
                                <input type="password" name="current_password" id="current_password" placeholder="Current Password" autocomplete="off">
                                @error('current_password')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group detail-fields">
                                <label>Password</label>
                                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off"/>
                                @error('password')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group detail-fields">
                                <label>Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" autocomplete="off"/>
                                @error('confirm_password')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                        
                    </div>

                    <div class="configuration_btns">

                        <button type="submit" class="btn btn-success submitBtn">@lang('global.submit')</button>
                        
                    </div>
                  
                </form>

            </div>
        </div>
        
    </div>

@endsection
@section('custom_JS')

<script type="text/javascript">

    $(document).ready(function(){

        $(document).on('submit', '#changePasswordForm', function (e) {
            e.preventDefault();
            
            loaderShow();

            $('.invalid-feedback').remove();
            $(".submitBtn").attr('disabled', true);

            var form     = $(this);
            var formData = new FormData(this);
            var actionUrl = form.attr('action');

            $.ajax({
                type: 'post',
                url: actionUrl,
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {                
                    if(response.success) {
                        form[0].reset();
                        toasterAlert('success',response.message);
                    }
                },
                error: function (response) {
                    loaderHide();
                    $(".submitBtn").attr('disabled', false);

                    if(response.responseJSON.error_type == 'something_error'){
                        toasterAlert('error',response.responseJSON.error);
                    } else {                    
                        var errorLabelTitle = '';
                        $.each(response.responseJSON.errors, function (key, item) {
                            errorLabelTitle = '<span class="invalid-feedback d-block">'+item[0]+'</sapn>';
                            $(errorLabelTitle).insertAfter("input[name='"+key+"']");            
                        });
                    }
                },
                complete: function(res){
                    $(".submitBtn").attr('disabled', false);
                    loaderHide();
                }
            });     
            
            
        });
    });

</script>
@endsection
