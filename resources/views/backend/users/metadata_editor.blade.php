@extends('layouts.app')
@section('title', 'Metadata Editor')

@section('custom_CSS')

@endsection

@section('headerTitle','Metadata Editor')

@section('main-content')


<div class="row">
    <div class="col-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="title brand-listing">
                    <h5 class="table-subtitle">
                        Metadata Editor
                    </h5>
                </div>
                <div class="card-content">
                    <form class="card-form mb-3" id="metadataEditorForm" method="POST" action="{{ route('admin.users.submitMetaDataEditor', $user['ID']) }}">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">

                                    @php
                                        $metadata = '';
                                        if(isset($user)){
                                           if(isset($user['metadata'])){
                                                $metadata = isset($user['metadata']['wallets']) ? json_encode($user['metadata']['wallets']) :json_encode($user['metadata']);
                                            }
                                        }
                                    @endphp

                                    <label>@lang('cruds.user.fields.metadata')<span class="text-danger">*</span></label>
                                    <textarea type="text" name="metadata" id="metadata" class="form-control valid editable"  placeholder="Enter Metadata" autocomplete="off">{{ $metadata ?? ''}}</textarea>
                                </div>
                            </div>
                            
                        </div>
                        <div class="grid-btn float-end">
                            <button type="submit" class="btn btn-primary btn-regular submitBtn">@lang('global.update')</button>
                            
                            <a href="{{ route('admin.users.index') }}" class="btn btn-regular btn-secondary">@lang('global.cancel')</a>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.partials.generate-password-modal')

@endsection

@section('custom_JS')
<script src="{{ asset('backend/js/assets/jquery.validate.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/json-colorizer/0.1.10/jsonColorizer.min.js"></script>

@parent
<script type="text/javascript">

    // prettifyAndColorizeJSON();
    
  
    $(document).ready(function () {

       $("#metadataEditorForm").validate({
           errorElement: 'span',
           errorClass: 'validation-error-block error',
           rules: {
            'metadata':{
                required: true,
                isValidJSON: true
               }
           },
           errorPlacement: function(error, element) {
                if ($(element).attr('type') === 'password') {
                    error.insertAfter(element.parent('div'));
                } else {
                    error.insertAfter(element);
                }
            },
       });

   });

    // Submit Add User Form
    $(document).on('submit', '#metadataEditorForm', function (e) {
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
                    } else if(response.responseJSON.error_type == 'unauthorized'){
                        toasterAlert('error',response.responseJSON.error);
                        window.location.href = "{{ route('admin.login') }}";
                    }else {                    
                        var errorLabelTitle = '';
                       
                        $.each(response.responseJSON.errors, function (key, item) {

                            errorLabelTitle = '<span class="validation-error-block error">'+item[0]+'</sapn>';
                        
                            $(errorLabelTitle).insertAfter("#"+key);
                                        
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


    function prettifyAndColorizeJSON() {
        var textarea = document.getElementById("metadata");
        var jsonString = textarea.value;
        
        try {
            // Parse the JSON string
            var jsonData = JSON.parse(jsonString);
            // Prettify the JSON string
            var prettyJsonString = JSON.stringify(jsonData, null, 4);
            // Apply color formatting
            var colorizedJsonString = jsonColorizer.colorize(prettyJsonString);
            // Update the textarea with colorized JSON
            textarea.value = colorizedJsonString;
        } catch (error) {
            console.error("Error parsing JSON:", error);
        }
    }

    var metadataTextarea = document.getElementById("metadata");
    metadataTextarea.addEventListener("input", prettifyAndColorizeJSON);

   
</script>

@include('backend.users.partials.comman_js')

@endsection
