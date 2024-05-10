@extends('layouts.app')
@section('title', trans('global.profile'))
@section('custom_CSS')
@endsection

@section('headerTitle',trans('global.profile'))

@section('main-content')

    <div class="profile-wrapper">
        <div class="bg-img">
            <img src="{{ asset('backend/images/profile-bg.jpg') }}" alt="profile-background">
        </div>
        <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
            <img src="{{ asset('backend/images/user.jpg') }}" alt="user image" class="d-block ms-sm-4 h-auto user-profile-img">
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
            <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                        <h4>{{ $authUserProfile['username'] ?? null }}</h4>
                        <span>
                        {{ $authUserProfile['type'] ? ucfirst($authUserProfile['type']) :  null }}
                        </span>
                </div>
                {{-- <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profileUpdate">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                    Edit
                </a> --}}
            </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="title">
                        <h5>
                            @lang('auth.profile.about')
                        </h5>
                    </div>
                    <div class="list-details">
                        <ul>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="fw-medium mx-2 text-heading">@lang('cruds.user.fields.username'):</span>
                                <span>{{ $authUserProfile['username'] ?? null }}</span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                                <span class="fw-medium mx-2 text-heading">@lang('cruds.user.fields.email'):</span>
                                <span>{{ $authUserProfile['email'] ?? null }}</span>
                            </li>
                            <li>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                <span class="fw-medium mx-2 text-heading">@lang('cruds.user.fields.aud'):</span>
                                <span>{{ $authUserProfile['aud'] ?? null }}</span>
                            </li>
                            <li>
                                <svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M19.6339 0.366113C20.122 0.854276 20.122 1.64573 19.6339 2.13389L7.75889 14.0089C7.27074 14.497 6.47928 14.497 5.99112 14.0089L0.366113 8.38389C-0.122038 7.89576 -0.122038 7.10426 0.366113 6.61614C0.854276 6.12801 1.64573 6.12801 2.13389 6.61614L6.87501 11.3573L17.8662 0.366113C18.3543 -0.122038 19.1458 -0.122038 19.6339 0.366113Z" fill="#212529"/>
                                </svg>
                                </svg>
                                <span class="fw-medium mx-2 text-heading">@lang('cruds.user.fields.status'):</span>
                                <span class="{{ $authUserProfile['status'] ? $authUserProfile['status'] == 'active' ? 'text-success' : 'text-dark'  :  '' }}">{{ $authUserProfile['status'] ? ucfirst($authUserProfile['status']) :  null }}</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="card">
                <div class="card-body">
                    <div class="accordion profileAccordion" id="profileDetails">
                        <div class="accordion-item">
                            <div class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#changePassword" aria-expanded="true" aria-controls="changePassword">
                                    @lang('global.change_password')
                                </button>
                            </div>
                            <div id="changePassword" class="accordion-collapse collapse show" data-bs-parent="#profileDetails">
                                <div class="accordion-body">
                                    <form class="card-form mb-3" id="changePasswordForm" method="POST" action="{{ route('admin.updatePassword') }}">
                                        @csrf
                                        <div class="card-content">
                                            <div class="form-row">
                                                <div class="mb-3">
                                                    <label for="password">@lang('auth.changePassword.fields.current_password')<span class="mailstar" style="color: red;">*</span></label>
                                                    <div class="input-password-wrap">
                                                        <input type="password" name="current_password"  placeholder="{{ trans('auth.changePassword.fields.current_password_placeholder') }}" class="form-control password" id="current_password" autocomplete="off">
                                                        <i class="togglePassword fa fa-eye-slash" style="margin-left: -30px; cursor: pointer;"></i>
                                                    </div>
                                                    @error('current_password')
                                                    <span class="validation-error-block error">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>
                                                <div class="mb-3">
                                                    <label for="password">@lang('auth.changePassword.fields.new_password')<span class="mailstar" style="color: red;">*</span></label>
                                                    <div class="input-password-wrap">
                                                        <input type="password" name="new_password"  placeholder="{{ trans('auth.changePassword.fields.new_password_placeholder') }}" class="form-control password" id="new_password" autocomplete="off">
                                                        <i class="togglePassword fa fa-eye-slash" style="margin-left: -30px; cursor: pointer;"></i>
                                                    </div>
                                                    <div class="text-end d-flex justify-content-end">
                                                        <button type="button" class="btn btn-primary mt-3" id="suggestPassword">@lang('global.suggest_password')</button>
                                                    </div>
                                                    @error('new_password')
                                                    <span class="validation-error-block error">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password">@lang('auth.changePassword.fields.confirm_password')<span class="mailstar" style="color: red;">*</span></label>
                                                    <div class="input-password-wrap">
                                                        <input type="password" name="confirm_password"  placeholder="{{ trans('auth.changePassword.fields.confirm_password_placeholder') }}" class="form-control password" id="confirm_password" autocomplete="off">
                                                        <i class="togglePassword fa fa-eye-slash" style="margin-left: -30px; cursor: pointer;"></i>
                                                    </div>
                                                    @error('confirm_password')
                                                    <span class="validation-error-block error">
                                                        {{ $message }}
                                                    </span>
                                                    @enderror
                                                </div>

                                            </div>
                                            <div class="save-delete">
                                                <button type="submit" class="btn btn-primary btn-small submitBtn">@lang('global.update')</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Change Email Address --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#emailUpdate" aria-expanded="false" aria-controls="emailUpdate">
                                @lang('auth.profile.change_email_address')
                            </button>
                            </h2>
                            <div id="emailUpdate" class="accordion-collapse collapse" data-bs-parent="#profileDetails">
                                <div class="accordion-body">
                                    <form class="card-form mb-3" id="changeEmailAddressForm" method="POST" action="{{ route('admin.updateEmail') }}">
                                        @csrf
                                        <div class="card-content">

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label>@lang('auth.profile.new_email')<span class="text-danger">*</span></label>
                                                    <input type="email" name="new_email" id="new_email" class="form-control valid" placeholder="{{ trans('auth.profile.new_email_placeholder') }}" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label>@lang('auth.profile.confirm_email')<span class="text-danger">*</span></label>
                                                    <input type="email" name="confirm_email" id="confirm_email" class="form-control valid" placeholder="{{ trans('auth.profile.confirm_email_placeholder') }}" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="save-delete">
                                                <button type="submit" class="btn btn-primary btn-small submitChangeEmailBtn">@lang('global.update')</button>
                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        {{--  Change Username --}}
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#userNameUpdate" aria-expanded="false" aria-controls="userNameUpdate">
                                @lang('auth.profile.change_username')
                            </button>
                            </h2>
                            <div id="userNameUpdate" class="accordion-collapse collapse" data-bs-parent="#profileDetails">
                                 <div class="accordion-body">
                                <form class="card-form mb-3" id="changeUsernameForm" method="POST" action="{{ route('admin.updateUsername') }}">
                                        @csrf
                                        <div class="card-content">

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label>@lang('auth.profile.new_username')<span class="text-danger">*</span></label>
                                                    <input type="text" name="new_username" id="new_username" class="form-control valid" placeholder="{{ trans('auth.profile.new_username_placeholder') }}" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group">
                                                    <label>@lang('auth.profile.confirm_username')<span class="text-danger">*</span></label>
                                                    <input type="text" name="confirm_username" id="confirm_username" class="form-control valid" placeholder="{{ trans('auth.profile.confirm_username_placeholder') }}" autocomplete="off">
                                                </div>
                                            </div>

                                            <div class="save-delete">
                                                <button type="submit" class="btn btn-primary btn-small submitChangeUsernameBtn">@lang('global.update')</button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>


    <!-- Profile Modal  -->
    <div class="modal fade" id="profileUpdate" tabindex="-1" aria-labelledby="profileUpdateLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
        <div class="modal-header">
            <h4>
                Edit profile
            </h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <form class="profile-form" id="edit_profile" action="" method="post" novalidate="novalidate">

                    <div class="author-box">
                        <div class="author-cion">
                            <img class="image img-fluid profileImage" height="50" src="{{ asset('backend/images/user.jpg') }}">
                            <div class="upload-img profileImage" src="">
                                <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M20.0928 0.837209V5.30233C20.0928 5.76446 20.4678 6.13953 20.93 6.13953C21.3921 6.13953 21.7672 5.76446 21.7672 5.30233V0.837209C21.7672 0.37507 21.3921 0 20.93 0C20.4678 0 20.0928 0.37507 20.0928 0.837209Z" fill="#6B6B6B"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M18.6976 3.90708H23.1627C23.6248 3.90708 23.9999 3.53201 23.9999 3.06988C23.9999 2.60774 23.6248 2.23267 23.1627 2.23267H18.6976C18.2354 2.23267 17.8604 2.60774 17.8604 3.06988C17.8604 3.53201 18.2354 3.90708 18.6976 3.90708Z" fill="#6B6B6B"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.2326 0.558105H8.78288C8.04279 0.558105 7.36633 0.97671 7.03591 1.63755L5.97879 3.7529C5.93079 3.84666 5.83479 3.90694 5.72874 3.90694H3.06977C1.37414 3.90694 0 5.28108 0 6.97671V18.1395C0 18.9533 0.323721 19.7347 0.898605 20.3107C1.4746 20.8855 2.256 21.2093 3.06977 21.2093H20.9302C21.744 21.2093 22.5254 20.8855 23.1014 20.3107C23.6763 19.7347 24 18.9533 24 18.1395C24 14.7382 24 8.65113 24 8.65113C24 8.18899 23.6249 7.81392 23.1628 7.81392C22.7007 7.81392 22.3256 8.18899 22.3256 8.65113V18.1395C22.3256 18.5101 22.1782 18.864 21.917 19.1263C21.6547 19.3875 21.3008 19.5348 20.9302 19.5348H3.06977C2.69916 19.5348 2.3453 19.3875 2.08298 19.1263C1.82177 18.864 1.67442 18.5101 1.67442 18.1395V6.97671C1.67442 6.20648 2.29954 5.58136 3.06977 5.58136H5.72874C6.46884 5.58136 7.1453 5.16276 7.47572 4.50192L8.53284 2.38657C8.58084 2.2928 8.67684 2.23252 8.78288 2.23252H14.2326C14.6947 2.23252 15.0698 1.85745 15.0698 1.39531C15.0698 0.933175 14.6947 0.558105 14.2326 0.558105Z" fill="#6B6B6B"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.0001 6.69775C9.0732 6.69775 6.69775 9.0732 6.69775 12.0001C6.69775 14.927 9.0732 17.3024 12.0001 17.3024C14.927 17.3024 17.3024 14.927 17.3024 12.0001C17.3024 9.0732 14.927 6.69775 12.0001 6.69775ZM12.0001 8.37217C14.0027 8.37217 15.628 9.99747 15.628 12.0001C15.628 14.0027 14.0027 15.628 12.0001 15.628C9.99747 15.628 8.37217 14.0027 8.37217 12.0001C8.37217 9.99747 9.99747 8.37217 12.0001 8.37217Z" fill="#6B6B6B"></path>
                                </svg>
                            </div>
                        </div>
                        <!-- <div class="author-name">
                            Edit profile
                        </div> -->
                    </div>
                    <input type="file" name="image" id="image" class="file-input d-none" accept="image/png, image/jpg, image/jpeg, image/PNG, image/JPG, image/JPEG, image/SVG, image/svg">

                    <div class="grid-box">
                        <div class="form-fields-item mb-4">
                            <label>First Name<span class="text-danger">*</span></label>
                            <input type="text" name="first_name" id="first_name" value="" class="form-control valid" placeholder="Enter First Name" required="" aria-required="true" aria-invalid="false">
                        </div>
                        <div class="form-fields-item mb-4">
                            <label>Last Name</label>
                            <input type="text" name="last_name" id="last_name" value="" class="form-control valid" placeholder="Enter Last Name" aria-required="true" aria-invalid="false">
                        </div>
                    </div>

                    <div class="form-fields-item mb-4">
                        <label>Email</label>
                        <input type="email" name="email" id="email" value="" class="form-control valid" placeholder="Enter Email Address" aria-required="true" aria-invalid="false">
                    </div>

                    <div class="form-fields-item mb-4">
                        <label>Status</label>
                        <select name="" id="" class="form-control">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>

                    <div class="grid-btn">
                        <button type="submit" class="btn btn-primary btn-regular w-100">Save Details</button>
                        <button type="button" class="btn btn-regular w-100 btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
        </div>
        </div>
    </div>
    </div>

