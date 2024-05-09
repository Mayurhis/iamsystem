<!DOCTYPE html>
<html lang="en">
<head>
	<title>{{ config('app.name') }} | @yield('title')</title>
    @include('partials.hscript')
    @yield('custom_CSS')
</head>
<body class="admin-dashboard">

	<section class="dash-section">
        <div class="dashboard-blog">

    		@include('partials.sidebar')

            <div class="dash-right-area">
                <div class="mobile-header d-md-none">
                    <div class="mob-logo">
                        <a href="javascript:void(0);" title="logo"><h3 class="text-white">{{ config('app.name') }}</h3></a>
                    </div>
                    <div class="humberger-mobile d-flex">
                        <div class="dropdown user-dropdown">
                            <div class="dropdown-toggle ms-auto p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="img-user"><img src="{{ asset('backend/images/user.jpg') }}" class="img-fluid" id="userImg" alt="user"></div>
                                <div class="name-dta d-flex align-items-end">
                                    <div class="welcome-user">
                                    <span class="welcome">@lang('global.welcome')</span>
                                    <span class="user-name-title">{{ authUserDetail('data.user.type') ? ucwords(authUserDetail('data.user.type')) : '' }}</span>
                                    </div>
                                    <span class="arrow-icon ms-2">
                                    <svg width="10" height="5" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.002 7L7.00195 0.999999L1.00195 7" stroke="#102846" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        @lang('cruds.pageTitles.my_profile')
                                    </a>
                                    </li>
                                    <li>
                                    <a id="logoutBtn" class="dropdown-item" href="{{route('logout')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        @lang('cruds.sidebar.logout')
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="humberger-icon">
                            <img src="{{ asset('backend/images/humberger-icon.svg') }}" alt="humberger-icon">
                        </div>
                    </div>
                </div>

                <div class="dash-title">
                    <div class="main-title">
                        <h2>@yield('headerTitle')</h2>
                        <div class="dropdown user-dropdown desktop-mode">
                            <div class="dropdown-toggle ms-auto p-0" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="img-user"><img src="{{ asset('backend/images/user.jpg') }}" class="img-fluid" id="userImg" alt="user"></div>
                                <div class="name-dta d-flex align-items-end">
                                    <div class="welcome-user">
                                    <span class="welcome">@lang('global.welcome')</span>
                                    <span class="user-name-title">{{ authUserDetail('data.user.type') ? ucwords(authUserDetail('data.user.type')) : '' }}</span>
                                    </div>
                                    <span class="arrow-icon ms-2">
                                    <svg width="10" height="5" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M13.002 7L7.00195 0.999999L1.00195 7" stroke="#102846" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <ul class="list-unstyled mb-0">
                                    <li>
                                    <a class="dropdown-item {{ request()->is('admin/profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        @lang('cruds.pageTitles.my_profile')
                                    </a>
                                    </li>
                                    <li>
                                    <a id="logoutBtn" class="dropdown-item" href="{{route('logout')}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        @lang('cruds.sidebar.logout')
                                    </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @yield('main-content')

                </div>
            </div>

        </div>
    </section>

    <div class="popup_render_div"></div>

    {{-- Start Page Loader --}}
    <div class="pageloader" style="display: none;">
        <div class="loader">
            <div class="line-scale">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    {{-- End Page Loader --}}

    @include('partials.fscript')

    @include('partials.alert')

	@yield('custom_JS')
</body>
</html>
