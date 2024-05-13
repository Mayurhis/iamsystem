<script>

    $(document).ready(function(){

        $('#role').select2({
            theme:'classic',
            // selectOnClose: true,
            placeholder:'Please Select Role',
            multiple: true,
            tags: true,
            tokenSeparators: [',', ' '],
            // minimumResultsForSearch: Infinity
        });

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
       

       $.validator.addMethod("isValidJSON", function(value, element) {
            try {
                JSON.parse(value);
                return true; 
            } catch (e) {
                return false; 
            }
        }, "Please enter a valid JSON data.");
       
    });
    
     $(document).on('change', '#type', function (e) {
        e.preventDefault();
        
        var typeVal = $(this).val();
        
        if((typeVal == 'system') || (typeVal == 'machine')){
            $('#email').attr('type','text');
        }else{
            $('#email').attr('type','email');
        }
    });


    document.addEventListener("DOMContentLoaded", () => {
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');
        if(togglePassword){
            togglePassword.addEventListener('click', function (e) {
                // toggle the type attribute
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                // toggle the eye slash icon
                this.classList.toggle('fa-eye');
            });    
        }
        
    });

</script>