@endsection
@section('custom_JS')
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script type="text/javascript">

    $(document).ready(function(){

        // Start change password
        $("#changePasswordForm").validate({
           errorElement: 'span',
           errorClass: 'validation-error-block error',
           rules: {
               current_password: {
                   required: true,
               },
               new_password: {
                   required: true,
                   minlength: "{{ config('constant.password_min_length') }}",
                   passwordPattern: true,
               },
               confirm_password: {
                   required: true,
                   equalTo: "#new_password"
               },
              
           },
           messages: {
               required: "This field is required.",
               confirm_password:{
                equalTo:"The new password & confirm password must match.",
               }
             
           },
           errorPlacement: function(error, element) {
                if ($(element).attr('type') === 'password') {
                    error.insertAfter(element.parent('div'));
                } else {
                    error.insertAfter(element);
                }
            }
    
        });

       var passwordRegex = {{ config('constant.password_regex') }};
        $.validator.addMethod("passwordPattern", function(value, element) {
            return passwordRegex.test(value);
        }, "{{ trans('messages.password_regex') }}");
        

        $(document).on('submit', '#changePasswordForm', function (e) {
            e.preventDefault();

            if($(this).valid()){
                loaderShow();

                $('.validation-error-block').remove();
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
                            setTimeout(function() {
                                window.location.href = "{{ route('admin.login') }}";
                            }, 2000);
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
                                errorLabelTitle = '<span class="validation-error-block error">'+item[0]+'</sapn>';
                                $(errorLabelTitle).insertAfter("input[name='"+key+"']");
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
        // End change password

        // Start change email
        $("#changeEmailAddressForm").validate({
           errorElement: 'span',
           errorClass: 'validation-error-block error',
           rules: {
               new_email: {
                   required: true,
                   email: true
               },
               confirm_email: {
                  required: true,
                  email: true,
                  equalTo: "#new_email"
               },
              
           },
           messages: {
               required: "This field is required.",
               confirm_email:{
                equalTo:"The new email & confirm email must match.",
               }
           },
           errorPlacement: function(error, element) {
               error.insertAfter(element);
            }
        });


        $(document).on('submit', '#changeEmailAddressForm', function (e) {
            e.preventDefault();

            if($(this).valid()){
                loaderShow();

                $('.validation-error-block').remove();
                $(".submitChangeEmailBtn").attr('disabled', true);

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

                        if(response.responseJSON.error_type == 'something_error'){
                            toasterAlert('error', response.responseJSON.error);
                        }else if(response.responseJSON.error_type == 'warning'){
                            toasterAlert('warning', response.responseJSON.error);
                        } else {

                            var errorLabelTitle = '';
                            $.each(response.responseJSON.errors, function (key, item) {
                                errorLabelTitle = '<span class="validation-error-block error">'+item[0]+'</sapn>';
                                $(errorLabelTitle).insertAfter("input[name='"+key+"']");
                            });
                        }
                    },
                    complete: function(res){
                        $(".submitChangeEmailBtn").attr('disabled', false);
                        loaderHide();
                    }
                });
            }
           
        });
        // End change email

       
       //Start change username
       
        $("#changeUsernameForm").validate({
           errorElement: 'span',
           errorClass: 'validation-error-block error',
           rules: {
                new_username:{
                 required: true,
                 usernamePattern :true,
               },
               confirm_username: {
                  required: true,
                  usernamePattern :true,
                  equalTo: "#new_username"
               },
              
           },
           messages: {
               required: "This field is required.",
               confirm_username:{
                equalTo:"The new username & confirm username must match.",
               }
           },
           errorPlacement: function(error, element) {
               error.insertAfter(element);
            }
        });

        $(document).on('submit', '#changeUsernameForm', function (e) {
            e.preventDefault();

            if($(this).valid()){
                loaderShow();

                $('.validation-error-block').remove();
                $(".submitChangeUsernameBtn").attr('disabled', true);

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

                        if(response.responseJSON.error_type == 'something_error'){
                            toasterAlert('error', response.responseJSON.error);
                        }else if(response.responseJSON.error_type == 'warning'){
                            toasterAlert('warning', response.responseJSON.error);
                        } else {

                            var errorLabelTitle = '';
                            $.each(response.responseJSON.errors, function (key, item) {
                                errorLabelTitle = '<span class="validation-error-block error">'+item[0]+'</sapn>';
                                $(errorLabelTitle).insertAfter("input[name='"+key+"']");
                            });
                        }
                    },
                    complete: function(res){
                        $(".submitChangeUsernameBtn").attr('disabled', false);
                        loaderHide();
                    }
                });
            }
           
        });
       
       var usernameRegex = /^[a-zA-Z0-9_]+$/;
       $.validator.addMethod("usernamePattern", function(value, element) {
           if(value != ''){
            return usernameRegex.test(value);
           }else{
            return true;
           }
       }, "{{ trans('messages.username_regex')}}");
       
       //End change username
    });


    document.addEventListener("DOMContentLoaded", () => {
        const toggleButtons = document.querySelectorAll('.togglePassword');
        toggleButtons.forEach(toggleButton => {
            toggleButton.addEventListener('click', function (e) {
               
                const passwordField = this.closest('.input-password-wrap').querySelector('.password');
             
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
               
                this.classList.toggle('fa-eye');
            });
        });
    });


    $(document).on('click','#suggestPassword',function(e){
        e.preventDefault();
        var suggestPassword = generatePassword();
        $('#new_password').val(suggestPassword);
    });



</script>
@endsection
