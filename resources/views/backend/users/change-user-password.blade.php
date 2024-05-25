@extends('layouts.app')
@section('title', 'Change User Password')

@section('custom_CSS')
@endsection

@section('headerTitle','Change User Password')

@section('main-content')


<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="title brand-listing">
                    <h5 class="table-subtitle">
                        Change User Password
                    </h5>
                </div>
                <div class="card-content">
                    <form class="card-form mb-3" id="changeUserPasswordForm" method="POST" action="{{ route('admin.users.submitChangeUserPassword', $user['ID']) }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label>@lang('cruds.user.fields.password')<span class="text-danger">*</span></label>
                                    <div class="input-password-wrap">
                                        <input type="password" name="password" id="password" value="{{ $user['password'] ?? ''}}" class="form-control valid" placeholder="Enter Password" autocomplete="off">
                                        <i class="fa fa-eye-slash text-dark" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                    </div>
                                    <div class="text-end d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary mt-3" id="suggestPasswordBtn">@lang('global.suggest_password')</button>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="grid-btn float-end">
                            <input type="hidden" name="user_id"  value="{{ $user['ID'] ?? ''}}">
                            <button type="submit" class="btn btn-primary btn-regular submitBtn">@lang('global.update')</button>
                            
                            <a href="{{ route('admin.users.index') }}" class="btn btn-regular btn-secondary">@lang('global.cancel')</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.partials.generate-password-modal')

@endsection

@section('custom_JS')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

@parent
<script type="text/javascript">

    $(document).ready(function () {
   
       $("#changeUserPasswordForm").validate({
           errorElement: 'span',
           errorClass: 'validation-error-block error',
           rules: {
               password: {
                   required: true,
                   minlength: "{{ config('constant.password_min_length') }}",
                   passwordPattern: true,
               },
               
           },
           messages: {
               required: "This field is required.",
               password: {
                   minlength: "Password must be at least {{ config('constant.password_min_length') }} characters long"
               },
           },
           errorPlacement: function(error, element) {
                if ($(element).attr('type') === 'password') {
                    error.insertAfter(element.parent('div'));
                } else {
                    error.insertAfter(element);
                }
            },
       });

       var passwordRegex = {{ config('constant.password_regex') }};
       $.validator.addMethod("passwordPattern", function(value, element) {
            return passwordRegex.test(value);
        }, "{{ trans('messages.password_regex') }}");
        
        
          $("#changeUserPasswordForm input").on("blur", function() {
            $(this).siblings('.validation-error-block').remove();
        });

   });

    // Submit Add User Form
    $(document).on('submit', '#changeUserPasswordForm', function (e) {
        e.preventDefault();

        if ($(this).valid()) {
            loaderShow();

            $('.validation-error-block').remove();
            $(".submitBtn").attr('disabled', true);

            var $this = $(this);
            var formData = new FormData(this);

            $.ajax({
                type: $this.attr('method'),
                url: $this.attr('action'),
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {                
                    if(response.success) {
                        toasterAlert('success',response.message);
                        setTimeout(function() {
                            window.location.href = "{{ route('admin.users.index') }}";
                        }, 2000);
                    }
                },
                error: function (response) {
                    $(".submitBtn").attr('disabled', false);
                    loaderHide();
                    if(response.responseJSON.error_type == 'something_error'){
                        toasterAlert('error',response.responseJSON.error);
                    } else if(response.responseJSON.error_type == 'unauthorized'){
                        toasterAlert('error',response.responseJSON.error);
                        window.location.href = "{{ route('admin.login') }}";
                    }else {                    
                        var errorLabelTitle = '';
                        var passwordElements = ['password'];
                        $.each(response.responseJSON.errors, function (key, item) {

                            errorLabelTitle = '<span class="validation-error-block error">'+item[0]+'</sapn>';
                        
                            if(passwordElements.includes(key)){
                                var ele = $("#"+key).parent('div');
                                $(errorLabelTitle).insertAfter(ele);
                            }else{
                                $(errorLabelTitle).insertAfter("#"+key);
                            }
                                            
                        });
                    }
                },
                complete: function(res){
                    // $(".submitBtn").attr('disabled', false);
                    loaderHide();
                }
            });     
        }
                      
    });

    
</script>

@include('backend.users.partials.comman_js')

@endsection
