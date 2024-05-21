<!-- Jquery Library -->
<script src="{{ asset('backend/js/assets/jquery-3.7.1.min.js') }}"></script>
<!-- Bootstrap Js -->
<script src="{{ asset('backend/js/assets/bootstrap.bundle.min.js') }}"></script>
<!-- Data table  -->
<script src="{{ asset('backend/js/assets/jquery.dataTables.min.js') }}"></script>
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
                toasterAlert('success','Copied Successfully!');
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

{{-- Start Activity Timeout Js --}}
<script type="text/javascript">

    var timeoutTime = "{{ config('constant.timeout_time') }}";
    const TIMEOUT_DURATION = parseInt(timeoutTime) * 60 * 1000; // 5 minutes

    let logoutTimer; 

    function startLogoutTimer() {
        clearTimeout(logoutTimer);
    }

    function resetLogoutTimer() {
        startLogoutTimer();
    }

    function logout() {
        window.location.href = "{{ route('logout') }}";
    }

    // Add event listeners for user activity
    
    document.addEventListener('mousemove', resetLogoutTimer);
    document.addEventListener('mousedown', resetLogoutTimer);
    document.addEventListener('keypress', resetLogoutTimer);
    document.addEventListener('touchstart', resetLogoutTimer);
    

    // Function to display timeout screen
    function showTimeoutScreen() {
        document.getElementById('timeout-screen').style.display = 'flex';
    }

    // Function to update countdown on timeout screen
    function updateCountdown(seconds) {

        var currentTime = new Date();

        currentTime.setSeconds(seconds);

        var formattedTime = formatTime(currentTime);

        document.getElementById('countdown').textContent = formattedTime;
    }

    // Function to hide timeout screen
    function hideTimeoutScreen() {
     document.getElementById('timeout-screen').style.display = 'none';
    }

    // Initialize the timer
    startLogoutTimer();

    // Show timeout screen and start countdown when timer expires
    logoutTimer = setTimeout(() => {
        showTimeoutScreen();
        let countdown = TIMEOUT_DURATION / 1000;
        updateCountdown(countdown);
        const countdownInterval = setInterval(() => {
            countdown--;
            updateCountdown(countdown);
            if (countdown <= 0) {
                clearInterval(countdownInterval);
                logout();
            }
        }, 1000);
    }, TIMEOUT_DURATION);


    $(document).on('click','.sleep__button',function(event){
        event.preventDefault();
        resetLogoutTimer();
        window.location.reload();
    });


    function formatTime(date) {
        // Get hours, minutes, and seconds
        var hours = date.getHours();
        var minutes = date.getMinutes();
        var seconds = date.getSeconds();

        // Determine AM/PM
        var amOrPm = hours >= 12 ? 'PM' : 'AM';

        // Convert hours to 12-hour format
        hours = hours % 12;
        hours = hours ? hours : 12; // 0 should be converted to 12

        // Format with leading zeros
        var formattedTime = 
            (hours < 10 ? "0" + hours : hours) + ":" +
            (minutes < 10 ? "0" + minutes : minutes) + ":" +
            (seconds < 10 ? "0" + seconds : seconds) + " " + amOrPm;

    return formattedTime;
}

    function capitalizeFirstChar(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

</script>
{{-- Start Activity Timeout Js--}}