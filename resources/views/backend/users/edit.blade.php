@extends('layouts.app')
@section('title', trans('cruds.pageTitles.edit_user'))

@section('custom_CSS')
@endsection

@section('headerTitle',trans('cruds.pageTitles.edit_user'))

@section('main-content')


<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="title brand-listing">
                    <h5 class="table-subtitle">
                        Edit User
                    </h5>
                </div>
                <div class="card-content">
                    <form class="card-form mb-3" id="editUserForm" method="POST" action="{{ route('admin.users.update', $user['id']) }}">
                        @csrf
                        @method('PUT')
                        @include('backend.users._form') 
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
   
       $("#editUserForm").validate({
           errorElement: 'span',
           errorClass: 'validation-error-block error',
           rules: {
               aud: "required",
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
               status:{
                   required: true,
               },
               confirmed:{
                required: true,
               },
               language:{
                required: true,
                minlength: 2,
                maxlength: 2,
               }
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

   });

    // Submit Add User Form
    $(document).on('submit', '#editUserForm', function (e) {
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
                    } else {                    
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
