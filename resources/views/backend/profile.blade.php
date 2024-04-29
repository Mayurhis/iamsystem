@extends('layouts.app')
@section('title', trans('global.profile'))
@section('custom_CSS')
@endsection

@section('main-content')

    <div class="dash-right-area">
        <div class="mobile-header d-md-none">
            <div class="mob-logo">
                <a href="javascript:void(0);" title="logo"><img src="{{ asset('backend/images/logo.png') }}" alt="logo" class="img-fluid"></a>
            </div>
            <div class="humberger-icon">
                <img src="{{ asset('backend/images/humberger-icon.svg') }}" alt="humberger-icon">
            </div>
        </div>
        <div class="dash-title">
            <h2 class="main-title">@lang('global.profile')</h2>
        </div>


        <div class="card">
            <div class="card-body">

                <p>
                    <h5>@lang('cruds.profile.fields.email')</h5>  <span>{{ $authUserProfile['email'] ?? null }}</span>
                </p>
                <p>
                    <h5>@lang('cruds.profile.fields.username')</h5>  <span>{{ $authUserProfile['username'] ?? null }}</span>
                </p>
                <p>
                    <h5>@lang('cruds.profile.fields.status')</h5>  <span>{{ $authUserProfile['status'] ? ucfirst($authUserProfile['status']) : null }}</span>
                </p>

            </div>
        </div>

    </div>

@endsection
@section('custom_JS')
@endsection
