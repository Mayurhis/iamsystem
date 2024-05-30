@extends('layouts.app')
@section('title', trans('cruds.pageTitles.dashboard'))

@section('custom_CSS')
@endsection

@section('headerTitle',trans('cruds.pageTitles.dashboard'))

@section('main-content')

    <div class="row mb-3">
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-primary dash-boxes">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-primary">
                            <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                    <h4 class="ms-1 mb-0">42</h4>
                    </div>
                    <p class="mb-1">Orcapay</p>
                    <p class="mb-0">
                    <span class="fw-medium me-1">+18.2%</span>
                    <small class="text-muted">than last week</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-warning dash-boxes">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-warning">
                            <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                    <h4 class="ms-1 mb-0">8</h4>
                    </div>
                    <p class="mb-1">Canapay</p>
                    <p class="mb-0">
                    <span class="fw-medium me-1">-8.7%</span>
                    <small class="text-muted">than last week</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-danger dash-boxes">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-danger">
                            <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                    <h4 class="ms-1 mb-0">27</h4>
                    </div>
                    <p class="mb-1">Orcapay</p>
                    <p class="mb-0">
                    <span class="fw-medium me-1">+4.3%</span>
                    <small class="text-muted">than last week</small>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card card-border-shadow-info dash-boxes">
                <div class="card-body">
                    <div class="d-flex align-items-center mb-2 pb-1">
                    <div class="avatar me-2">
                        <span class="avatar-initial rounded bg-label-info">
                            <svg width="20" height="17" viewBox="0 0 20 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19 15.9999C19 14.2583 17.3304 12.7767 15 12.2275M13 16C13 13.7909 10.3137 12 7 12C3.68629 12 1 13.7909 1 16M13 9C15.2091 9 17 7.20914 17 5C17 2.79086 15.2091 1 13 1M7 9C4.79086 9 3 7.20914 3 5C3 2.79086 4.79086 1 7 1C9.20914 1 11 2.79086 11 5C11 7.20914 9.20914 9 7 9Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </div>
                    <h4 class="ms-1 mb-0">13</h4>
                    </div>
                    <p class="mb-1">Canapay</p>
                    <p class="mb-0">
                    <span class="fw-medium me-1">-2.5%</span>
                    <small class="text-muted">than last week</small>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="data-fieldtable">
                        <div class="brand-listing d-flex">
                            <h4 class="table-subtitle">@lang('cruds.pageTitles.user_list')</h4>
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
        
        //  console.log('hello',rowId);
         
        var url = "{{ route('admin.users.show', ':rowId') }}";
        url = url.replace(':rowId', rowId);
        
        window.location.href = url;
       
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

            console.log('loading more records...');
            loading = true;

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
