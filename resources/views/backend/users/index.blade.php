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
                            <h4 class="table-subtitle">@lang('cruds.pageTitles.user_list')</h4>
                            @if(authUserDetail('data.user.type') == 'admin')
                            <a href="{{ route('admin.users.create') }}" class="btn btn-primary" id="addUserBtn">
                               <x-svg-icons icon="add"></x-svg-icons>
                                @lang('cruds.pageTitles.add_user')
                            </a>
                            @endif
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
<script>
    var datatableUrl  =  "{{ route('admin.users.index') }}";
    var statusOptions  =  @json(config('constant.userStatus'));
    var typeOptions  =  @json(config('constant.userType'));

</script>
{!! $dataTable->scripts() !!}

<script type="text/javascript">
    
    @if(!isRolePermission('user_view'))
    $(document).on('click','.clickRow',function(e){
        if ($(e.target).closest('td .action-grid').length) {
            return;
        }
    
        e.preventDefault();
        var rowId = $(this).attr('id');
         
        var url = "{{ route('admin.users.show', ':rowId') }}";
        url = url.replace(':rowId', rowId);
        
        window.location.href = url;
       
    });
    @endif

    @if(!isRolePermission('user_force_logout'))
    $(document).on('click','#userForceLogout',function(event){
        event.preventDefault();

        var username = $(this).attr('data-username');
        var url = $(this).attr('href');

        Swal.fire({
            title: "{{ trans('messages.areYouSure') }}",
            text: "{{ trans('messages.conifrmSweetAlert.user_logout.text',['username'=>':username']) }}".replace(':username', username),
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "{{ trans('messages.conifrmSweetAlert.user_logout.confirmButtonText') }}",
            cancelButtonText: "{{ trans('messages.conifrmSweetAlert.user_logout.cancelButtonText') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                loaderShow();
                window.location.href = url; 
            }
        });

    });
    @endif
    
   
</script>
@endsection
