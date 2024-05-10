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
    
</script>
@endsection
