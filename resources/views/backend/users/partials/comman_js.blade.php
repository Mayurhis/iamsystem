<script>

    $(document).ready(function(){

        var passwordRegex = {{ config('constant.password_regex') }};
        $.validator.addMethod("passwordPattern", function(value, element) {
            return passwordRegex.test(value);
        }, "{{ trans('messages.password_regex') }}");
        
       var usernameRegex = /^[a-zA-Z0-9_]+$/;
       $.validator.addMethod("usernamePattern", function(value, element) {
           if(value != ''){
            return usernameRegex.test(value);
           }else{
            return true;
           }
       }, "{{ trans('messages.username_regex')}}");
       
    });

    $(document).on('click','#suggestPassword',function(e){
        e.preventDefault();
        var suggestPassword = generatePassword();
        $('#password').val(suggestPassword);
    });

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