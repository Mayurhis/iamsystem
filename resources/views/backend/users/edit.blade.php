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
@parent

<script type="text/javascript">

    // Submit Add User Form
    $(document).on('submit', '#editUserForm', function (e) {
        e.preventDefault();

        $('.pageloader').show();

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
                    window.location.href = "{{ route('admin.users.index') }}";
                }
            },
            error: function (response) {
                $(".submitBtn").attr('disabled', false);
                $('.pageloader').hide();
                if(response.responseJSON.error_type == 'something_error'){
                    toasterAlert('error',response.responseJSON.error);
                } else {                    
                    var errorLabelTitle = '';
                    $.each(response.responseJSON.errors, function (key, item) {

                        errorLabelTitle = '<span class="validation-error-block">'+item[0]+'</sapn>';
                       
                        $(errorLabelTitle).insertAfter("#"+key);
                                         
                    });
                }
            },
            complete: function(res){
                $(".submitBtn").attr('disabled', false);
                $('.pageloader').hide();
            }
        });                    
    });

</script>

@endsection
