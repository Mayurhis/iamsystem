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


</script>