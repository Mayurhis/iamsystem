@extends('layouts.app')
@section('title', trans('global.dashboard'))
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
            <h2 class="main-title">@lang('global.dashboard')</h2>
        </div>
    </div>

@endsection
@section('custom_JS')
@endsection
