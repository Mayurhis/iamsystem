@extends('layouts.app')
@section('title', 'Create Access Token')

@section('custom_CSS')
@endsection

@section('headerTitle','Create Access Token')

@section('main-content')


<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="title brand-listing">
                    <h5 class="table-subtitle">
                        Create Access Token
                    </h5>
                </div>
                <div class="card-content">
                    <form class="card-form mb-3" id="createAccessTokenForm" method="POST" action="{{route('admin.users.submitAccessToken',$user['ID'])}}">
                        @csrf
                        
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('cruds.user.fields.email')<span class="text-danger">*</span></label>
                                <input type="email" name="email" id="email" value="{{ $user['email'] ?? ''}}" class="form-control valid" placeholder="Enter Email Address" autocomplete="off">
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('cruds.user.fields.username')</label>
                                <input type="text" name="username" id="username" value="{{ $user['username'] ?? ''}}" class="form-control valid" placeholder="Enter Username" autocomplete="off">
                            </div>
                        </div>
                        
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label>@lang('cruds.user.fields.password')<span class="text-danger">*</span></label>
                                <div class="input-password-wrap">
                                    <input type="password" name="password" id="password" value="{{ $user['password'] ?? ''}}" class="form-control valid" placeholder="Enter Password" autocomplete="off">
                                    <i class="fa fa-eye-slash text-dark" id="togglePassword" style="margin-left: -30px; cursor: pointer;"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label>Access Token</label>
                                <input type="text" id="accessToken"  class="form-control valid" disabled>
                            </div>
                            <div class="text-end d-flex justify-content-end">
                                <button type="button" class="btn btn-primary mt-3" id="copyButtonAccessToken">Copy</button>
                            </div>
                        </div>
                    
                    </div>
                        
                        
                        <div class="grid-btn float-end">
                            <input type="hidden" name="user_id"  value="{{ $user['ID'] ?? ''}}">
                            <button type="submit" class="btn btn-primary btn-regular submitBtn">Create Access Token</button>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-regular btn-secondary">@lang('global.cancel')</a>
                        </div> 
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('custom_JS')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

@parent

<script type="text/javascript">

    $(document).ready(function () {
      
        $("#copyButtonAccessToken").click(function(){
            var input = $("#accessToken");
            var value = input.val();
            if(value != ''){
                copyTextToClipboard(value);
                toasterAlert('success','Copied Successfully!');
            }
        });

       $("#createAccessTokenForm").validate({
           errorElement: 'span',
           errorClass: 'validation-error-block error',
           rules: {
               email: {
                   required: true,
                   email: true
               },
               username:{
                usernamePattern :true,
               },
               password: {
                   required: true,
                   minlength: "{{ config('constant.password_min_length') }}",
                   passwordPattern: true,
               },
               type:{
                   required: true,
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
            }
    
       });

   });

    // Submit Add User Form
    $(document).on('submit', '#createAccessTokenForm', function (e) {
        e.preventDefault();

        if ($(this).valid()) {

            loaderShow();

            $('.validation-error-block').remove();
            $(".submitBtn").attr('disabled', true);

            var formData = new FormData(this);

            $.ajax({
                type: 'post',
                url: $(this).attr('action'),
                dataType: 'json',
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {                
                    if(response.success) {
                        toasterAlert('success',response.message);
                        $('#accessToken').val(response.data.access_token);
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
