@extends('layouts.app')
@section('title', trans('cruds.pageTitles.view_user'))
@section('custom_CSS')
@endsection

@section('headerTitle',trans('cruds.pageTitles.view_user'))

@section('main-content')

    <div class="user-detail-area">
        <div class="row">
            <div class="col-12 col-sm-12 col-md-3 col-lg-2">
                <div class="user_profile">
                    <img class="img-fluid" src="{{ asset('backend/images/user011.jpg') }}" alt="profile">
                </div>
            </div>
            <div class="col-12 col-sm-12 col-md-8 col-lg-10">
                <div class="user_content">
                    <div class="mb-3">
                        <div class="name">
                            <h4>ID</h4>
                            <span>{{ $user['ID'] ?? '' }}</span>
                        </div>
                    </div>

                    @if(authUserDetail('data.user.type') == 'admin')
                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.aud')</h4>
                            <span>{{ $user['aud'] ?? '' }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.username')</h4>
                            <span>{{ $user['username'] ?? '' }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.email')</h4>
                            <span>{{ $user['email'] ?? '' }}</span>
                        </div>
                    </div>

                    @if(authUserDetail('data.user.type') == 'admin')
                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.type')</h4>
                            <span class="text-dark">{{ isset($user['type']) ? ucwords($user['type']) : '' }}</span>
                        </div>
                    </div>
                    @endif

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.role')</h4>
                            <span class="text-dark">{{ isset($user['role']) ? ucwords(str_replace(',', ', ', $user['role'])) : '' }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.is_confirmed')</h4>
                            <span class="text-dark">{{ isset($user['is_confirmed']) ? $user['is_confirmed'] == 1 ? 'Yes' : 'No' : '' }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.status')</h4>
                            <span class="text-dark">{{ isset($user['status']) ? ucwords($user['status']) : '' }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.language')</h4>
                            <span class="text-dark">{{ isset($user['language']) ? strtoupper(($user['language'])) : '' }}</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.last_login_at')</h4>
                            <span>{{ isset($user['last_login_at']) && (!is_null($user['last_login_at'])) ? convertDateTimeFormat($user['last_login_at'],'datetime') : '' }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.created_at')</h4>
                            <span>{{ $user['created_at'] ? convertDateTimeFormat($user['created_at'],'datetime') : '' }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.updated_at')</h4>
                            <span>{{ $user['updated_at'] ? convertDateTimeFormat($user['updated_at'],'datetime') : '' }}</span>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="name">
                            <h4>@lang('cruds.user.fields.metadata')</h4>
                            <span class="text-dark">{{ isset($user['metadata']) ? json_encode($user['metadata']) : '' }}</span>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <a href="{{ route('admin.users.index') }}" class="btn btn-regular btn-secondary float-end">@lang('global.back')</a>
            </div>
        </div> 
    </div>

    

@endsection

@section('custom_JS')
@endsection
