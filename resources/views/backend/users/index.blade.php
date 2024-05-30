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

                            <div id="loadmore-data" class="dataTables_processing loadmore-wrap" style="display: none;"><div><div></div><div></div><div></div><div></div></div></div>
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
    var nextPageStart = 20;

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
    
    $(document).ready(function(){
        $('select[name="users-table_length"]').on('change', function() {
            var length = $(this).val();

            $('#users-table tr .appened').remove();

            nextPageStart = length;

            $('#users-table').scrollTop(0);
           
        });
    });
   

    var loading = false;
   
    $('#users-table').on('scroll', function() {

        var scrollBody = $(this);

        if (scrollBody.scrollTop() + scrollBody.innerHeight() >= scrollBody[0].scrollHeight - 50 && !loading) {

            // console.log('loading more records...');
            loading = true;

            $('#loadmore-data').show();

            const table = $('#users-table').DataTable();

            var info = table.page.info();

            var order = table.order();
            var columns = table.columns()[0];
          
            // console.log('info',info);

            var initialStart = info.recordsDisplay;
           

            var rowsLength = document.querySelector('#users-table tbody').rows.length;
            nextPageStart = rowsLength;

           
            var columnNames = [];
            $('#users-table thead th').each(function() {
                var columnName = $(this).text().toLowerCase().replace(/\s+/g, '_');
                columnNames.push(columnName);
            });

           var filterParam = {
                initialStart:initialStart,
                start: nextPageStart,
                length: info.length,
                columnNames:columnNames,
           };

           if($('.filter-submit-btn').hasClass('submited')){

                filterParam.email = $('#ft-dt-email').val();
                filterParam.username = $('#ft-dt-username').val();
                filterParam.status = $('#ft-dt-status').val();
                filterParam.is_confirmed = $('#ft-dt-is_confirmed').val();
                filterParam.language = $('#ft-dt-language').val();
                filterParam.aud = $('#ft-dt-aud').val();
                filterParam.type = $('#ft-dt-type').val();
                filterParam.created_at = $('#ft-dt-created_at').val();
                filterParam.updated_at = $('#ft-dt-updated_at').val();
                filterParam.last_login_at = $('#ft-dt-last_login_at').val();
           }
           
        //    console.log(filterParam);

            $.ajax({
                url: "{{ route('admin.users.getData') }}",
                data: filterParam,
                success: function(response) {
                    // console.log(response);
                    $('#loadmore-data').hide();
                    // nextPageStart = response.offset;
                    $('#users-table tbody').append(response.htmlView);
                    loading = false;
                },
                error: function() {
                    loading = false;
                }
            });
        }
    });
   
</script>
@endsection
