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

@endsection
