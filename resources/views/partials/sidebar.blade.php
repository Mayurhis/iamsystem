<div class="nav-area">
    <aside class="dash-sidebar">
        <a href="{{ route('admin.dashboard') }}" title="logo" class="sidebar-logo text-center">
            {{-- <img src="{{ asset('backend/images/logo.png') }}" alt="logo" class="img-fluid"> --}}
            <h3 class="text-white">{{ config('app.name') }}</h3>
        </a>
        <h6>@lang('global.welcome')</h6>
        <ul class="nav-items">
            <li>
                <a href="{{ route('admin.dashboard') }}" title="{{ trans('cruds.sidebar.dashboard') }}" class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <div class="menu-img"><img src="{{ asset('backend/images/dashaboard.svg') }}" alt="{{ trans('cruds.sidebar.dashboard') }}"></div>@lang('cruds.sidebar.dashboard')
                </a>
            </li>
            {{-- <li>
                <a href="javascript:void(0);" title="{{ trans('cruds.sidebar.brands') }}" class="{{ request()->is('admin/brands') ? 'active' : '' }}">
                    <div class="menu-img"><img src="{{ asset('backend/images/brand.svg') }}" alt="{{ trans('cruds.sidebar.brands') }}"></div>@lang('cruds.sidebar.brands')
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" title="{{ trans('cruds.sidebar.users') }}" class="{{ request()->is('admin/users') ? 'active' : '' }}">
                    <div class="menu-img"><img src="{{ asset('backend/images/profile-white.svg') }}" alt="{{ trans('cruds.sidebar.users') }}"></div>@lang('cruds.sidebar.users')
                </a>
            </li>
            <li>
                <a href="javascript:void(0);" title="{{ trans('cruds.sidebar.kyc_request') }}" class="{{ request()->is('admin/kycrequest') ? 'active' : '' }}">
                    <div class="menu-img"><img src="{{ asset('backend/images/profile-white.svg') }}" alt="{{ trans('cruds.sidebar.kyc_request') }}"></div>@lang('cruds.sidebar.kyc_request')
                </a>
            </li> --}}
            <li>
                <a href="{{route('logout')}}" title="{{ trans('cruds.sidebar.logout') }}">
                    <div class="menu-img"><img src="{{ asset('backend/images/log-out.svg') }}" alt="{{ trans('cruds.sidebar.logout') }}"></div>@lang('cruds.sidebar.logout')
                </a>
            </li>
        </ul>
    </aside>
</div>