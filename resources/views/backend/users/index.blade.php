@extends('layouts.app')
@section('title', trans('cruds.pageTitles.user'))

@section('custom_CSS')
@endsection

@section('headerTitle',trans('cruds.pageTitles.user'))

@section('main-content')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="data-fieldtable">
                        <div class="brand-listing d-flex">
                            <h4 class="table-subtitle">Users Listing</h4>
                            <a href="javascript:void(0)" class="btn btn-primary" id="addUserBtn">
                               <x-svg-icons icon="add"></x-svg-icons>
                                @lang('global.add')
                            </a>
                        </div>
                        <div class="table-responsive">
                            {{$dataTable->table(['class' => 'table', 'style' => 'width:100%;'])}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('custom_JS')
@parent
{!! $dataTable->scripts() !!}

<script type="text/javascript">

    // Add User Modal
    $(document).on('click', '#addUserBtn', function(e){
        e.preventDefault();
      
        $('.pageloader').show();

        $.ajax({
            type: 'get',
            url: "{{ route('admin.users.create') }}",
            dataType: 'json',
            success: function (response) {
                if(response.success) {
                    $('.popup_render_div').html(response.data.htmlView);

                    $('#addUserModal').modal('show');
                }
            },
            error: function (response) {
                if(response.responseJSON.error_type == 'something_error'){
                    toasterAlert('error',response.responseJSON.error);
                } 
            }, 
            complete: function(res){
                $('.pageloader').hide();
            }
        })
    });

    // Submit Add User Form
    $(document).on('submit', '#addUserForm', function (e) {
        e.preventDefault();
        $('.loader-div').show();

        $('.validation-error-block').remove();
        $(".submitBtn").attr('disabled', true);

        var formData = new FormData(this);

        $.ajax({
            type: 'post',
            url: "{{route('admin.users.store')}}",
            dataType: 'json',
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {                
                if(response.success) {
                    $('#users-table').DataTable().ajax.reload(null, false);
                    $('#addUserModal').modal('hide');
                    $('.popup_render_div').html('');
                    toasterAlert('success',response.message);
                }
            },
            error: function (response) {
                $(".submitBtn").attr('disabled', false);
                $('.loader-div').hide();
                if(response.responseJSON.error_type == 'something_error'){
                    toasterAlert('error',response.responseJSON.error);
                } else {                    
                    var errorLabelTitle = '';
                    $.each(response.responseJSON.errors, function (key, item) {
                        errorLabelTitle = '<span class="validation-error-block">'+item[0]+'</sapn>';
                        if (key.indexOf('sub_admin') !== -1) {
                            $(".sub_admin_error").html(errorLabelTitle);
                        } else if (key.indexOf('location_name') !== -1) {
                            $(".location_name_error").html(errorLabelTitle);
                        }
                        else{
                            $(errorLabelTitle).insertAfter("input[name='"+key+"']");
                        }                    
                    });
                }
            },
            complete: function(res){
                $(".submitBtn").attr('disabled', false);
                $('.loader-div').hide();
            }
        });                    
    });


    $(document).on('click', '#addUserModal .cancel-modal', function(e){
        $('#addUserModal').modal('hide');
    });

</script>
@endsection
