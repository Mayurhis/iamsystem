<!-- Jquery Library -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<!-- Bootstrap Js -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- Data table  -->
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<!-- Custom Js -->
<script src="{{ asset('backend/js/custom.js') }}"></script>

<script>
    
    $(document).ready(function(){

        $(document).on('click','#suggestPassword',function(e){
            e.preventDefault();
            var suggestPassword = generatePassword();
            
            if(suggestPassword != ''){
                $('#copyButton').prop('disabled', false);
            }else{
                $('#copyButton').prop('disabled', true);
            }
            
            
            $('#generate_password').val(suggestPassword);
        });
        
        $("#copyButton").click(function(){
            var input = $("#generate_password");
            var value = input.val();
            if(value != ''){
                copyTextToClipboard(value);
                //toasterAlert('success','Copied Successfully!');
            }else{
                 //toasterAlert('error','Password is not generated!');
            }
        });
    
        $(document).on('click','#logoutBtn',function(event){
            event.preventDefault();

            Swal.fire({
                title: "{{ trans('messages.areYouSure') }}",
                text: "{{ trans('messages.conifrmSweetAlert.logout.text') }}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: "{{ trans('messages.conifrmSweetAlert.logout.confirmButtonText') }}",
                cancelButtonText: "{{ trans('messages.conifrmSweetAlert.logout.cancelButtonText') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = event.target.href; 
                }
            });

        });

    });


    function generatePassword(length=12) {
        const uppercaseLetters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        const lowercaseLetters = 'abcdefghijklmnopqrstuvwxyz';
        const digits = '0123456789';
        const symbols = '-_!@#$%&*';
        
        const allCharacters = uppercaseLetters + lowercaseLetters + digits + symbols;
        
        let password = '';
        password += uppercaseLetters[Math.floor(Math.random() * uppercaseLetters.length)];
        password += lowercaseLetters[Math.floor(Math.random() * lowercaseLetters.length)];
        password += digits[Math.floor(Math.random() * digits.length)];
        password += symbols[Math.floor(Math.random() * symbols.length)];
        
        for (let i = 0; i < length-4; i++) {
            const randomIndex = Math.floor(Math.random() * allCharacters.length);
            password += allCharacters[randomIndex];
        }
        
        password = password.split('').sort(() => Math.random() - 0.5).join('');

        return password;
    }

    function copyTextToClipboard(text) {
        navigator.clipboard.writeText(text)
            .then(function() {
                console.log('Text copied to clipboard');
            })
            .catch(function(err) {
                console.error('Could not copy text: ', err);
            });
    }

</script>